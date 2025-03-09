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
        foreach (UserRoles::cases() as $role) {
            Gate::define(strtolower($role->value), function () use ($role) {
                return Auth::user()->role->level() >= $role->level();
            });
        }
    }
}
