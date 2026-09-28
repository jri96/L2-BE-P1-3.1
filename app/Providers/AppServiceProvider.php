<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
     *
     * De rechten hangen af van de rol van de gebruiker: elke rol mag de
     * magazijnschermen bekijken, alleen Administrator mag schrijven.
     */
    public function boot(): void
    {
        Gate::define(
            'magazijn.voorraad-bijwerken',
            fn (User $user): bool => $user->isAdministrator()
        );

        Gate::define(
            'gebruiker.beheren',
            fn (User $user): bool => $user->isAdministrator()
        );
    }
}
