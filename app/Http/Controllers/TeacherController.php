<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('courses')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('teachers.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'specialization' => 'required|string',
            'bio' => 'nullable|string',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $teacher = Teacher::create($validated);

        if ($request->has('courses')) {
            $teacher->courses()->attach($request->courses);
        }

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully!');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('courses', 'students');
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $courses = Course::all();
        return view('teachers.edit', compact('teacher', 'courses'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'specialization' => 'required|string',
            'bio' => 'nullable|string',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $teacher->update($validated);

        if ($request->has('courses')) {
            $teacher->courses()->sync($request->courses);
        } else {
            $teacher->courses()->detach();
        }

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->courses()->detach();
        $teacher->students()->detach();
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}
