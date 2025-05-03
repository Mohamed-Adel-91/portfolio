<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'email' => 'example@example.com',
            'slogan' => 'Your trusted partner.',
            'address' => '123 Main St, Cairo, Egypt',
            'phone1' => '+201234567890',
            'phone2' => '+201112223334',
            'whats_up' => '+201234567890',
            'facebook' => 'https://facebook.com/example',
            'messenger' => 'https://m.me/example',
            'twitter' => 'https://twitter.com/example',
            'instagram' => 'https://instagram.com/example',
            'youtube' => 'https://youtube.com/example',
            'linkedin' => 'https://linkedin.com/company/example',
            'github' => 'https://github.com/example',
            'meta_title' => 'Welcome to Our Website',
            'meta_description' => 'We provide top-tier services to meet your needs.',
            'meta_tags' => 'web, services, company, example',
            'customers' => 1500,
        ]);
    }
}
