@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Review</h1>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
    {{csrf_field()}}
    {{ method_field('PUT') }}
        <div class="form-group">
            <label for="assessment_id">Assessment</label>
            <select name="assessment_id" id="assessment_id" class="form-control">
                @foreach($assessments as $assessment)
                <option value="{{ $assessment->id }}" {{ $assessment->id == $review->assessment_id ? 'selected' : '' }}>{{ $assessment->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="reviewer_id">Reviewer</label>
            <select name="reviewer_id" id="reviewer_id" class="form-control">
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $review->reviewer_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="reviewee_id">Reviewee</label>
            <select name="reviewee_id" id="reviewee_id" class="form-control">
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $review->reviewee_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="review_text">Review Text</label>
            <textarea name="review_text" id="review_text" class="form-control" required>{{ $review->review_text }}</textarea>
        </div>
        <div class="form-group">
            <label for="score">Score (1-5)</label>
            <input type="number" name="score" id="score" class="form-control" value="{{ $review->score }}" min="1" max="5" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Review</button>
        <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
