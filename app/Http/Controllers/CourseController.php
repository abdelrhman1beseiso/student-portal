<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('students')->paginate(6);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'credits' => 'required|integer|min:1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
    
            $course = new Course($validated);
            
            if ($request->hasFile('image')) {
                $course->image = $request->file('image')->store('courses', 'public');
            }

            $course->save();
            
            return redirect()->route('courses.index')
                   ->with('success', 'Course created successfully');
                   
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withInput()
                   ->withErrors(['error' => 'Database error: '.$e->getMessage()]);
        } catch (\Exception $e) {
            return back()->withInput()
                   ->withErrors(['error' => 'An error occurred: '.$e->getMessage()]);
        }
    }

    public function show($id)
    {
        $course = Course::with('students')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function edit($id)
{
    $course = Course::findOrFail($id);
    
    // Check if the authenticated teacher owns this course
    if (!auth('teacher')->check() || !$course->teachers()->where('teacher_id', auth('teacher')->id())->exists()) {
        abort(403, 'Unauthorized action.');
    }
    
    return view('courses.edit', compact('course'));
}

    public function update(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'credits' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $course = Course::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $course->image = $request->file('image')->store('courses', 'public');
        } elseif ($request->has('remove_image') && $request->remove_image == 1) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
                $course->image = null; 
            }
        }
        $course->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'credits' => $validated['credits'],
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');

    } catch (\Exception $e) {
        return back()->withInput()
                   ->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}


public function destroy($id)
{
    $course = Course::findOrFail($id);
    
    // Authorization check
    if (!auth('teacher')->check() || !$course->teachers()->where('teacher_id', auth('teacher')->id())->exists()) {
        abort(403, 'Unauthorized action.');
    }
    
    // Delete associated image if exists
    if ($course->image) {
        Storage::disk('public')->delete($course->image);
    }
    
    $course->delete();

    return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
} 
}