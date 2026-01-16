<?php

namespace Database\Seeders;

use App\Models\CurrencyRate;
use Illuminate\Database\Seeder;

class CurrencyRatesSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            ['code' => 'USD', 'rate_to_egp' => '50.000000', 'is_active' => true],
            ['code' => 'SAR', 'rate_to_egp' => '13.300000', 'is_active' => true],
        ];

        foreach ($defaults as $rate) {
            CurrencyRate::updateOrCreate(
                ['code' => $rate['code']],
                ['rate_to_egp' => $rate['rate_to_egp'], 'is_active' => $rate['is_active']]
            );
        }
    }
}
