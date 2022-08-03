<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CarService', 'App\Services\CarService');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
