<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Blade::if('canPermission', function (string $permission): bool {
            return auth()->check() && auth()->user()->hasPermission($permission);
        });

        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->numbers();
        });
    }
}
