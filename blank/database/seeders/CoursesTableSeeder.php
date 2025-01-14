<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            ['course_code' => '7001ICT', 'course_name' => 'Software Technology'],
            ['course_code' => '7002ICT', 'course_name' => 'Mobile Application'],
            ['course_code' => '7003ICT', 'course_name' => 'Computer Systems'],
            ['course_code' => '7004ICT', 'course_name' => 'Programmin Principle'],
            ['course_code' => '7005ICT', 'course_name' => 'Database Design'],
        ]);
    }
}
