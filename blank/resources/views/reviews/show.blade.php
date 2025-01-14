@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Review Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Reviewer: {{ $reviews->reviewer->name }}</h5>
            <h5 class="card-title">Reviewee: {{ $reviews->reviewee->name }}</h5>
            <h5 class="card-title">Assessment: {{ $reviews->assessment->title }}</h5>
            <p class="card-text">Review Text: {{ $reviews->review_text }}</p>
            <p class="card-text">Score: {{ $reviews->score }}</p>
            <p class="card-text">Created At: {{ $reviews->created_at }}</p>
            <p class="card-text">Updated At: {{ $reviews->updated_at }}</p>
            <a href="{{ route('reviews.index') }}" class="btn btn-primary">Back to Reviews</a>
            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning">Edit Review</a>
        </div>
    </div>
</div>
@endsection
