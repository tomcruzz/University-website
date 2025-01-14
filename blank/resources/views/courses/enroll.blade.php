@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h3 font-weight-bold">Enroll Student into {{ $course->name }}</h1>

    <form action="{{ route('courses.enrollStudent', $course->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="student_id">Select Student:</label>
            <select name="student_id" class="form-control" id="student_id">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->s_number }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Enroll Student</button>
    </form>
</div>
@endsection
