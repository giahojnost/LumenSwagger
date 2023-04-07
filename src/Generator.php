<?php

namespace LumenSwagger;

use Illuminate\Support\Facades\File;

class Generator
{
    public static function generateDocs()
    {
        $appDir = config('lumen-swagger.paths.annotations');
        $docDir = config('lumen-swagger.paths.docs');
        if (! File::exists($docDir) || is_writable($docDir)) {
            // delete all existing documentation
            if (File::exists($docDir)) {
                File::deleteDirectory($docDir);
            }

            self::defineConstants(config('lumen-swagger.constants') ?: []);

            File::makeDirectory($docDir);
            $excludeDirs = config('lumen-swagger.paths.excludes');

            if (version_compare(config('lumen-swagger.swagger_version'), '3.0', '>=')) {
                $swagger = \OpenApi\scan($appDir, ['exclude' => $excludeDirs]);
            } else {
                $swagger = \Swagger\scan($appDir, ['exclude' => $excludeDirs]);
            }

            if (config('lumen-swagger.paths.base') !== null) {
                $swagger->basePath = config('lumen-swagger.paths.base');
            }

            $filename = $docDir.'/'.config('lumen-swagger.paths.docs_json');
            $swagger->saveAs($filename);

            $security = new SecurityDefinitions();
            $security->generate($filename);
        }
    }

    protected static function defineConstants(array $constants)
    {
        if (! empty($constants)) {
            foreach ($constants as $key => $value) {
                defined($key) || define($key, $value);
            }
        }
    }
}
