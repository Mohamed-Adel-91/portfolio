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
        Schema::create('debt_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('debt_account_id')->constrained('debt_accounts')->cascadeOnDelete();
            $table->enum('type', ['payment', 'charge', 'interest', 'fee', 'adjustment', 'installment_generated']);
            $table->enum('direction', ['increase', 'decrease']);
            $table->decimal('amount', 12, 2);
            $table->date('transaction_date');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index('transaction_date');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debt_transactions');
    }
};
