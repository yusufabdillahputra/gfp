<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.*', 'App\Http\Composers\AdminComposer');
        View::composer('landing.*', 'App\Http\Composers\LandingComposer');
        View::composer('otentikasi.*', 'App\Http\Composers\OtentikasiComposer');
    }
}
