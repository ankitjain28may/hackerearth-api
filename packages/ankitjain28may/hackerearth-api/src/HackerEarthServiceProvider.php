<?php

namespace Ankitjain28may\HackerEarth;

use Illuminate\Support\ServiceProvider;

class HackerEarthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
        
        include __DIR__.'/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
