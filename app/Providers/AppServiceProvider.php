<?php

namespace App\Providers;

use App\Models\Retoma;
use App\Models\Retoma2;
use App\Observers\RetomaObserver;
use App\Observers\Retoma2Observer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Retoma::observe(RetomaObserver::class);
        Retoma2::observe(Retoma2Observer::class);


    }

}
