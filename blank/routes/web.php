<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Group all routes under the 'auth' middleware
Route::middleware('auth')->group(function () {
    
    // Home page route: Lists courses the user is enrolled in or teaching
    Route::get('/', [CourseController::class, 'index']);

    // Display details of a specific course (teachers, assessments)
    Route::get('courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    
    // Enroll a student into a course (teacher only)
    Route::post('courses/{courseId}/enroll', [CourseController::class, 'enrollStudent'])->name('courses.enrollStudent');
    
    // Show a specific peer review assessment
    Route::get('assessments/{assessmentId}', [CourseController::class, 'showAssessment'])->name('assessments.show');


    // Add a new peer review assessment to a course (teacher only)
    Route::post('courses/{courseId}/assessments', [CourseController::class, 'addAssessment'])->name('courses.addAssessment');
    
    // Show the form to edit an assessment (teacher only)
    Route::get('assessments/{assessmentId}/edit', [CourseController::class, 'editAssessment'])->name('assessments.edit');
    
    // Update the assessment details (teacher only)
    // Route::put('/courses/{course}/assessments/{assessment}/update', [CourseController::class, 'updateAssessment'])->name('courses.updateAssessment');

    // Enroll a student
    Route::post('/courses/{courseId}/enroll', [CourseController::class, 'enrollStudent'])->name('courses.enroll');

    Route::get('/assessments/{assessment}/edit', [CourseController::class, 'editAssessment'])->name('courses.editAssessment');
    Route::put('/assessments/{assessment}', [CourseController::class, 'updateAssessment'])->name('courses.updateAssessment');

    // Define the route for storing reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::middleware(['auth'])->group(function () {
        Route::get('/courses/{courseId}/students/{studentId}/reviews', [CourseController::class, 'showStudentReviews'])->name('courses.students.reviews');
    });

    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    // Upload course details file
    Route::post('/courses/upload', [CourseController::class, 'uploadCourseFile'])->name('courses.upload');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

});




// Include authentication routes like login, registration, etc.
require __DIR__.'/auth.php';
