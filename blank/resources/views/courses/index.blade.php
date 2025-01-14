@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100" style="background-color: #f4f4f9;">
    <div class="w-100 max-w-3xl mx-4 p-5 bg-light shadow-lg rounded-lg">
        @if(Auth::user()->role === 'student')
            <h1 class="display-4 mb-5 text-primary">My Courses</h1>
            <ul class="list-group">
                @foreach($courses as $course)
                    <li class="list-group-item bg-white shadow-sm mb-3 rounded">
                        <a href="{{ route('courses.show', $course->id) }}" class="text-info font-weight-bold">
                            {{ $course->course_name }} ({{ $course->course_code }})
                        </a>
                    </li>
                @endforeach
            </ul>
            
        @endif

        @if(Auth::user()->role === 'teacher')
        <div>        
            <h1 class="display-4 mb-5 text-primary">Students</h1>
            <ul class="list-group">
                @foreach($courses as $course)
                    <li class="list-group-item bg-white shadow-sm mb-3 rounded">
                        <span class="font-weight-bold text-dark">{{ $course->course_name }} ({{ $course->course_code }})</span>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-primary float-right">Course Details</a>
                    </li>
                @endforeach
            </ul>
        </div>

            <ul class="list-group mt-4">
                @foreach($students as $student)
                    <li class="list-group-item bg-white shadow-sm mb-3 rounded">
                        <span class="font-weight-bold text-secondary">{{ $student->name }}  [{{$student->s_number}}]</span>
                        <ul class="pl-4">
                            @if($student->courses->isEmpty())
                                <li class="text-muted">No courses enrolled</li>
                            @else
                                @foreach($student->courses as $course)
                                    <li>
                                        <a href="{{ route('courses.show', $course->id) }}" class="text-success font-weight-bold">
                                            {{ $course->course_name }} ({{ $course->course_code }})
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
            {{$students->links()}}
            <div class="mt-5 p-4 bg-white shadow rounded-lg">
                <h2 class="h4 mb-3 text-primary">Add Student to a Course</h2>

                <form action="{{ route('courses.enroll', ['courseId' => $courseId]) }}" method="POST" class="mb-4">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="student" class="font-weight-bold text-dark">Student Name</label>
                        <select name="student_id" id="student" class="form-control">
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}[{{$student->s_number}}]</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="course" class="font-weight-bold text-dark">Course</label>
                        <select name="course_id" id="course" class="form-control">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }} ({{ $course->course_code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Enroll
                    </button>
                </form>
            </div>
            <div class="container" style="max-width: 1300px; margin-top: 50px;">
            <div class="card border-0 rounded-3" style="background-color: #f9f9f9; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <h1 class="text-center mb-5" style="font-size: 26px; font-weight: 600; color: #333;">Course Information Upload</h1>

            <form action="{{ route('courses.upload') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group mb-5">
                    <label for="course_file" style="font-weight: 500; font-size: 16px; color: #555;">Select a Course File</label>
                    <input type="file" name="course_file" id="course_file" class="form-control" style="border: 2px solid #ddd; padding: 12px;" required>
                </div>
                <button type="submit" class="btn btn-success w-100" style="padding: 15px; font-size: 18px; background-color: #28a745; border: none;">
                Upload Course
            </button>
            </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
