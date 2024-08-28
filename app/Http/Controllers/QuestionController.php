<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Module;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return view('questions.index');
    }

    public function create()
    {
        return view('questions.create');
    }

    public function show(Course $course, $chapterOrder, $moduleOrder, $questionOrder)
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

        $question = Question::where('module_id', $module->id)->where('order', $questionOrder)->firstOrFail();

        // Previous link
        $previous = $this->getPreviousLink($course, $chapter, $module, $question);

        // Next link
        $next = $this->getNextLink($course, $chapter, $module, $question);

        return view('questions.show', [
        'course'=>$course,
        'chapter' => $chapter,
        'module' => $module,
        'question' => $question,
        'previous' => $previous,
        'next' => $next
    ]);
    }

    private function getPreviousLink($course, $chapter, $module, $question)
    {
        // Previous link
        // If the question is the first question in the module, there is no previous question
        if ($question->id == $module->questions->first()->id) {
            // Set previous link to module content page
            $previous = route('modules.show', [$course->id, $chapter->id, $module->id]);
        } else {
            // Else, there's a previous question
            // Iterate through the module's questions to find the previous question
            foreach ($module->questions as $key => $moduleQuestion) {
                // If the current question is found, grab the previous question
                if ($moduleQuestion->id == $question->id) {
                    $previous = route('questions.show', [$course->id, $chapter->id, $module->id, $module->questions[$key - 1]->order]);
                }
            }
        }

        return $previous;
    }

    private function getNextLink($course, $chapter, $module, $question)
    {
        // Determine the next link
        if ($question->id == $module->questions->last()->id) {
            // If the question is the last in the module
            if ($module->id == $chapter->modules->last()->id) {
                // & If the module is the last in the chapter
                if ($chapter->id == $course->chapters->last()->id) {
                    // & If the chapter is the last in the course, set next to the complete course page
                    $next = null;
                } else {
                    // Otherwise, go to the first module of the next chapter
                    $currentChapterIndex = $this->findIndexOfObjectById($course->chapters, $chapter->id);
                    $nextChapter = $course->chapters[$currentChapterIndex + 1];
                    $nextModule = $nextChapter->modules->first();
                    $next = route('modules.show', [$course->id, $nextChapter->order, $nextModule->order]);
                }
            } else {
                // Otherwise, go to the next module in the current chapter
                $currentModuleIndex = $this->findIndexOfObjectById($chapter->modules, $module->id);
                $nextModule = $chapter->modules[$currentModuleIndex + 1];
                $next = route('modules.show', [$course->id, $chapter->id, $nextModule->id]);
            }
        } else {
            // Otherwise, go to the next question in the current module
            $moduleQuestions = $module->questions;
            // Search questions for index of current question
            $currentQuestionIndex = $this->findIndexOfObjectById($moduleQuestions, $question->id);
            $nextQuestion = $moduleQuestions[$currentQuestionIndex+1];
            $next = route('questions.show', [$course->id, $chapter->id, $module->order, $nextQuestion->order]);
        }

        return $next;
    }

    public function edit(Question $question)
    {
        $question = Question::find($question);
        return view('questions.edit', compact('question'));
    }

    private function findIndexOfObjectById($array, $id)
    {
        foreach ($array as $key => $value) {
            if ($value->id == $id) {
                return $key;
            }
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'question' => 'required',
    //         'option1' => 'required',
    //         'option2' => 'required',
    //         'option3' => 'required',
    //         'option4' => 'required',
    //         'correct_option' => 'required',
    //     ]);

    //     $question = Question::find($id);
    //     $question->question = $request->question;
    //     $question->option1 = $request->option1;
    //     $question->option2 = $request->option2;
    //     $question->option3 = $request->option3;
    //     $question->option4 = $request->option4;
    //     $question->correct_option = $request->correct_option;
    //     $question->save();

    //     return redirect()->route('questions.index');
    // }

    public function destroy(Question $question)
    {
        $question = Question::find($question);
        $question->delete();
        return redirect()->route('questions.index');
    }
}
