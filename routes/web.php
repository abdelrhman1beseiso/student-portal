<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherCourseController;
use App\Http\Controllers\ProfileController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('home');
})->name('home');

// Student Routes
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::get('/dashboard', function () {
        return view('students.dashboard');
    })->name('student.dashboard');

    // Profile routes with correct naming
    Route::get('/profile', [ProfileController::class, 'edit'])->name('student.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('student.profile.update');
    
    Route::resource('students', StudentController::class)->names([
        'index' => 'students.index',
        'show' => 'students.show',  
        'edit' => 'students.edit',
        'update' => 'students.update'
    ]);
});

// Teacher Routes
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::get('/dashboard', function () {
        return view('teachers.dashboard');
    })->name('teacher.dashboard');

    Route::resource('teachers', TeacherController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('teacher.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('teacher.profile.update');
});

// Course Routes
Route::resource('courses', CourseController::class);

Route::prefix('teacher-course')->name('teacher-course.')->middleware('auth:teacher')->group(function () {
    Route::post('/assign-teacher', [TeacherCourseController::class, 'assignTeacherToCourse'])->name('assign-teacher');
    Route::post('/assign-student', [TeacherCourseController::class, 'assignStudentToTeacherCourse'])->name('assign-student');
    Route::delete('/remove-student', [TeacherCourseController::class, 'removeStudentFromTeacherCourse'])->name('remove-student');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

