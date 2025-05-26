<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Task;
use App\Models\Solution;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


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
        if (auth('student')->id() !== $student->id) {
        abort(403, 'Unauthorized action.');
    }
    
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
            'courses' => 'array',
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
            'new_password_confirmation' => 'nullable|required_with:new_password',
        ]);

        if ($request->filled('new_password')) {
            // Verify old password
            if (!Hash::check($request->old_password, $student->password)) {
                return back()->withErrors(['old_password' => 'The current password is incorrect.']);
            }
            
            // Update password
            $validated['password'] = Hash::make($request->new_password);
        }
        unset($validated['old_password'], $validated['new_password'], $validated['new_password_confirmation']);


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
    if (auth('student')->id() !== $student->id) {
        abort(403, 'Unauthorized action.');
    }
    
    return view('students.show', compact('student'));
}

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $student->courses()->detach();
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

       public function tasks(Student $student)
    {
        $tasks = Task::whereIn('course_id', $student->courses->pluck('id'))
                    ->with('teacher', 'course')
                    ->latest()
                    ->get();
        return view('students.tasks', compact('student', 'tasks'));
    }

    public function showTask(Student $student, Task $task)
    {
        $solutions = $student->solutions()->where('task_id', $task->id)->latest()->get();
        return view('students.task-show', compact('student', 'task', 'solutions'));
    }

    public function storeSolution(Request $request, Student $student, Task $task)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'file' => 'nullable|file|max:2048'
        ]);

        $isLate = Carbon::now()->gt($task->deadline);

        $solutionData = [
            'content' => $validated['content'],
            'is_late' => $isLate
        ];

        if ($request->hasFile('file')) {
            $solutionData['file_path'] = $request->file('file')->store('solutions');
        }

        $task->solutions()->create(array_merge($solutionData, [
            'student_id' => $student->id
        ]));

        return back()->with('success', 'Solution submitted successfully!');
    }
     public function downloadSolution(Solution $solution)
{
    if ($solution->student_id != auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    if ($solution->file_path && Storage::exists($solution->file_path)) {
        return Storage::download($solution->file_path);
    }

    return back()->with('error', 'File not found.');
}
}

