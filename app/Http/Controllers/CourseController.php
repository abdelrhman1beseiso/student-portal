<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

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
                'credits' => 'required|integer|min:1'
            ]);
    
            $course = Course::create($validated);
            
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
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'credits' => 'required|integer|min:1'
        ]);

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }   
}