<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        Gate::define('viewWebSocketsDashboard', function ($user = null) {
            return in_array($user->email, [
                'donkfather@yahoo.com'
            ]);
        });
    }
}
