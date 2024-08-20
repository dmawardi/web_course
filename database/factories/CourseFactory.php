<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'created_by' => User::factory(),
            'media_link' => $this->faker->url,
            'is_published' => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the course is published.
     *
     * @return \Database\Factories\CourseFactory
     */
    public function published(): CourseFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => true,
            ];
        });
    }

    /**
     * Indicate that the course is not published.
     *
     * @return \Database\Factories\CourseFactory
     */
    public function notPublished(): CourseFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => false,
            ];
        });
    }

    /**
     * Indicate that the course is created by a user.
     *
     * @param int $userId
     * @return \Database\Factories\CourseFactory
     */
    public function createdBy(int $userId): CourseFactory
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'created_by' => $userId,
            ];
        });
    }
}
