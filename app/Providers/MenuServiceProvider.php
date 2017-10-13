<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\View;

/**
 * Class MenuServiceProvider
 * @package App\Providers
 */
class MenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', 'App\Widgets\Navbar');
        //View::composer('*', 'App\Widgets\TopUsers');
    }

    public function register()
    {

    }
}