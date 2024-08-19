<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAnswer>
 */
class UserAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::factory()->create();
        $question = \App\Models\Question::factory()->create();
        return [
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer_text' => $this->faker->sentence,
            'is_correct' => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the user answer is correct.
     *
     * @return \Database\Factories\UserAnswerFactory
     */
    public function correct(): UserAnswerFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_correct' => true,
            ];
        });
    }

    /**
     * Indicate that the user answer is incorrect.
     *
     * @return \Database\Factories\UserAnswerFactory
     */
    public function incorrect(): UserAnswerFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_correct' => false,
            ];
        });
    }

    /**
     * Indicate that the user answer is for a specific question.
     *
     * @param \App\Models\Question $question
     * @return \Database\Factories\UserAnswerFactory
     */
    public function forQuestion(\App\Models\Question $question): UserAnswerFactory
    {
        return $this->state(function (array $attributes) use ($question) {
            return [
                'question_id' => $question->id,
            ];
        });
    }

    /**
     * Indicate that the user answer is for a specific user.
     *
     * @param \App\Models\User $user
     * @return \Database\Factories\UserAnswerFactory
     */
    public function forUser(\App\Models\User $user): UserAnswerFactory
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }
}
