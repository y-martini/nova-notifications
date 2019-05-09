<?php

namespace SoluzioneSoftware\NovaNotifications;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class NovaNotificationsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/nova-notifications.php' => config_path('nova-notifications.php'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nova-notifications');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            // Add js
            Nova::script('ss-nova-notifications', __DIR__ . '/../dist/js/nova-notifications.js');

            Nova::provideToScript([
                'icon_path' => secure_asset(config('nova-notifications.icon_path')),
            ]);
        });

    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/nova-notifications.php', 'nova-notifications'
        );
    }
}
