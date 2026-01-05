<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('debt_transactions', function (Blueprint $table) {
            $table->enum('bucket', ['principal', 'extra'])->default('principal');
        });

        DB::table('debt_transactions')->update([
            'bucket' => 'principal',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('debt_transactions', function (Blueprint $table) {
            $table->dropColumn('bucket');
        });
    }
};
