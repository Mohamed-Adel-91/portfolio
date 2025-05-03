<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'first_name' => 'Mohamed',
            'last_name' => 'Adel',
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD'),
            'mobile' => '01067000662',
            'profile_picture' => 'images/profile.png',
        ]);

        $this->call(SettingsTableSeeder::class);
    }
}
