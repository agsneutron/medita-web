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
        // Configuration dates in spanish
//        Carbon::setUTF8(true);
//        Carbon::setlocale('es');
        setlocale(LC_ALL, 'es_US.utf8');
        //\URL::forceScheme('https');
    }
}
