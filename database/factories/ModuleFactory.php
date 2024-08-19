<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
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
            'order' => $this->faker->numberBetween(1, 25),
        ];
    }

    /**
     * Indicate that the module belongs to a course.
     *
     * @param int $courseId
     * @return \Database\Factories\ModuleFactory
     */
    public function forCourse(int $courseId): ModuleFactory
    {
        return $this->state(fn(array $attributes) => [
            'course_id' => $courseId,
        ]);
    }
}
