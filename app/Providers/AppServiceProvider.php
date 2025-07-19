<?php

namespace App\Providers;

use App\Models\kamar;
use App\Observers\KamarObserver;
use Illuminate\Support\Facades\URL;
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
    public function boot(): void
    {
        kamar::observe(KamarObserver::class);
        // URL::forceScheme('https');
    }
}
