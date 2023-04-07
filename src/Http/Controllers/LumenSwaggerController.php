<?php

namespace LumenSwagger\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use LumenSwagger\Generator;

class LumenSwaggerController extends BaseController
{
    /**
     * Dump api-docs.json content endpoint.
     *
     * @param  null  $jsonFile
     * @return \Illuminate\Http\Response
     */
    public function docs($jsonFile = null)
    {
        $filePath = config('lumen-swagger.paths.docs').'/'.
            (! is_null($jsonFile) ? $jsonFile : config('lumen-swagger.paths.docs_json'));

        if (config('lumen-swagger.generate_always') && ! File::exists($filePath)) {
            try {
                Generator::generateDocs();
            } catch (\Exception $e) {
                Log::error($e);

                abort(
                    404,
                    sprintf(
                        'Unable to generate documentation file to: "%s". Please make sure directory is writable. Error: %s',
                        $filePath,
                        $e->getMessage()
                    )
                );
            }
        }

        if (! File::exists($filePath)) {
            abort(404, 'Cannot find '.$filePath);
        }

        $content = File::get($filePath);

        return new Response($content, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Display Swagger API page.
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        if (config('lumen-swagger.generate_always')) {
            Generator::generateDocs();
        }

        //need the / at the end to avoid CORS errors on Homestead systems.
        $response = new Response(
            view('lumen-swagger::index', [
                'secure' => Request::secure(),
                'urlToDocs' => route('lumen-swagger.docs'),
                'operationsSorter' => config('lumen-swagger.operations_sort'),
                'configUrl' => config('lumen-swagger.additional_config_url'),
                'validatorUrl' => config('lumen-swagger.validator_url'),
            ]),
            200,
            ['Content-Type' => 'text/html']
        );

        return $response;
    }

    /**
     * Display Oauth2 callback pages.
     *
     * @return string
     */
    public function oauth2Callback()
    {
        return File::get(swagger_ui_dist_path('oauth2-redirect.html'));
    }
}
