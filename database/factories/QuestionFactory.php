<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_text' => $this->faker->sentence,
            'question_type' => $this->faker->randomElement(['text_box', 'multiple_choice']),
            'order' => $this->faker->numberBetween(1, 25),
            'module_id' => \App\Models\Module::factory(),
            // Hints
            'has_hints' => $this->faker->boolean,
            'hint_1' => $this->faker->sentence,
            'hint_2' => $this->faker->sentence,
            'hint_3' => $this->faker->sentence,
        ];
    }
}
