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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Fields
            $table->text('answer_text')->nullable();
            $table->boolean('is_correct')->nullable();
            // Foreign Keys
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('question_id')->constrained('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
