<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TextBoxAnswer>
 */
class TextBoxAnswerFactory extends Factory
{
    // Explicitly define the model's class
    protected $model = \App\Models\TextBoxAnswer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alternative_answer' => $this->faker->sentence,
            'expected_answer' => $this->faker->sentence,
            'question_id' => \App\Models\Question::factory(),
        ];
    }

    /**
     * Indicate that the answer is correct.
     *
     * @return \Database\Factories\TextBoxAnswerFactory
     */
    public function correct(): TextBoxAnswerFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_correct' => true,
            ];
        });
    }

    /**
     * Indicate that the answer is incorrect.
     *
     * @return \Database\Factories\TextBoxAnswerFactory
     */
    public function incorrect(): TextBoxAnswerFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_correct' => false,
            ];
        });
    }

    /**
     * For the given question.
     * 
     * @return \Database\Factories\TextBoxAnswerFactory
     */
    public function forQuestion(\App\Models\Question $question): TextBoxAnswerFactory
    {
        return $this->state(function (array $attributes) use ($question) {
            return [
                'question_id' => $question->id,
            ];
        });
    }
}
