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
        
        Schema::create('textbox_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Fields
            $table->text('expected_answer')->nullable();
            $table->text('alternative_answer')->nullable();
            // Foreign Keys
            $table->foreignId('question_id')->constrained('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('textbox_answers');
    }
};
