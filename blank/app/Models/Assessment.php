<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'instructions',
        'num_reviews',
        'max_score',
        'due_date',
        'type', // student-select, teacher-assign
    ];
    protected $casts = [
        'due_date' => 'datetime',
    ];

    // Define the relationship with the Course
    public function course()
    {
        return $this->belongsTo(Course::class); // Course Model
    }

    // Define the relationship with the Submissions
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
