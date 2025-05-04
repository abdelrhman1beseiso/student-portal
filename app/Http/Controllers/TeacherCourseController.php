<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherCourseController extends Controller
{
    // Assign a teacher to a course
    public function assignTeacherToCourse(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'course_id' => 'required|exists:courses,id'
        ]);

        $teacher = Teacher::find($request->teacher_id);
        $teacher->courses()->attach($request->course_id);

        return back()->with('success', 'Teacher assigned to course!');
    }

    // Assign a student to a teacher for a specific course
    public function assignStudentToTeacherCourse(Request $request)
{
    $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'student_id' => 'required|exists:students,id',
        'course_id' => 'required|exists:courses,id'
    ]);

    $teacher = Teacher::findOrFail($request->teacher_id);
    $student = Student::findOrFail($request->student_id);
    $course = Course::findOrFail($request->course_id);

    // Sync both relationships
    $teacher->students()->syncWithoutDetaching([
        $request->student_id => ['course_id' => $request->course_id]
    ]);

    $student->courses()->syncWithoutDetaching([$request->course_id => [
        'enrolled_at' => now()
    ]]);

    return back()->with('success', 'Student assigned successfully!');
}

    // Remove a student from a teacher's course
    public function removeStudentFromTeacherCourse(Request $request)
{
    $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'student_id' => 'required|exists:students,id',
        'course_id' => 'required|exists:courses,id'
    ]);

    $teacher = Teacher::findOrFail($request->teacher_id);
    $student = Student::findOrFail($request->student_id);
    $course = Course::findOrFail($request->course_id);

    // Remove from teacher-student relationship
    $teacher->students()->detach($request->student_id, [
        'course_id' => $request->course_id
    ]);

    // Remove from student-course relationship
    $student->courses()->detach($request->course_id);

    return back()->with('success', 'Student removed from course successfully!');
}
}