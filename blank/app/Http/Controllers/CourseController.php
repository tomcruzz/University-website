<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Assessment;
use App\Models\Enrollment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Display the list of courses the user is teaching or enrolled in
    public function index()
    {
        $user = Auth::user();
        $courseId = null; // Initialize to null

        if ($user->role === 'teacher') {
            // Fetch courses taught by the teacher
            $courses = Course::with('teacher')->where('teacher_id', $user->id)->get();
            $students = User::where('role', 'student')->with('courses')->paginate(10);
            if ($courses->isNotEmpty()) {
                $courseId = $courses->first()->id; // Set $courseId if courses exist
            }
        } else {
            // Fetch courses where the student is enrolled
            $courses = Enrollment::where('user_id', $user->id)->with('course')->get()->pluck('course');
            $students = collect(); // Empty if not a teacher
        }

        return view('courses.index', ['courses' => $courses, 'students' => $students, 'courseId' => $courseId]);
    }



    // Show the details of a course, including assessments and teacher
    public function show($id)
    {
        // Fetch course details with related assessments and teacher
        $course = Course::with(['teacher', 'assessments'])->findOrFail($id);
        // Fetch the teacher for this course
        $teacher = $course->teacher;

        // Fetch all assessments related to this course
        $assessments = Assessment::where('course_id', $course->id)->get();

        return view('courses.show', compact('course', 'teacher', 'assessments'));
    }
    
    // Allow a teacher to enroll a student into a course
    public function enrollStudent(Request $request, $courseId)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $course = Course::findOrFail($courseId);
        $student = User::findOrFail($request->student_id);

        // Check if the student is already enrolled
        if (!$student->courses->contains($course)) {
            $student->courses()->attach($course);
            return redirect()->back()->with('success', 'Student enrolled successfully!');
        }

        return redirect()->back()->with('error', 'Student is already enrolled in this course.');
    }

    // Add a peer review assessment to a course
    public function addAssessment(Request $request, $course_id)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'type' => 'required|in:student-select,teacher-assign',
            'required_reviews' => 'required|integer|min:1',
            'max_score' => 'required|integer|min:1',
            'due_date' => 'required|date|after:today',
        ]);

        // Find the course by ID
        $course = Course::findOrFail($course_id);

        // Create a new assessment and associate it with the course
        $assessment = new Assessment();
        $assessment->course_id = $course->id;
        $assessment->title = $validated['title'];
        $assessment->instructions = $validated['instructions'];
        $assessment->type = $validated['type'];
        $assessment->required_reviews = $validated['required_reviews'];
        $assessment->max_score = $validated['max_score'];
        $assessment->due_date = $validated['due_date'];

        // Save the assessment to the database
        $assessment->save();

        // Return a response, e.g., redirect or success message
        return redirect()->route('courses.show', $course_id)->with('success', 'Assessment added successfully!');
    }

    // Show the assessment details
    public function showAssessment($assessmentId)
    {

        $user = Auth::user();
        $assessment = Assessment::findOrFail($assessmentId);
        // Get the enrolled students for the course, excluding the current user
        $enrolledStudents = Enrollment::where('course_id', $assessment->course_id)
        ->with('user') // Eager load user details
        ->whereHas('user', function($query) {
            $query->where('role', 'student');
        })
        ->paginate(10); // 10 students per page

        if ($user->role == 'teacher') {
            // If the user is a teacher, fetch all reviews for this assessment
            $reviews = Review::where('assessment_id', $assessmentId)->with(['reviewer', 'reviewee'])->get();
        } else {
        // Show the reviews of each assessments
        $reviews = Review::where('assessment_id', $assessmentId)->where('reviewer_id', $user->id)->get();
        }
        return view('assessments.show', compact('assessment', 'reviews',  'enrolledStudents'));
    }

    public function showStudentReviews($courseId, $studentId)
    {
        $user = Auth::user();

        if ($user->role === 'teacher') {
            // Fetch reviews where the student is the reviewee, for the specified course
            $reviews = Review::whereHas('assessment', function ($query) use ($courseId) {
                    $query->where('course_id', $courseId); // Filter by course
                })
                ->where('reviewee_id', $studentId)
                ->with(['reviewer', 'assessment'])
                ->get();

            $student = User::findOrFail($studentId);

            return view('assessments.review', compact('reviews', 'student', 'courseId'));
        }
    }
    // Update assessment details
    /**
     * Show the form to edit an assessment.
     */
    public function editAssessment($assessment_id)
    {
        // Find the assessment
        $assessment = Assessment::findOrFail($assessment_id);

        // Check if the assessment has reviews
        if ($assessment->reviews()->count() > 0) {
            return redirect()->back()->with('error', 'This assessment cannot be updated because there are already reviews.');
        }

        // Return the edit form view with the assessment's current data
        return view('assessments.edit', compact('assessment'));
    }

    /**
     * Update an assessment.
     */
    public function updateAssessment(Request $request, $assessment_id)
    {
        // Find the assessment
        $assessment = Assessment::findOrFail($assessment_id);

        // Check if the assessment has reviews
        if ($assessment->reviews()->count() > 0) {
            return redirect()->back()->with('error', 'This assessment cannot be updated because there are already reviews.');
        }

        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'type' => 'required|in:student-select,teacher-assign',
            'required_reviews' => 'required|integer|min:1',
            'max_score' => 'required|integer|min:1',
            'due_date' => 'required|date|after:today',
        ]);

        // Update the assessment
        $assessment->update($validated);

        return redirect()->route('courses.show', $assessment->course_id)->with('success', 'Assessment updated successfully!');
    }
    
    public function uploadCourseFile(Request $request)
    {
        // Validate the uploaded file
        $validated = $request->validate([
            'course_file' => 'required|file|mimes:txt,csv',
        ]);

        // Get the file and read its contents
        $file = $request->file('course_file');
        $fileContent = file($file->getRealPath());

        // Ensure that there are at least 3 lines in the file (course, assessment, and student info)
        if (count($fileContent) < 3) {
            return back()->with('error', 'The file format is invalid. Please ensure it contains course, assessment, and student information.');
        }

        // Extract course information from the first line
        list($courseCode, $courseName, $teacherId) = str_getcsv(trim($fileContent[0]));

        // Check if the course already exists
        $existingCourse = Course::where('course_code', $courseCode)->first();
        if ($existingCourse) {
            return back()->with('error', 'A course with this course code already exists.');
        }

        // Create a new course
        $course = Course::create([
            'course_code' => $courseCode,
            'course_name' => $courseName,
            'teacher_id' => $teacherId, // Using teacher ID directly
        ]);

        // Extract and validate the assessment from the second line
        list($assessmentTitle, $instructions, $type, $requiredReviews, $maxScore, $dueDate) = str_getcsv(trim($fileContent[1]));

        // Create the assessment using the existing function
        $assessmentData = [
            'title' => $assessmentTitle,
            'instructions' => $instructions,
            'type' => $type,
            'required_reviews' => $requiredReviews,
            'max_score' => $maxScore,
            'due_date' => $dueDate,
        ];

        $this->addAssessment(new Request($assessmentData), $course->id);

        // Extract student numbers from the third line (students are separated by commas)
        $studentNumbers = str_getcsv(trim($fileContent[2]));
        foreach ($studentNumbers as $s_number) {
            $s_number = trim($s_number); // Clean up whitespace
            if (!empty($s_number)) {
                // Find or create the student
                $student = User::firstOrCreate(['s_number' => $s_number], ['role' => 'student']);

                // Enroll the student in the course using the existing function
                $enrollmentRequest = new Request(['student_id' => $student->id]);
                $this->enrollStudent($enrollmentRequest, $course->id);
            }
        }

        return redirect()->route('courses.index')->with('success', 'Course, assessment, and students enrolled successfully!');
}



}