@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100" style="background-color: #e8f0f8;">
    <div class="w-100 mx-5 p-5 bg-light shadow-lg rounded-lg">
        <h1 class="display-6 text-primary">{{ $course->course_name }} ({{ $course->course_code }})</h1>

        <div class="mt-4 p-3 bg-white shadow-sm rounded">
            <h2 class="h5 font-weight-bold text-dark">Teacher:</h2>
            <ul class="list-unstyled">
                <li class="text-secondary">{{ $teacher->name }}</li>
            </ul>
        </div>

        <div class="mt-5 p-3 bg-white shadow-sm rounded">
            <h2 class="h5 font-weight-bold text-dark">Assessments</h2>
            @if($course->assessments->isEmpty())
                <p class="text-muted">No assessments available for this course yet.</p>
            @else
            <ul class="list-unstyled mt-2">
                @foreach($assessments as $assessment)
                    <li class="mb-2">
                        <a href="{{ route('assessments.show', $assessment->id) }}" class="text-info font-weight-bold">
                            {{ $assessment->title }} (Due: {{ $assessment->due_date }})
                        </a>
                    </li>
                @endforeach
            </ul>
            @endif
        </div>

        @if(Auth::user()->role === 'teacher')
        <div class="mt-5 p-4 bg-white shadow-lg rounded-lg">
            <h2 class="h5 font-weight-bold text-dark">Add Assessment</h2>
            <form action="{{ route('courses.addAssessment', $course->id) }}" method="POST">
            {{csrf_field()}}

            <div class="form-group">
                <label for="title" class="font-weight-bold">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="instructions" class="font-weight-bold">Instructions</label>
                <textarea id="instructions" name="instructions" class="form-control" rows="3" required>{{ old('instructions') }}</textarea>
                @error('instructions')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type" class="font-weight-bold">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="student" {{ old('type') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="teacher" {{ old('type') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                </select>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="required_reviews" class="font-weight-bold">Required Number of Reviews</label>
                <input type="number" id="required_reviews" name="required_reviews" class="form-control" value="{{ old('required_reviews') }}" min="1" required>
                @error('required_reviews')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="max_score" class="font-weight-bold">Total Marks</label>
                <input type="number" id="max_score" name="max_score" class="form-control" value="{{ old('max_score') }}" min="1" required>
                @error('max_score')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="due_date" class="font-weight-bold">Due Date</label>
                <input type="datetime-local" id="due_date" name="due_date" class="form-control" value="{{ old('due_date') }}" required>
                @error('due_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-info btn-lg btn-block">Add</button>
        </form>
        </div>
        @endif
    </div>
</div>
@endsection
