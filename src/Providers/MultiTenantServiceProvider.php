<?php

namespace RafaelMorenoJS\MultiTenant\Providers;

use Illuminate\Support\ServiceProvider;
use RafaelMorenoJS\MultiTenant\Console\Commands\Models;
use RafaelMorenoJS\MultiTenant\Database;

/**
 * Class MultiTenantServiceProvider
 * @package RafaelMorenoJS\MultiTenant\Providers
 */
class MultiTenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('tenant', function () {
            return new Database;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../../config/tenant.php' => config_path('tenant.php')
            ], 'config');

            $this->publishes([
                __DIR__ . '/../../database/migrations' => database_path('migrations')
            ], 'migrations');

            $this->commands([
                Models::class
            ]);
        }
    }
}
