<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MultipleChoiceOption>
 */
class MultipleChoiceOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option_text' => $this->faker->sentence,
            'is_correct' => $this->faker->boolean,
            'question_id' => \App\Models\Question::factory(),
        ];
    }

    /**
     * Indicate that the option is correct.
     *
     * @return \Database\Factories\MultipleChoiceOptionFactory
     */
    public function correct(): MultipleChoiceOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_correct' => true,
            ];
        });
    }

    /**
     * Indicate that the option is incorrect.
     *
     * @return \Database\Factories\MultipleChoiceOptionFactory
     */
    public function incorrect(): MultipleChoiceOptionFactory
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
     * @return \Database\Factories\MultipleChoiceOptionFactory
     */
    public function forQuestion(\App\Models\Question $question): MultipleChoiceOptionFactory
    {
        return $this->state(function (array $attributes) use ($question) {
            return [
                'question_id' => $question->id,
            ];
        });
    }
}
