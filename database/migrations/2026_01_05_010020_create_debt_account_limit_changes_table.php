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
        Schema::create('debt_account_limit_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('debt_account_id')->constrained('debt_accounts')->cascadeOnDelete();
            $table->decimal('old_limit', 12, 2)->nullable();
            $table->decimal('new_limit', 12, 2);
            $table->dateTime('changed_at');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index('changed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debt_account_limit_changes');
    }
};
