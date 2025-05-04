<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherCourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
     return view('home');
 })->name('home');
Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::resource('teachers', TeacherController::class);

Route::prefix('teacher-course')->name('teacher-course.')->group(function () {
    Route::post('/assign-teacher', [TeacherCourseController::class, 'assignTeacherToCourse'])
         ->name('assign-teacher');
         
    Route::post('/assign-student', [TeacherCourseController::class, 'assignStudentToTeacherCourse'])
         ->name('assign-student');
         
    Route::delete('/remove-student', [TeacherCourseController::class, 'removeStudentFromTeacherCourse'])
         ->name('remove-student');
});