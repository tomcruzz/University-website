<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all students from the 'users' table
        $students = DB::table('users')->where('role', 'student')->get();

        // Course IDs to enroll in
        $courses = [
            1,
            2,
            3,
            4,
            5,
        ];

        // Enroll each student into 2 or 3 random courses
        $enrollments = [];
        foreach ($students as $student) {
            // Randomly pick 2 or 3 courses for each student
            $studentCourses = array_rand($courses, rand(2, 3));
            foreach ((array)$studentCourses as $courseKey) {
                $enrollments[] = [
                    'user_id' => $student->id,
                    'course_id' => $courses[$courseKey],
                ];
            }
        }

        // Insert all enrollments into the database
        DB::table('enrollment')->insert($enrollments);

        // Assign each course to a teacher
        DB::table('courses')->where('id', 1)->update(['teacher_id' => 1]);
        DB::table('courses')->where('id', 2)->update(['teacher_id' => 2]);
        DB::table('courses')->where('id', 3)->update(['teacher_id' => 3]);
        DB::table('courses')->where('id', 4)->update(['teacher_id' => 4]);
        DB::table('courses')->where('id', 5)->update(['teacher_id' => 5]);
    }
}
