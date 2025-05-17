<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'first_name' => 'Mohamed',
            'last_name' => 'Adel',
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD'),
            'mobile' => '01067000662',
            'profile_picture' => 'images/profile.png',
        ]);

        $this->call([
            UserSeeder::class,
            SettingsTableSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
            DomainSeeder::class,
            AdSeeder::class,
            MediaSeeder::class,
        ]);
    }
}
