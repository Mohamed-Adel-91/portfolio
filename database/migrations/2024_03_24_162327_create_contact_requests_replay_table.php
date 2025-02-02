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
        Schema::create('contact_requests_replay', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_request_id');
            $table->string('reply_message')->nullable();
            $table->timestamps();

            $table->foreign('contact_request_id')->references('id')->on('contact_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_requests_replay');
    }
};
