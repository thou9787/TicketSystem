<?php

namespace App\Providers;

use Illuminate\Http\Request;
use App\ApiRequest\PTXRequest;
use Illuminate\Support\ServiceProvider;

class PTXServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\ApiRequest\PTXRequest',
            function ($app) {
                return new PTXRequest($app->make(Request::class));
            }
        );
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
