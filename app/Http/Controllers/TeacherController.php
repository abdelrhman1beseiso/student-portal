<?php

namespace App\Http\Controllers;


use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // List all teachers with their courses
    public function index()
    {
        $teachers = Teacher::with('courses')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    // Show teacher creation form
    public function create()
    {
        $courses = Course::all();
        return view('teachers.create', compact('courses'));
    }

    // Store a new teacher
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'specialization' => 'required|string',
            'bio' => 'nullable|string'
        ]);

        $teacher = Teacher::create($validated);

        // Assign courses if selected
        if ($request->has('courses')) {
            $teacher->courses()->attach($request->courses);
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher created successfully!');
    }

    // Show a single teacher's details
    public function show(Teacher $teacher)
    {
        $teacher->load('courses', 'students');
        return view('teachers.show', compact('teacher'));
    }

    // Show teacher edit form
    public function edit(Teacher $teacher)
    {
        $courses = Course::all();
        return view('teachers.edit', compact('teacher', 'courses'));
    }

    // Update a teacher
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,'.$teacher->id,
            'specialization' => 'required|string',
            'bio' => 'nullable|string'
        ]);

        $teacher->update($validated);

        // Sync courses (replace all assignments)
        if ($request->has('courses')) {
            $teacher->courses()->sync($request->courses);
        } else {
            $teacher->courses()->detach();
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully!');
    }

    // Delete a teacher
    public function destroy(Teacher $teacher)
    {
        $teacher->courses()->detach();
        $teacher->students()->detach();
        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }
}