<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Account voor de magazijnmedewerker uit de user stories (wachtwoord: "password").
        User::factory()->create([
            'name' => 'Magazijnmedewerker',
            'email' => 'magazijn@jamin.nl',
            'rolename' => 'Magazijnmedewerker',
        ]);
    }
}
