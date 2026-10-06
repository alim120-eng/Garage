<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::firstOrCreate([
            'brand' => 'Toyota',
            'model' => 'Supra',
        ], [
            'type' => 'Car',
            'year' => 2024,
            'price' => 55000.00,
            'status' => 'available'
        ]);

        Vehicle::firstOrCreate([
            'brand' => 'BMW',
            'model' => 'M4',
        ], [
            'type' => 'Car',
            'year' => 2023,
            'price' => 78000.00,
            'status' => 'available'
        ]);
    }
}
