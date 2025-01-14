@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Reviews</h1>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary">Add Review</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Reviewer</th>
                <th>Reviewee</th>
                <th>Assessment</th>
                <th>Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->reviewer->name }}</td>
                <td>{{ $review->reviewee->name }}</td>
                <td>{{ $review->assessment->title }}</td>
                <td>{{ $review->score }}</td>
                <td>
                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
