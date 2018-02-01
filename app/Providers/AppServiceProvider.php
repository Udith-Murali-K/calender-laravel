<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        app()->router->aliasMiddleware('admin_menu', \App\Http\Middleware\AdminMenuMiddleware::class);
        app()->router->aliasMiddleware('admin_auth', \Illuminate\Auth\Middleware\Authenticate::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
