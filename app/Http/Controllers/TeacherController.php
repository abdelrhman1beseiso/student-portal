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

        public function tasks(Teacher $teacher)
    {
        $tasks = $teacher->tasks()->with('course')->latest()->get();
        return view('teachers.tasks', compact('teacher', 'tasks'));
    }

    public function createTask(Teacher $teacher)
{
    logger('Teacher ID: '.$teacher->id);
    $teacher->load('courses');
    logger('Courses count: '.$teacher->courses->count());
    logger('Courses: '.$teacher->courses->pluck('name'));
    $coursesFromDB = \DB::table('course_teacher')
        ->where('teacher_id', $teacher->id)
        ->get();
    logger('Pivot table entries: '.$coursesFromDB);

    return view('teachers.create-task', compact('teacher'));
}

    public function storeTask(Request $request, Teacher $teacher)
{
    $validated = $request->validate([
        'course_id' => 'required|exists:courses,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'deadline' => 'required|date|after:now'
    ]);

    // Verify the teacher actually teaches this course
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
      public function downloadTask(Task $task)
{
    if ($task->attachment_path && Storage::exists($task->attachment_path)) {
        return Storage::download($task->attachment_path);
    }

    return back()->with('error', 'File not found.');
}
    
}
