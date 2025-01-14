@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 bg-light border rounded shadow-lg">
    <h2 class="text-center mb-4 font-weight-bold text-dark">Edit Assessment</h2>

    {{-- Error message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Form to update an assessment --}}
    <form action="{{ route('courses.updateAssessment', $assessment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title" class="font-weight-bold text-info">Assessment Title</label>
            <input type="text" id="title" name="title" class="form-control border-info shadow-sm" value="{{ old('title', $assessment->title) }}" required>
            @error('title')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="instructions" class="font-weight-bold text-info">Instructions</label>
            <textarea id="instructions" name="instructions" class="form-control border-info shadow-sm" rows="3" required>{{ old('instructions', $assessment->instructions) }}</textarea>
            @error('instructions')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type" class="font-weight-bold text-info">Assessment Type</label>
            <select id="type" name="type" class="form-control border-info shadow-sm" required>
                <option value="student-select" {{ old('type', $assessment->type) == 'student-select' ? 'selected' : '' }}>Student Select</option>
                <option value="teacher-assign" {{ old('type', $assessment->type) == 'teacher-assign' ? 'selected' : '' }}>Teacher Assign</option>
            </select>
            @error('type')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="required_reviews" class="font-weight-bold text-info">Required Reviews</label>
            <input type="number" id="required_reviews" name="required_reviews" class="form-control border-info shadow-sm" value="{{ old('required_reviews', $assessment->required_reviews) }}" min="1" required>
            @error('required_reviews')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="max_score" class="font-weight-bold text-info">Max Score</label>
            <input type="number" id="max_score" name="max_score" class="form-control border-info shadow-sm" value="{{ old('max_score', $assessment->max_score) }}" min="1" required>
            @error('max_score')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="due_date" class="font-weight-bold text-info">Due Date</label>
            <input type="datetime-local" id="due_date" name="due_date" class="form-control border-info shadow-sm" value="{{ old('due_date', $assessment->due_date->format('Y-m-d\TH:i')) }}" required>
            @error('due_date')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-info btn-block mt-3">Update Assessment</button>
    </form>
</div>
@endsection
