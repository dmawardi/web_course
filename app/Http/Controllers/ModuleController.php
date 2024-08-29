<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function show(Course $course, $chapterOrder, $moduleOrder)
    {
         // Find the course with chapters and modules
         $course = Course::with(['chapters' => function ($query) {
            $query->orderBy('order');
        }, 'chapters.modules'=> function ($query){
            // Find the modules with questions
            $query->orderBy('order')->with(['questions'=> function ($query) {
                $query->orderBy('order');
            }]);
        }])->firstOrFail();
        // Find the chapter given the chapter order and course id
        $chapter = Chapter::where('course_id', $course->id)->where('order', $chapterOrder)->with(['modules'=> function ($query) {
            $query->orderBy('order');
        }, 'modules.questions' => function ($query) {
            $query->orderBy('order');
        }])->firstOrFail();
        // Find the other questions within the module
        $module = Module::where('chapter_id', $chapter->id)->where('order', $moduleOrder)->with(['questions'=> function ($query) {
            $query->orderBy('order');
        }])->firstOrFail();

        // Build links
        $next = $this->getNextLink($chapter, $module);
        $previous = $this->getPreviousLink($course, $chapter, $module);

        return view('modules.show', [
            'course'=>$course, 
            'chapter'=>$chapter, 
            'module'=>$module,
            'next'=>$next,
            'previous'=>$previous
        ]);
    }

    private function getNextLink($chapter, $module) {
        // Get the first question of the current module
        return route('questions.show', [$chapter->course_id, $chapter->order, $module->order, $module->questions->first()->order]);
    }

    private function getPreviousLink($course, $chapter, $module) {
         // Get the first module of the course
        $firstModule = $course->chapters->first()->modules->first();
        // If the current module is the first module of the course, return null
        if ($module->id == $firstModule->id) {
            return null;
        }

        // Determine if the current module is the first in the chapter
        $isFirstModuleInChapter = $module->id == $chapter->modules->first()->id;
        // If it's the first module in the chapter, get the last question of the last module of the previous chapter
        if ($isFirstModuleInChapter) {
            // Get the previous chapter
            $courseChapters = $course->chapters;
            $currentChapterIndex = $this->findIndexOfObjectById($courseChapters, $chapter->id);
            $previousChapter = $courseChapters[$currentChapterIndex - 1];

            // Get the last question of the last module of the previous chapter
            $previousModule = $previousChapter->modules->last();
            $previousQuestion = $previousModule->questions->last();

            return route('questions.show', [$course->id, $previousChapter->order, $previousModule->order, $previousQuestion->order]);
        } else {
            // In the current chapter, get the previous module's final question
            $chapterModules = $chapter->modules;
            // Find the index of the current chapter
            $currentModuleIndex = $this->findIndexOfObjectById($chapterModules, $module->id);
            // Obtain the previous module and grab the final question
            $previousModule = $chapterModules[$currentModuleIndex - 1];
            $previousQuestion = $previousModule->questions->last();

            return route('questions.show', [$course->id, $chapter->order, $previousModule->order, $previousQuestion->order]);
        }
    
    }
    private function findIndexOfObjectById($array, $id)
    {
        foreach ($array as $key => $value) {
            if ($value->id == $id) {
                return $key;
            }
        }
    }
}
