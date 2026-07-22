<?php

namespace App\Providers;

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
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $platformLinks = \App\Models\Setting::whereIn('key', ['link_gofood', 'link_grabfood', 'link_shopeefood'])
                    ->pluck('value', 'key')
                    ->toArray();
                \Illuminate\Support\Facades\View::share('platformLinks', $platformLinks);
            }
        } catch (\Exception $e) {
            // Ignore DB errors during boot
        }
    }
}
