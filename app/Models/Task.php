<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'course_id',
        'title',
        'description',
        'deadline'
    ];

    protected $casts = [
        'deadline' => 'datetime'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }
}