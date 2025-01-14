<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assessments')->insert([
            [
                'course_id' => 1,
                'title' => 'Week 7 Lab Review',
                'instructions' => 'Give review for other students',
                'required_reviews' => 2,
                'max_score' => 30,
                'due_date' => now()->addDays(7),
                'type' => 'student-select'
            ],
            [
                'course_id' => 2,
                'title' => 'Week 8 Workshop Review',
                'instructions' => 'Add your reviews for others!',
                'required_reviews' => 1,
                'max_score' => 50,
                'due_date' => now()->addDays(14),
                'type' => 'teacher-assign'
            ],

        ]);
    }
}
