<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Maakt de inlogaccounts aan. Het wachtwoord van elk account is "password".
     *
     * Idempotent: accounts die al bestaan blijven ongewijzigd, zodat
     * `php artisan db:seed` zonder fouten opnieuw gedraaid kan worden.
     */
    public function run(): void
    {
        $accounts = [
            [
                'name' => 'Beheerder',
                'email' => 'admin@jamin.nl',
                'rolename' => 'Administrator',
            ],
            [
                'name' => 'Magazijnmedewerker',
                'email' => 'magazijn@jamin.nl',
                'rolename' => 'Magazijnmedewerker',
            ],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'rolename' => 'Magazijnmedewerker',
            ],
        ];

        foreach ($accounts as $account) {
            User::firstOrCreate(
                ['email' => $account['email']],
                array_merge($account, [
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ])
            );
        }
    }
}
