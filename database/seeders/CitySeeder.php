<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = ['Cairo', 'Alexandria', 'Giza', 'Mansoura', 'Aswan'];

        foreach ($cities as $cityName) {
            City::create(['name' => $cityName]);
        }
    }
}
