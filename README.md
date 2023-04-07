
[![Total Downloads](https://poser.pugx.org/giahojnost/lumen-swagger/downloads.svg)](https://packagist.org/packages/giahojnost/lumen-swagger)


LumenSwagger
==========

Swagger 2.0-3.0 for Lumen

This package is a wrapper of [Swagger-php](https://github.com/zircote/swagger-php) and [swagger-ui](https://github.com/swagger-api/swagger-ui) adapted to work with Lumen.

Retouched based on [DarkaOnLine/LumenSwagger](https://github.com/DarkaOnLine/LumenSwagger)


 Lumen      | Swagger UI| OpenAPI Spec compatibility | L5-Swagger
:-----------|:----------|:---------------------------|:----------
 10.0        | 3         | 2.0, 3.0                   | ``` composer require "giahojnost/lumen-swagger:10.*" ```

- Open your `bootstrap/app.php` file and:

uncomment this line (around line 26) in `Create The Application` section:
```php
     $app->withFacades();
```

add this line before `Register Container Bindings` section:
```php
     $app->configure('lumen-swagger');
```

add this line in `Register Service Providers` section:
```php
    $app->register(\LumenSwagger\ServiceProvider::class);
```

- Run `php artisan lumen-swagger:publish-config` to publish configs (`config/lumen-swagger.php`)
- Make configuration changes if needed
- Run `php artisan lumen-swagger:publish` to publish everything

Using [OpenApi 3.0 Specification](https://github.com/OAI/OpenAPI-Specification)
============
If you would like to use latest OpenApi specifications (originally known as the Swagger Specification) in your project you should:
- Explicitly require `swagger-php` version 3.* in your projects composer by running:
```bash
composer require 'zircote/swagger-php:4.*'
```
- Set environment variable `SWAGGER_VERSION` to **3.0** in your `.env` file:
```
SWAGGER_VERSION=3.0
```
or in your `config/l5-swagger.php`:
```php
'swagger_version' => env('SWAGGER_VERSION', '3.0'),
```
- Use examples provided here: https://github.com/zircote/swagger-php/tree/3.x/Examples/petstore-3.0

Configuration
============
- Run `php artisan lumen-swagger:publish-config` to publish configs (`config/lumen-swagger.php`)
- Run `php artisan lumen-swagger:publish-views` to publish views (`resources/views/vendor/lumen-swagger`)
- Run `php artisan lumen-swagger:publish` to publish everything
- Run `php artisan lumen-swagger:generate` to generate docs


Swagger-php
======================
The actual Swagger spec is beyond the scope of this package. All LumenSwagger does is package up swagger-php and swagger-ui in a Laravel-friendly fashion, and tries to make it easy to serve. For info on how to use swagger-php [look here](http://zircote.com/swagger-php/). For good examples of swagger-php in action [look here](https://github.com/zircote/swagger-php/tree/master/Examples/petstore.swagger.io).
