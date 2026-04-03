<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Livewire\Blaze\Blaze;

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
        Vite::useBuildDirectory('themes/default');

        Blaze::optimize()
            ->in(resource_path('views/components/layout'))
            ->in(resource_path('views/components/ui'))
            ->in(resource_path('views/components/blocks'));

        /*Blaze::debug();*/
    }
}
