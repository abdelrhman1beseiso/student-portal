<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'specialization',
        'bio'
    ];

    public function courses()
{
    return $this->belongsToMany(Course::class); 
}

public function students()
{
    return $this->belongsToMany(Student::class)
                ->withPivot('course_id')
                ->using(StudentTeacher::class);
                
}
}