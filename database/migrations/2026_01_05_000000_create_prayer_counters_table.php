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
        if (!Schema::hasTable('prayer_counters')) {
            Schema::create('prayer_counters', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id');
                $table->unsignedInteger('alfajr')->default(0);
                $table->unsignedInteger('alzuhr')->default(0);
                $table->unsignedInteger('alasr')->default(0);
                $table->unsignedInteger('almaghrib')->default(0);
                $table->unsignedInteger('aleisha')->default(0);
                $table->date('last_incremented_on')->nullable();
                $table->timestamps();

                $table->unique('admin_id');
                $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('prayer_counters');
    }
};
