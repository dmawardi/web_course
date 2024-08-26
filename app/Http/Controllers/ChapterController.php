<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Chapter;

class ChapterController extends Controller
{
    public function show(Course $course, Chapter $chapter)
    {
        // Grab the chapter and eager load the modules
        $chapter = Chapter::with('modules')->where('id', $chapter->id)->firstOrFail($chapter);

        // reroute to the first module in the chapter
        return redirect()->route('modules.show', [
            'course' => $course,
            'chapter' => $chapter,
            'module' => $chapter->modules->first()
        ]);
    }
}
