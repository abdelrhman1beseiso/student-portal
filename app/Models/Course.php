<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'credits',
        'image'
    ];

    protected $primaryKey = 'id';
    
    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;
        return Storage::url('courses/'.$this->image);
    }
    
    public function students()
    {
        return $this->belongsToMany(Student::class)->withPivot('enrolled_at');
    }
    public function teachers()
{
    return $this->belongsToMany(Teacher::class)
                ->withTimestamps();
}
}   