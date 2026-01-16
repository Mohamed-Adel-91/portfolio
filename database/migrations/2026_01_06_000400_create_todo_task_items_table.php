<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('todo_task_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('todo_task_id')
                ->constrained('todo_tasks')
                ->cascadeOnDelete();
            $table->string('title', 220);
            $table->text('description')->nullable();
            $table->string('status', 20)->default('open');
            $table->date('scheduled_date')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('todo_task_id');
            $table->index('status');
            $table->index('scheduled_date');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('todo_task_items');
    }
};
