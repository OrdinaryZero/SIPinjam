<?php

namespace App\Providers;

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
    // Kode ini bakal ngecek: kalau link storage ga ada di server, dia bikin baru otomatis
    if (!file_exists(public_path('storage'))) {
        app('files')->link(storage_path('app/public'), public_path('storage'));
    }

    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
}
}
