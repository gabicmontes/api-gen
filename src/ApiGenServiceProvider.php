<?php

namespace GabiCMontes\ApiGen;

use Illuminate\Support\ServiceProvider;

class ApiGenServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.api-gen', function ($app) {
            return $app['GabiCMontes\ApiGen\Commands\ApiGen'];
        });

        $this->commands([
            'command.api-gen',
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
