@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Courses</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Course
        </a>
    </div>

    <div class="row">
        @foreach($courses as $course)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">{{ $course->title }}</h5>
                        <span class="badge bg-dark rounded-pill">#{{ $course->id }}</span>
                      </div>
                        <td>
                         @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" width="50">
                    @endif
                    </td>
                    <p class="card-text flex-grow-1">{{ $course->description }}</p>
                    <div class="mb-3">
                        <span class="fw-bold">Credits:</span> {{ $course->credits }}
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary rounded-pill">
                            {{ $course->students->count() }} Students
                        </span>
                        <div class="d-flex gap-2">
                            <a href="{{ route('courses.edit', $course->id) }}" 
                               class="btn btn-sm btn-outline-secondary" title="Edit" data-bs-toggle="tooltip">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        title="Delete" data-bs-toggle="tooltip"
                                        onclick="return confirm('Are you sure you want to delete this course?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @section('pagination')
    <div class="row mt-4">
        <div class="col-md-6">
            <p class="pagination-info">
                Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }} 
                of {{ $courses->total() }} courses
            </p>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            {{-- Use the custom pagination view --}}
            {{ $courses->onEachSide(1)->links('pagination.custom') }}
        </div>
    </div>
@endsection
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection

