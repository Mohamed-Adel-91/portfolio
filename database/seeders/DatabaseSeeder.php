<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'email' => 'mohamed-admin-panel@portfolio.com',
            'password' => '0000',
            'mobile' => '01067000662',
            'profile_picture' => 'images/profile.png',
        ]);
    }
}
