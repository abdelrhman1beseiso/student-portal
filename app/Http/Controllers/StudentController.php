<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->paginate(6);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('students.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'dob' => 'required|date',
            'address' => 'required|string',
            'password' => 'required|string|min:6',
            'courses' => 'array'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $student = Student::create($validated);

        if ($request->has('courses')) {
            $student->courses()->attach($request->courses, ['enrolled_at' => now()]);
        }

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        $courses = Course::all();
        return view('students.edit', compact('student', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'dob' => 'required|date',
            'address' => 'required|string',
            'password' => 'nullable|string|min:6',
            'courses' => 'array'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $student->update($validated);

        if ($request->has('courses')) {
            $student->courses()->syncWithPivotValues(
                $request->courses,
                ['enrolled_at' => now()]
            );
        } else {
            $student->courses()->detach();
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $student->courses()->detach();
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
