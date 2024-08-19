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
        Schema::create('multiple_choice_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Fields
            $table->string('option_text');
            $table->boolean('is_correct');
            // Foreign Keys
            $table->foreignId('question_id')->constrained('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiple_choice_options');
    }
};
