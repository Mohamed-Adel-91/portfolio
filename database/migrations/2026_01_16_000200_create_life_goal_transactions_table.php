<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('life_goal_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('life_goal_item_id')
                ->constrained('life_goal_items')
                ->cascadeOnDelete();
            $table->string('type', 20);
            $table->decimal('amount_egp', 14, 2);
            $table->string('note', 255)->nullable();
            $table->date('occurred_at');
            $table->timestamps();

            $table->index(['life_goal_item_id', 'type']);
            $table->index('occurred_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('life_goal_transactions');
    }
};
