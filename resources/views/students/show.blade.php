@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Student Details</h2>
            <div class="badge bg-primary">ID: #{{ $student->id }}</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Basic Information</h5>
                    <dl class="row">
                        <dt class="col-sm-4">Name:</dt>
                        <dd class="col-sm-8">{{ $student->name }}</dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">{{ $student->email }}</dd>

                        <dt class="col-sm-4">Date of Birth:</dt>
                        <dd class="col-sm-8">{{ $student->dob->format('M d, Y') }}</dd>

                        <dt class="col-sm-4">Address:</dt>
                        <dd class="col-sm-8">{{ $student->address }}</dd>
                    </dl>
                </div>

                <div class="col-md-6">
                    <h5 class="mb-3">Enrolled Courses</h5>
                    @if($student->courses->count() > 0)
                        <div class="list-group">
                            @foreach($student->courses as $course)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {{ $course->title }}
                                    <div class="small text-muted">
                                        @php
                                            $teacher = $student->teachers()
                                                ->wherePivot('course_id', $course->id)
                                                ->first();
                                        @endphp
                                        @if($teacher)
                                            <span>Teacher: {{ $teacher->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="badge bg-secondary">
                                    {{ $course->pivot->enrolled_at->format('Y-m-d') }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">No enrolled courses found.</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end gap-2">
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Edit Student
            </a>
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection