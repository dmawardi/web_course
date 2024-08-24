<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Course;
use \App\Models\Enrollment;
use \App\Models\Question;
use \App\Models\TextBoxAnswer;
use \App\Models\MultipleChoiceOption;
use \App\Models\Chapter;
use \App\Models\Module;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // For loop to create 10 courses created by the test user
        for ($i = 0; $i < 20; $i++) {
            $course = Course::factory()->create([
                'created_by' => $user->id,
            ]);

            // Enroll a user in the course
            Enrollment::factory()->create([
                'course_id' => $course->id,
            ]);

            // For loop to create 5 chapters for each course
            for ($j = 0; $j < 5; $j++) {
                $chapter = Chapter::factory()->create([
                    'course_id' => $course->id,
                ]);

                // For loop to create 3 modules for each chapter
                for ($k = 0; $k < 3; $k++) {
                    $module = Module::factory()->create([
                        'chapter_id' => $chapter->id,
                    ]);

                    // For loop to create 10 questions for each module
                    for ($l = 0; $l < 4; $l++) {
                        $question = Question::factory()->create([
                            'module_id' => $module->id,
                        ]);
                        // Randomly decide if the question is text-based or multiple choice
                        $isMultipleChoice = rand(0, 1) == 1;

                        // If multiple choice type question
                        if ($isMultipleChoice) {
                            // Create 3 multiple choice options for the question
                            for ($m = 0; $m < 3; $m++) {
                          
                                MultipleChoiceOption::factory()->create([
                                    'question_id' => $question->id,
                                ]);
                            }
                        } else {
                            // Create a text box answer for the question (if text_box type)
                            TextBoxAnswer::factory()->create([
                                'question_id' => $question->id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
