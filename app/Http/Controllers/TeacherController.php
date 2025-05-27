<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class TeacherController extends Controller
{
    public function index()
{
    if (!auth()->check() || !auth()->user()->is_admin) {
        abort(403, 'Administrator access only');
    }

    $teachers = Teacher::with('courses')->paginate(10);
    return view('teachers.index', compact('teachers'));
}

public function create()
{
    if (!auth()->check() || !auth()->user()->is_admin) {
        abort(403, 'Only administrators can create new teacher accounts.');
    }

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
    if (auth('teacher')->id() !== $teacher->id) {
        abort(403, 'Unauthorized action.');
    }
    
    $teacher->load('courses', 'students');
    return view('teachers.show', compact('teacher'));
}

public function edit(Teacher $teacher)
{
    if (auth('teacher')->id() !== $teacher->id) {
        abort(403, 'Unauthorized action.');
    }
    
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
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
            'new_password_confirmation' => 'nullable|required_with:new_password',
        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $teacher->password)) {
                return back()->withErrors(['old_password' => 'The current password is incorrect.']);
            }
            $validated['password'] = Hash::make($request->new_password);
        }
        unset($validated['old_password'], $validated['new_password'], $validated['new_password_confirmation']);

        $teacher->update($validated);

        if ($request->has('courses')) {
            $teacher->courses()->sync($request->courses);
        } else {
            $teacher->courses()->detach();
        }

        return redirect()->route('teacher.dashboard')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
{
    if (auth('teacher')->id() !== $teacher->id) {
        abort(403, 'Unauthorized action.');
    }
    $teacher->courses()->detach();
    $teacher->students()->detach();
    $teacher->delete();

    auth('teacher')->logout();
    
    return redirect()->route('welcome')
           ->with('success', 'Your account has been deleted successfully!');
}

        public function tasks(Teacher $teacher)
    {
        $tasks = $teacher->tasks()->with('course')->latest()->get();
        return view('teachers.tasks', compact('teacher', 'tasks'));
    }

    public function createTask(Teacher $teacher)
    {
        if (auth('teacher')->id() !== $teacher->id) {
            abort(403, 'Unauthorized action.');
        }
    
        $teacher->load(['courses' => function ($query) {
            $query->select('courses.id', 'courses.title');
        }]);
    
        return view('teachers.create-task', [
            'teacher' => $teacher,
            'courses' => $teacher->courses
        ]);
    }

    public function storeTask(Request $request, Teacher $teacher)
{
    $validated = $request->validate([
        'course_id' => 'required|exists:courses,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'deadline' => 'required|date|after:now'
    ]);

    if (!$teacher->courses->contains($validated['course_id'])) {
        return back()->withErrors(['course_id' => 'You are not assigned to this course']);
    }

    $teacher->tasks()->create($validated);

    return redirect()->route('teachers.tasks', $teacher)
                    ->with('success', 'Task created successfully!');
}


    public function showTask(Teacher $teacher, Task $task)
    {
        $solutions = $task->solutions()->with('student')->latest()->get();
        return view('teachers.task-show', compact('teacher', 'task', 'solutions'));
    }

    public function destroyTask(Teacher $teacher, Task $task)
    {
        $task->delete();
        return redirect()->route('teachers.tasks', $teacher)
                         ->with('success', 'Task deleted successfully!');
    }
    public function downloadSolution(Teacher $teacher, Solution $solution)
{
    if (auth('teacher')->id() !== $teacher->id || 
        $teacher->id !== $solution->task->teacher_id) {
        abort(403, 'Unauthorized action.');
    }

    if ($solution->file_path && Storage::exists($solution->file_path)) {
        return Storage::download($solution->file_path);
    }

    return back()->with('error', 'File not found.');
}   
    
}
