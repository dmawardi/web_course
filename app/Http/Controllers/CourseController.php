<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Container\Attributes\Auth;

class CourseController extends Controller
{
    public function index()
    {
        // Grab user's ID
        $userId = auth()->id();
        // Use the Course model to get paginated courses that user has enrolled in
        $courses = Course::whereHas('enrollments', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->paginate(10)->appends(request()->query());
        // $courses = Course::with('creator')->paginate(10)->appends(request()->query());
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        return redirect()->route('courses.index');
    }

    public function show(Course $course)
    {
        // Grab the course and eager load the chapters sorted by order
        $course = Course::with(['chapters' => function ($query) {
            $query->orderBy('order');
        }, 'chapters.modules'=> function ($query){
            $query->orderBy('order');
        }])->findOrFail($course->id);

        // Generate next link
        $firstChapter = $course->chapters->first();
        $firstModule = $firstChapter->modules->first();
        $next = route('modules.show', [$course->id, $firstChapter->order, $firstModule->order]);
        return view('courses.show', [
            'course' => $course,
            'next' => $next
        ]);
    }

    public function edit(Course $course)
    {
        $course = Course::find($course);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $course = Course::find($id);
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        return redirect()->route('courses.index');
    }
}
