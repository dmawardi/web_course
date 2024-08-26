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

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'question' => 'required',
    //         'option1' => 'required',
    //         'option2' => 'required',
    //         'option3' => 'required',
    //         'option4' => 'required',
    //         'correct_option' => 'required',
    //     ]);

    //     $question = new Question();
    //     $question->question = $request->question;
    //     $question->option1 = $request->option1;
    //     $question->option2 = $request->option2;
    //     $question->option3 = $request->option3;
    //     $question->option4 = $request->option4;
    //     $question->correct_option = $request->correct_option;
    //     $question->save();

    //     return redirect()->route('questions.index');
    // }

    public function show(Course $course, Chapter $chapter, Module $module, Question $question)
    {
        $course = Course::with(['chapters' => function ($query) {
            $query->orderBy('order');
        }, 'chapters.modules'=> function ($query){
            $query->orderBy('order');
        }])->findOrFail($course->id);
        // Find the other questions within the module
        $module = Module::with(['questions'=> function ($query) {
            $query->orderBy('order');
        }])->findOrFail($module->id);
        dump($course);

        return view('questions.show', compact('course', 'chapter', 'module', 'question'));
    }

    public function edit(Question $question)
    {
        $question = Question::find($question);
        return view('questions.edit', compact('question'));
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
