@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 bg-white border rounded-lg shadow-sm">
    <h1 class="display-4 mb-3 text-primary font-weight-bold">{{ $assessment->title }}</h1>

    <div class="mb-4 p-4 bg-light border-left border-info rounded-lg">
        <p class="text-success"><strong>Instructions:</strong> {{ $assessment->instructions }}</p>
        <p class="text-success"><strong>Total Score:</strong> {{ $assessment->max_score }}</p>
        <p class="text-success"><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($assessment->due_date)->format('F j, Y h:i A') }}</p>
        <p class="text-success"><strong>Reviews:</strong> {{ $assessment->required_reviews }}</p>
        <p class="text-success"><strong>Type:</strong> {{ ucfirst($assessment->type) }}</p>
    </div>

    {{-- Display submitted reviews --}}
    <div class="card mt-4 border-0 shadow-lg">
        <div class="card-header bg-success text-white font-weight-bold">
            Submitted Reviews
        </div>
        <div class="card-body bg-light">
            @if($reviews->isEmpty())
                <p class="text-muted">No reviews have been submitted yet.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($reviews as $review)
                        <li class="list-group-item bg-white border-bottom">
                            <strong class="text-dark">Reviewer:</strong> {{ $review->reviewer->name }}<br>
                            <strong class="text-dark">Reviewee:</strong> {{ $review->reviewee->name }}<br>
                            <strong class="text-dark">Review:</strong> {{ $review->review_text }}<br>
                            <strong class="text-dark">Score:</strong> {{ $review->score }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Enrolled students (Teacher view) --}}
    @if(Auth::user()->role == 'teacher')
        <div class="card mt-4 border-info">
            <div class="card-header bg-info text-white">
                Enrolled Students
            </div>
            <div class="card-body">
                @if($enrolledStudents->isEmpty())
                    <p>No students enrolled in this course.</p>
                @else
                    <ul class="list-group">
                        @foreach($enrolledStudents as $enrollment)
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                <a href="{{ route('courses.students.reviews', ['courseId' => $assessment->course_id, 'studentId' => $enrollment->user->id]) }}" class="text-info">
                                    {{ $enrollment->user->name }} ({{ $enrollment->user->email }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $enrolledStudents->links() }}
        </div>
    @endif

    {{-- Review submission form (Student view) --}}
    @if(Auth::user()->role == 'student')
    <div class="card mt-4 border-0 shadow-sm">
        <div class="card-header bg-warning text-white font-weight-bold">
            Submit a Review
        </div>
        <div class="card-body">
            <form action="{{ route('reviews.store') }}" method="POST">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="reviewee_id" class="font-weight-bold text-dark">Select Peer:</label>
                    <select name="reviewee_id" id="reviewee_id" class="form-control" required>
                        <option value="">-- Select a Peer --</option>
                        @foreach($enrolledStudents as $enrollment)
                            <option value="{{ $enrollment->user->id }}">{{ $enrollment->user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="review_text" class="font-weight-bold text-dark">Review:</label>
                    <textarea name="review_text" id="review_text" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group mt-3">
                    <label for="score" class="font-weight-bold text-dark">Score:</label>
                    <input type="number" name="score" id="score" class="form-control" required>
                </div>

                <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                <button type="submit" class="btn btn-warning btn-block mt-3">Submit Review</button>
            </form>
        </div>
    </div>
    @endif

    {{-- Teacher actions --}}
    @if(Auth::user()->role == 'teacher')
    <div class="mt-4">
        <a href="{{ route('assessments.edit', $assessment->id) }}" class="btn btn-danger btn-lg">
            Edit Assessment
        </a>
    </div>
    @endif
</div>
@endsection
