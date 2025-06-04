<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    StudentController,
    CourseController,
    TeacherController,
    TeacherCourseController,
    ProfileController,
    Auth\AuthenticatedSessionController
};

// Public routes
Route::view('/', 'welcome')->name('welcome');
Route::view('/home', 'home')->name('home');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Student routes with 'student' guard
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::view('/dashboard', 'students.dashboard')->name('student.dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('student.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('student.profile.update');
    
    // Student resource
    Route::resource('students', StudentController::class)->except(['destroy']);
    
    // Student tasks
    Route::controller(StudentController::class)->group(function () {
        Route::get('students/{student}/tasks', 'tasks')->name('students.tasks');
        Route::get('students/{student}/tasks/{task}', 'showTask')->name('students.tasks.show');
        Route::post('students/{student}/tasks/{task}/solutions', 'storeSolution')->name('students.solutions.store');
        Route::get('/solutions/{solution}/download', 'downloadSolution')->name('solutions.download');
    });
});

// Teacher routes with 'teacher' guard
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::view('/dashboard', 'teachers.dashboard')->name('teacher.dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('teacher.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('teacher.profile.update');
    
    // Teacher resource
    Route::resource('teachers', TeacherController::class);
    
    // Teacher tasks    
    Route::controller(TeacherController::class)->group(function () {
        Route::prefix('teachers/{teacher}')->group(function () {
            Route::get('tasks', 'tasks')->name('teachers.tasks');
            Route::get('tasks/create', 'createTask')->name('teachers.tasks.create');
            Route::post('tasks', 'storeTask')->name('teachers.tasks.store');
            Route::get('tasks/{task}', 'showTask')->name('teachers.tasks.show');
            Route::delete('tasks/{task}', 'destroyTask')->name('teachers.tasks.destroy');
        });
        Route::get('/teachers/{teacher}/solutions/{solution}/download', 'downloadSolution')
            ->name('teachers.solutions.download');
    });

    // Teacher-course management
    Route::controller(TeacherCourseController::class)->prefix('teacher-course')->name('teacher-course.')->group(function () {
        Route::post('/assign-teacher', 'assignTeacherToCourse')->name('assign-teacher');
        Route::post('/assign-student', 'assignStudentToTeacherCourse')->name('assign-student');
        Route::delete('/remove-student', 'removeStudentFromTeacherCourse')->name('remove-student');
    });
});

// Courses (accessible by both roles)
Route::resource('courses', CourseController::class);

require __DIR__.'/auth.php';