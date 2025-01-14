<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Assessment;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'reviewee_id' => 'required|exists:users,id',
            'review_text' => 'required|string',
            'score' => 'required|integer',
            'assessment_id' => 'required|exists:assessments,id',
        ]);

        // Create a new review instance and save it
        $review = new Review();
        $review->reviewer_id = Auth::id(); // Set the reviewer to the currently authenticated user
        $review->reviewee_id = $validatedData['reviewee_id'];
        $review->review_text = $validatedData['review_text'];
        $review->score = $validatedData['score'];
        $review->assessment_id = $validatedData['assessment_id'];
        $review->save();

        // Redirect back to the assessment page with a success message
        return redirect()->route('assessments.show', $validatedData['assessment_id'])->with('success', 'Review submitted successfully.');
}
}