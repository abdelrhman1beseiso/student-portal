@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Course Details: {{ $course->title }}</h2>
            <div>
                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h5 class="mb-3">Description</h5>
                <p>{{ $course->description }}</p>
                
                <div class="row">
                    <div class="col-md-4">
                        <h5>Credits</h5>
                        <p>{{ $course->credits }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Created At</h5>
                        <p>{{ $course->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Last Updated</h5>
                        <p>{{ $course->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h4 class="mb-3">Enrolled Students ({{ $course->students->count() }})</h4>
        
        @if($course->students->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Enrollment Date</th>
                        <small class="text-muted">Course ID: #{{ $course->id }}</small>

                    </tr>
                </thead>
                <tbody>
                    @foreach($course->students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->pivot->enrolled_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info">
            No students are currently enrolled in this course.
        </div>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Courses
        </a>
    </div>
</div>
@endsection