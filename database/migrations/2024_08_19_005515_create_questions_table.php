<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Fields
            $table->enum('question_type', ['multiple_choice', 'text_box']);
            $table->text('question_text');
            $table->integer('order');
            // Hints
            $table->boolean('has_hints')->default(false);
            $table->text('hint_1')->nullable();
            $table->text('hint_2')->nullable();
            $table->text('hint_3')->nullable();
            // Foreign Keys
            $table->foreignId('module_id')->constrained('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
