<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
         'course_name',
        'teacher_id', // This assumes a relationship with a Teacher (User)
    ];

    // Define the relationship with the Teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Define the relationship with the Assessments
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    // Define the relationship with the Students
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollment', 'course_id', 'user_id');
    }

}
