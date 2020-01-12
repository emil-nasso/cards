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
        // A hack because laravel sets the scheme to the same as
        // the current request when generating url.
        // As we are behind traefik in production we need to force https.
        if (config('app.env') === 'prod') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
