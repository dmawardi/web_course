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
        }])->findOrFail($course->id);
        // Find the chapter given the chapter order and course id
        $chapter = Chapter::where('course_id', $course->id)->where('order', $chapterOrder)->with(['modules'=> function ($query) {
            $query->orderBy('order');
        }])->firstOrFail();
        // Find the other questions within the module
        $module = Module::where('chapter_id', $chapter->id)->where('order', $moduleOrder)->with(['questions'=> function ($query) {
            $query->orderBy('order');
        }])->firstOrFail();
        
        // Build previous link
        // $previous = $this->getPreviousLink($course, $chapter, $module);
        return view('modules.show', ['course'=>$course, 'chapter'=>$chapter, 'module'=>$module]);
    }

    private function getNextLink($module) {
        // Get the first question of the current module
        $firstQuestion = $module->questions->first();
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

        if ($isFirstModuleInChapter) {
            // Get the previous chapter
            $courseChapters = $course->chapters;
            // Iterate through the chapters to get the previous chapter
            foreach ($courseChapters as $key => $courseChapter) {
                // If the current chapter is found, get the previous chapter
                if ($courseChapter->id == $chapter->id) {
                    $previousChapter = $courseChapters[$key - 1];
                    break;
                }
            }        

            // Get the last module and question of the previous chapter
            $previousModule = $previousChapter->modules->last();
            $previousQuestion = $previousModule->questions->last();

            return route('questions.show', [$course->id, $previousChapter->order, $previousModule->order, $previousQuestion->order]);
        } else {
            // Get the previous module's final question within the current chapter
            $chapterModules = $chapter->modules;
            $currentModuleIndex = $this->findIndexOfObjectById($chapterModules, $module->id);
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
