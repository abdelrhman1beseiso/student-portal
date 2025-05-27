<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherCourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolutionController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('home');
})->name('home');

// Student routes
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::get('/dashboard', function () {
        return view('students.dashboard');
    })->name('student.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('student.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('student.profile.update');
    
    Route::resource('students', StudentController::class)->only([
        'index', 'show', 'edit', 'update' , 'create' , 'destroy' ,'store'
    ])->names([
        'index' => 'students.index',
        'show' => 'students.show',
        'edit' => 'students.edit',
        'update' => 'students.update',
        'create' => 'students.create',
        'destroy' => 'students.destroy',
        'store' => 'students.store'
    ]);

    // Student tasks routes
    Route::get('students/{student}/tasks', [StudentController::class, 'tasks'])->name('students.tasks');
    Route::get('students/{student}/tasks/{task}', [StudentController::class, 'showTask'])->name('students.tasks.show');
    Route::post('students/{student}/tasks/{task}/solutions', [StudentController::class, 'storeSolution'])->name('students.solutions.store');
    Route::get('/solutions/{solution}/download', [StudentController::class, 'downloadSolution'])->name('solutions.download');
});

// Teacher routes
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::get('/dashboard', function () {
        return view('teachers.dashboard');
    })->name('teacher.dashboard');

    Route::resource('teachers', TeacherController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('teacher.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('teacher.profile.update');

    // Teacher tasks routes
    Route::get('teachers/{teacher}/tasks', [TeacherController::class, 'tasks'])->name('teachers.tasks');
    Route::get('teachers/{teacher}/tasks/create', [TeacherController::class, 'createTask'])->name('teachers.tasks.create');
    Route::post('teachers/{teacher}/tasks', [TeacherController::class, 'storeTask'])->name('teachers.tasks.store');
    Route::get('teachers/{teacher}/tasks/{task}', [TeacherController::class, 'showTask'])->name('teachers.tasks.show');
    Route::delete('/teachers/{teacher}/tasks/{task}', [TeacherController::class, 'destroyTask'])->name('teachers.tasks.destroy');
    Route::get('/teacher/teachers/{teacher}/solutions/{solution}/download', 
    [TeacherController::class, 'downloadSolution'])
    ->name('teachers.solutions.download');


    // Teacher-course routes
    Route::prefix('teacher-course')->name('teacher-course.')->group(function () {
        Route::post('/assign-teacher', [TeacherCourseController::class, 'assignTeacherToCourse'])->name('assign-teacher');
        Route::post('/assign-student', [TeacherCourseController::class, 'assignStudentToTeacherCourse'])->name('assign-student');
        Route::delete('/remove-student', [TeacherCourseController::class, 'removeStudentFromTeacherCourse'])->name('remove-student');
    });
});
Route::resource('courses', CourseController::class);

require __DIR__.'/auth.php';