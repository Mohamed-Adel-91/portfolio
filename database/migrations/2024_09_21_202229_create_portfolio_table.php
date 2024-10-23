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
        if (!Schema::hasTable('portfolio')) {
            Schema::create('portfolio', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('project_id');
                $table->string('title')->nullable();
                $table->string('sub_title')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();

                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('portfolio');
    }
};
