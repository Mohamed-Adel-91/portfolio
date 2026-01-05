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
        Schema::table('debt_accounts', function (Blueprint $table) {
            $table->decimal('principal_balance', 12, 2)->default(0);
            $table->decimal('extra_balance', 12, 2)->default(0);
        });

        DB::table('debt_accounts')->update([
            'principal_balance' => DB::raw('current_balance'),
            'extra_balance' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('debt_accounts', function (Blueprint $table) {
            $table->dropColumn(['principal_balance', 'extra_balance']);
        });
    }
};
