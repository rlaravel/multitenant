<?php

namespace MorenoRafael\MultiTenant\Providers;

use Illuminate\Support\ServiceProvider;
use MorenoRafael\MultiTenant\Console\Commands\Migrate;
use MorenoRafael\MultiTenant\Console\Commands\Migration;
use MorenoRafael\MultiTenant\Console\Commands\Models;
use MorenoRafael\MultiTenant\Database;

/**
 * Class MultiTenantServiceProvider
 * @package MorenoRafael\MultiTenant\Providers
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
        $this->app->bind('MorenoRafael.tenant', function () {
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
                Models::class,
                Migration::class,
                Migrate::class
            ]);
        }
    }
}
