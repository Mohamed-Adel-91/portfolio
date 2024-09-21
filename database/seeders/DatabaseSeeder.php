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
            'first_name' => 'Mdp',
            'last_name' => 'Admin',
            'email' => 'mdp-admin@gmail.com',
            'password' => '0000',
        ]);
    }
}
