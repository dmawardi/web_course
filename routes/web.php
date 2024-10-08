<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Must be logged in to access these routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

    // Chapters
    Route::get('/courses/{course}/chapters/{chapter}', [ChapterController::class, 'show'])->name('chapters.show');
    // Modules
    Route::get('/courses/{course}/chapters/{chapter}/module/{module}', [ModuleController::class, 'show'])->name('modules.show');
    // Questions
    Route::get('/courses/{course}/chapters/{chapter}/module/{module}/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
});

// Admin
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');

require __DIR__.'/auth.php';
