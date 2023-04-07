<?php

$route->get(config('lumen-swagger.routes.docs'), [
    'as' => 'lumen-swagger.docs',
    'middleware' => config('lumen-swagger.routes.middleware.docs', []),
    'uses' => 'Http\Controllers\LumenSwaggerController@docs',
]);

$route->get(config('lumen-swagger.routes.api'), [
    'as' => 'lumen-swagger.api',
    'middleware' => config('lumen-swagger.routes.middleware.api', []),
    'uses' => 'Http\Controllers\LumenSwaggerController@api',
]);

$route->get(config('lumen-swagger.routes.assets').'/{asset}', [
    'as' => 'lumen-swagger.asset',
    'middleware' => config('lumen-swagger.routes.middleware.asset', []),
    'uses' => 'Http\Controllers\LumenSwaggerAssetController@index',
]);

$route->get(config('lumen-swagger.routes.oauth2_callback'), [
    'as' => 'lumen-swagger.oauth2_callback',
    'middleware' => config('lumen-swagger.routes.middleware.oauth2_callback', []),
    'uses' => 'Http\Controllers\LumenSwaggerController@oauth2Callback',
]);
