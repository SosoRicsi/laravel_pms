<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\UserRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

final class GatesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('admin', function () {
            return Auth::user()->role === UserRoles::ADMIN || Auth::user()->role === UserRoles::OWNER;
        });

        Gate::define('moderator', function () {
            return Auth::user()->role === UserRoles::MODERATOR;
        });

        Gate::define('partner', function () {
            return Auth::user()->role === UserRoles::PARTNER;
        });

        Gate::define('worker', function () {
            return Auth::user()->role === UserRoles::WORKER;
        });

        Gate::define('user', function () {
            return Auth::user()->role === UserRoles::USER;
        });
    }
}
