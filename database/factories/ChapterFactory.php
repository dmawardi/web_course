<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
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
            'course_id' => \App\Models\Course::factory(),
        ];
    }

    /**
     * Indicate that the chapter belongs to a course.
     *
     * @param int $courseId
     * @return \Database\Factories\ChapterFactory
     */
    public function forCourse(int $courseId): ChapterFactory
    {
        return $this->state(fn(array $attributes) => [
            'course_id' => $courseId,
        ]);
    }
}
