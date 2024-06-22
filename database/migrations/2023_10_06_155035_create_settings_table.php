<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->longText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_tags')->nullable();
            $table->integer('cards')->nullable();
            $table->integer('transactions')->nullable();
            $table->integer('countries')->nullable();
            $table->integer('decades')->nullable();
            $table->integer('customers')->nullable();
        });

        DB::table('settings')->insert([
            'email' => 'dummy@example.com',
            'address' => '123 Main St',
            'phone' => '555-1234',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'instagram' => 'https://instagram.com',
            'linkedin' => 'https://linkedin.com',
            'meta_title' => 'My Website',
            'meta_description' => 'Welcome to my website.',
            'meta_tags' => 'laravel, web development',
            'cards' => 100,
            'transactions' => 500,
            'countries' => 10,
            'decades' => 5,
            'customers' => 1000,
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
