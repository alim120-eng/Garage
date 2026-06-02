<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::factory()->create([
            'name' => 'qlima',
            'email' => 'alimouninou554@gmail.com',
            'role' => 'admin',
            'password' => '1234567899', // Auto-hashed via model casts
        ]);

        // 3. Seed Vehicles
        $this->call(VehicleSeeder::class);
    }
}

