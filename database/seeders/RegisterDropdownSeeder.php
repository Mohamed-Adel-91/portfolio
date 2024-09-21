<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegisterDropdown;
use App\Enums\DropdownType;

class RegisterDropdownSeeder extends Seeder
{
    public function run()
    {
        $types = [
            DropdownType::ConsultationServices,
            DropdownType::TypeOfServices,
            DropdownType::PricePer,
            DropdownType::CountryOfOrigin,
            DropdownType::Unit,
            DropdownType::Delivery,
            DropdownType::Warranty,
            DropdownType::WarrantyBy,
        ];

        foreach ($types as $type) {
            RegisterDropdown::factory()->count(5)->create([
                'type' => $type,
                'is_approved' => true,
            ]);
        }
    }
}
