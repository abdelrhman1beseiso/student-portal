<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentTeacher extends Pivot
{
    protected $table = 'student_teacher';
    
    protected $fillable = [
        'teacher_id',
        'student_id',
        'course_id'
    ];
}
