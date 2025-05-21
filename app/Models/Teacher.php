<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'specialization',
        'bio',
        'password'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class) 
         ->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)
                    ->withPivot('course_id')
                    ->using(StudentTeacher::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}