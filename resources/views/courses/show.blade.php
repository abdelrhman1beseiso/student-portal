@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">{{ $course->title }}</h2>
            <div>
                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-light">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Image Display Section with Debugging -->
        @if($course->image)
            <div class="text-center mb-4 border rounded p-2 bg-light">
                @if(file_exists(public_path('storage/' . $course->image)))
                    <img src="{{ asset('storage/' . $course->image) }}" 
                         alt="Course Image" 
                         class="img-fluid rounded" 
                         style="max-height: 300px;">
                    <div class="mt-2 text-muted small">
                        Image path: storage/{{ $course->image }}
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        Image file not found at: storage/{{ $course->image }}
                    </div>
                @endif
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> No image uploaded for this course
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <h5 class="text-primary">Description</h5>
                <p class="lead">{{ $course->description }}</p>
                
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <h6 class="card-subtitle mb-2 text-muted">Credits</h6>
                                <p class="card-text display-6">{{ $course->credits }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6 class="card-subtitle mb-2 text-muted">Students</h6>
                                <p class="card-text display-6">{{ $course->students->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($course->students->count() > 0)
        <hr>
        <h4 class="mt-4 text-primary">Enrolled Students</h4>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Enrolled Since</th>
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
        @endif
    </div>
    
    <div class="card-footer bg-light">
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Courses
        </a>
    </div>
</div>
@endsection