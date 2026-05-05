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

        // Create one Admin account
        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'), // Set a secure password
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'password123',
            'role' => 'user',
        ]);
    }
}
