<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('life_goal_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('life_goal_category_id')
                ->constrained('life_goal_categories')
                ->cascadeOnDelete();
            $table->string('title', 160);
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->decimal('target_amount_egp', 14, 2);
            $table->boolean('allow_overdraft')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['life_goal_category_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('life_goal_items');
    }
};
