<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'dob',
        'address'
    ];
    
    protected $casts = [
        'dob' => 'date',  
        'enrolled_at' => 'datetime' 
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class)
                    ->withPivot('enrolled_at')
                    ->using(CourseStudent::class);
    }
    public function teachers()
{
    return $this->belongsToMany(Teacher::class)
                ->withPivot('course_id')
                ->using(StudentTeacher::class);
}
    
}   
