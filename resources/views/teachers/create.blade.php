@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 bg-light" style="min-height: 100vh;">
    <div class="card shadow-lg rounded-0" style="min-height: 100vh; border: none;">
        <div class="card-header bg-gradient-primary text-white py-4">
            <h2 class="mb-0 text-center"><i class="bi bi-person-plus-fill me-2"></i> Create New Teacher</h2>
        </div>
        <div class="card-body p-5">
            <form action="{{ route('teachers.store') }}" method="POST" class="row g-4">
                @csrf

                <div class="col-md-6 mb-4">
                    <label for="name" class="form-label fw-semibold"><i class="bi bi-signature-fill me-2"></i> Full Name</label>
                    <input type="text" class="form-control form-control-lg rounded-pill border-primary" id="name" name="name" placeholder="Enter their full name" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="email" class="form-label fw-semibold"><i class="bi bi-envelope-at-fill me-2"></i> Email Address</label>
                    <input type="email" class="form-control form-control-lg rounded-pill border-primary" id="email" name="email" placeholder="Their professional email" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="password" class="form-label fw-semibold"><i class="bi bi-shield-lock-fill me-2"></i> Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control form-control-lg rounded-pill border-primary" id="password" placeholder="Create a secure password" required>
                        <button type="button" class="btn btn-outline-secondary rounded-pill rounded-start-0"><i class="bi bi-eye-fill"></i></button>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="specialization" class="form-label fw-semibold"><i class="bi bi-award-fill me-2"></i> Area of Expertise</label>
                    <input type="text" class="form-control form-control-lg rounded-pill border-primary" id="specialization" name="specialization" placeholder="e.g., Chemistry, History, Software Engineering" required>
                </div>

                <div class="col-12 mb-4">
                    <label for="bio" class="form-label fw-semibold"><i class="bi bi-journal-richtext me-2"></i> Biography</label>
                    <textarea class="form-control form-control-lg rounded-3 border-primary" id="bio" name="bio" rows="5" placeholder="A brief professional introduction"></textarea>
                </div>

                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold"><i class="bi bi-book-half me-2"></i> Assign Courses</label>
                    @if($courses->isEmpty())
                        <div class="alert alert-warning rounded-pill" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> No courses available. Please add courses first.
                        </div>
                    @else
                        <div class="border p-4 rounded-lg">
                            <div class="row">
                                @foreach($courses as $course)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" id="course{{ $course->id }}">
                                            <label class="form-check-label" for="course{{ $course->id }}">
                                                <span class="fw-medium">{{ $course->title }}</span> <span class="text-muted">({{ $course->credits }} credits)</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-12 mt-4 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm me-3 px-5"><i class="bi bi-check-circle-fill me-2"></i> Add Educator</button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm px-5"><i class="bi bi-x-circle-fill me-2"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    body, html {
        height: 100%;
        margin: 0;
        background-color: #f8f9fa;
    }

    .container-fluid {
        padding: 0;
    }

    .card {
        border-radius: 0;
        min-height: 100vh;
    }

    .bg-gradient-primary {
        background: linear-gradient(to right, #007bff, #6610f2);
    }

    .form-label {
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .form-control::placeholder {
        color: #6c757d;
        opacity: 0.8;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .rounded-3 {
        border-radius: 0.5rem !important;
    }

    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        border-radius: 3em;
        background-image: url('data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%27-4 -4 8 8%27%3e%3ccircle r=%273%27 fill=%27rgba(0,0,0,0.25)%27/%3e%3c/svg%3e');
        background-position: left center;
        cursor: pointer;
        transition: background-position .15s ease-in-out;
    }

    .form-switch .form-check-input:checked {
        background-position: right center;
        background-image: url('data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%27-4 -4 8 8%3e%3ccircle r=%273%27 fill=%27%23fff%27/%3e%3c/svg%3e');
        background-color: #198754;
        border-color: #198754;
    }

    .btn-primary, .btn-success, .btn-outline-secondary {
        font-weight: bold;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075)!important;
    }

    /* Consistent spacing for all form groups */
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
</style>