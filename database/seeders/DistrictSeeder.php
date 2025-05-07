<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\City;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            'Cairo' => ['Nasr City', 'Maadi', 'Heliopolis'],
            'Alexandria' => ['Sidi Gaber', 'Stanley'],
            'Giza' => ['Dokki', 'Mohandessin'],
            'Mansoura' => ['El Senbellawein', 'Talkha'],
            'Aswan' => ['Kom Ombo', 'Edfu'],
        ];

        foreach ($districts as $cityName => $cityDistricts) {
            $city = City::where('name', $cityName)->first();

            if ($city) {
                foreach ($cityDistricts as $districtName) {
                    District::create([
                        'city_id' => $city->id,
                        'name' => $districtName,
                    ]);
                }
            }
        }
    }
}
