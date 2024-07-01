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
        $this->commands([
            \GabiCMontes\ApiGen\Commands\ApiGen::class,
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
