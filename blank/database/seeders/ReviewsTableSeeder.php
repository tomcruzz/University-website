<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'reviewer_id' => 8,
                'reviewee_id' => 6,
                'assessment_id' => 1,
                'review_text' => 'You done ',
                'score' => 88,
            ],
            [
                'reviewer_id' => 6,
                'reviewee_id' => 8,
                'assessment_id' => 1,
                'review_text' => 'Nice presentation and thorough understanding.',
                'score' => 95,
            ],

        ]);
    }
}
