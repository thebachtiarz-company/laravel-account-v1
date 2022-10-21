<?php

namespace TheBachtiarz\Account;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\Account\Interfaces\Config\AccountConfigInterface;
use TheBachtiarz\Account\Providers\AppsProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function register(): void
    {
        /**
         * @var AppsProvider $appsProvider
         */
        $appsProvider = new AppsProvider;

        $appsProvider->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands($appsProvider->registerCommands());
        }
    }

    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/' . AccountConfigInterface::ACCOUNT_CONFIG_NAME . '.php' => config_path(AccountConfigInterface::ACCOUNT_CONFIG_NAME . '.php'),
            ], 'thebachtiarz-auth-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'thebachtiarz-auth-migrations');
        }
    }
}
