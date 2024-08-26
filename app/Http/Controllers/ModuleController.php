<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function show(Course $course, Chapter $chapter, Module $module)
    {
        $course = Course::with(['chapters' => function ($query) {
            $query->orderBy('order');
        }, 'chapters.modules'=> function ($query){
            $query->orderBy('order');
        }])->findOrFail($course->id);
        // Grab the module, as well as the associated questions
        $module = Module::with(['questions'=> function ($query) {
            $query->orderBy('order');
        }])->findOrFail($module->id);
        dump($module);
        return view('modules.show', compact('course','chapter','module'));
    }
}
