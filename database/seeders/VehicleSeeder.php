<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    

public function run(): void
{
    Vehicle::create([
        'type' => 'Car',
        'brand' => 'Toyota',
        'model' => 'Supra',
        'year' => 2024,
        'price' => 55000.00,
        'status' => 'available'
    ]);

    Vehicle::create([
        'type' => 'Car',
        'brand' => 'BMW',
        'model' => 'M4',
        'year' => 2023,
        'price' => 78000.00,
        'status' => 'available'
    ]);
}
}
