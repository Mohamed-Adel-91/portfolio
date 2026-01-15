<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('todo_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->text('description')->nullable();
            $table->foreignId('todo_category_id')
                ->nullable()
                ->constrained('todo_categories')
                ->nullOnDelete();
            $table->string('status', 20)->default('open');
            $table->string('quadrant', 20)->default('do');
            $table->unsignedTinyInteger('stars')->default(3);
            $table->date('due_date')->nullable();
            $table->date('scheduled_date')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('todo_category_id');
            $table->index('status');
            $table->index('quadrant');
            $table->index('scheduled_date');
            $table->index('due_date');
            $table->index('stars');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('todo_tasks');
    }
};
