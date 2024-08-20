<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        // Use the Course model to get paginated courses with created_by user

        $courses = Course::with('creator')->paginate(10);
        return view('courses.index', [
            'courses' => $courses
        ]);
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
        $course = Course::find($course);
        return view('courses.show', compact('course'));
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
