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
        'dob' => 'date',  // This casts the dob field to a Carbon instance
        'enrolled_at' => 'datetime' // If you use this field in the pivot table
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class)
                    ->withPivot('enrolled_at')
                    ->using(CourseStudent::class);
    }
    
}   
