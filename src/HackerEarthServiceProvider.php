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
        $this->handleConfigs();
        $this->handleMigrations();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('hackerearth', function ($app) {
            return new HackerEarth($app['config']->get('hackerearth'));
        });

        $this->app->alias('hackerearth', HackerEarth::class);
    }

    private function handleConfigs() {

        $configPath = realpath(__DIR__ . '/../config/hackerearth.php');

        $this->publishes([
            $configPath => config_path('hackerearth.php')
        ]);

        $this->mergeConfigFrom($configPath, 'hackerearth');
    }

    private function handleMigrations()
    {
        $migrationPath = realpath(__DIR__ . '/migrations');

        $this->publishes([
            $migrationPath => base_path('database/migrations'),
        ]);

        // $this->loadMigrationsFrom($migrationPath);


    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [
            'hackerearth'
        ];
    }
}
