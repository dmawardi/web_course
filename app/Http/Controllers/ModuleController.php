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
        // Grab the module, as well as the associated chapter and course
        $module = Module::with('chapter.course')->findOrFail($module->id);
        return view('modules.show', compact('course','chapter','module'));
    }
}
