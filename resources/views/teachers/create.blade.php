@extends('layouts.app')

@section('content')
<div class="container py-5 min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="card shadow-lg border-0 rounded-4 w-100" style="max-width: 900px;">
        <div class="card-header bg-gradient-primary text-white py-4 rounded-top-4">
            <h2 class="mb-0 text-center"><i class="bi bi-person-plus-fill me-2"></i> Create New Teacher</h2>
        </div>
        <div class="card-body p-5">
            @if ($errors->any())
                <div class="alert alert-danger rounded-3 mb-4">
                    <strong>Whoops! Something went wrong:</strong>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('teachers.store') }}" method="POST" class="row g-4">
                @csrf

                <div class="col-md-6 mb-4">
                    <label for="name" class="form-label fw-semibold"><i class="bi bi-signature-fill me-2"></i> Full Name</label>
                    <input type="text" class="form-control form-control-lg rounded-pill border-primary" id="name" name="name" placeholder="Enter their full name" required value="{{ old('name') }}">
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="email" class="form-label fw-semibold"><i class="bi bi-envelope-at-fill me-2"></i> Email Address</label>
                    <input type="email" class="form-control form-control-lg rounded-pill border-primary" id="email" name="email" placeholder="Their professional email" required value="{{ old('email') }}">
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="password" class="form-label fw-semibold"><i class="bi bi-shield-lock-fill me-2"></i> Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control form-control-lg rounded-pill border-primary" id="password" placeholder="Create a secure password" required>
                        <button type="button" class="btn btn-outline-secondary rounded-pill rounded-start-0" onclick="togglePasswordVisibility('password')"><i class="bi bi-eye-fill"></i></button>
                    </div>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold"><i class="bi bi-shield-lock me-2"></i> Confirm Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control form-control-lg rounded-pill border-primary" id="password_confirmation" placeholder="Re-enter the password" required>
                        <button type="button" class="btn btn-outline-secondary rounded-pill rounded-start-0" onclick="togglePasswordVisibility('password_confirmation')"><i class="bi bi-eye-fill"></i></button>
                    </div>
                    @error('password_confirmation')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="specialization" class="form-label fw-semibold"><i class="bi bi-award-fill me-2"></i> Area of Expertise</label>
                    <input type="text" class="form-control form-control-lg rounded-pill border-primary" id="specialization" name="specialization" placeholder="e.g., Chemistry, History, Software Engineering" required value="{{ old('specialization') }}">
                    @error('specialization')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 mb-4">
                    <label for="bio" class="form-label fw-semibold"><i class="bi bi-journal-richtext me-2"></i> Biography</label>
                    <textarea class="form-control form-control-lg rounded-3 border-primary" id="bio" name="bio" rows="5" placeholder="A brief professional introduction">{{ old('bio') }}</textarea>
                    @error('bio')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold"><i class="bi bi-book-half me-2"></i> Assign Courses</label>
                    @if($courses->isEmpty())
                        <div class="alert alert-warning rounded-pill" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> No courses available. Please add courses first.
                        </div>
                    @else
                        <div class="border p-4 rounded-lg bg-light-subtle">
                            <div class="row">
                                @foreach($courses as $course)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" id="course{{ $course->id }}" {{ (is_array(old('courses')) && in_array($course->id, old('courses'))) ? 'checked' : '' }}>
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

                <div class="col-12 mt-4 d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm px-5"><i class="bi bi-check-circle-fill me-2"></i> Add Educator</button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm px-5"><i class="bi bi-x-circle-fill me-2"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body, html {
        height: 100%;
        margin: 0;
        background-color: #f8f9fa;
    }
    .container {
        min-height: 100vh;
    }
    .card {
        border-radius: 1.5rem;
        min-height: 0;
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
        box-shadow: 0 0.125rem 0.25rem rgba(0,123,255,.15)!important;
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
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    .alert-danger {
        border-radius: 0.75rem;
        font-size: 1rem;
    }
    .alert-warning {
        font-size: 1rem;
    }
    .form-control, .form-select {
        transition: box-shadow 0.2s, border-color 0.2s;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.15)!important;
        border-color: #007bff;
    }
    .btn-success:hover, .btn-success:focus {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-outline-secondary:hover, .btn-outline-secondary:focus {
        background-color: #f8f9fa;
        border-color: #6c757d;
        color: #343a40;
    }
</style>
@endpush

@push('scripts')
<script>
function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}
</script>
@endpush