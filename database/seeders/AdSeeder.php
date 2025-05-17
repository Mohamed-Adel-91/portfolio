<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad;
use App\Models\Domain;
use App\Enums\AdStatus;
use App\Models\User; // Assuming user exists

class AdSeeder extends Seeder
{
    public function run(): void
    {
        $domain = Domain::first();
        $userId = User::first()?->id;

        $ads = [
            ['title' => 'Buy Used Car', 'slug' => 'buy-used-car', 'text' => 'A very good car for sale.', 'phone' => '0123456789', 'status' => AdStatus::REVIEW->value],
            ['title' => 'House for Rent', 'slug' => 'house-for-rent', 'text' => '2-bedroom house.', 'phone' => '0112233445', 'status' => AdStatus::APPROVED->value],
            ['title' => 'iPhone 14 Pro', 'slug' => 'iphone-14-pro', 'text' => 'Brand new iPhone.', 'phone' => '0109988776', 'status' => AdStatus::CANCELLED->value],
        ];

        foreach ($ads as $ad) {
            Ad::create(array_merge($ad, [
                'domain_id' => $domain?->id,
                'user_id' => $userId,
            ]));
        }
    }
}
