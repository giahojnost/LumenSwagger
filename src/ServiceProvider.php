<?php

namespace LumenSwagger;

use Illuminate\Support\ServiceProvider as BaseProvider;
use LumenSwagger\Console\GenerateDocsCommand;
use LumenSwagger\Console\PublishCommand;
use LumenSwagger\Console\PublishConfigCommand;
use LumenSwagger\Console\PublishViewsCommand;

class ServiceProvider extends BaseProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $viewPath = __DIR__.'/../resources/views';
        $this->loadViewsFrom($viewPath, 'lumen-swagger');

        $this->app->router->group(['namespace' => 'LumenSwagger'], function ($route) {
            require __DIR__.'/routes.php';
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/lumen-swagger.php';
        $this->mergeConfigFrom($configPath, 'lumen-swagger');

        $this->app->singleton('command.lumen-swagger.publish', function () {
            return new PublishCommand();
        });

        $this->app->singleton('command.lumen-swagger.publish-config', function () {
            return new PublishConfigCommand();
        });

        $this->app->singleton('command.lumen-swagger.publish-views', function () {
            return new PublishViewsCommand();
        });

        $this->app->singleton('command.lumen-swagger.generate', function () {
            return new GenerateDocsCommand();
        });

        $this->commands(
            'command.lumen-swagger.publish',
            'command.lumen-swagger.publish-config',
            'command.lumen-swagger.publish-views',
            'command.lumen-swagger.generate'
        );
    }
}
