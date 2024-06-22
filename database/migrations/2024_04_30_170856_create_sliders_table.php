<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sliders')) {
            Schema::create('sliders', function (Blueprint $table) {
                $table->id();
                $table->string('pageName');
                $table->string('sectionName');
                $table->integer('slider_no');
                $table->enum('show_status', ['Active', 'Inactive'])->default('Active');
                $table->string('image');
                $table->json('title')->nullable();
                $table->json('description')->nullable();
                $table->string('btn_url')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('sliders', function (Blueprint $table) {
                $table->json('title')->nullable()->change();
                $table->json('description')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};