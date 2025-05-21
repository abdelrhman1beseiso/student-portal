@extends('layouts.app')

@section('title', 'Edit Teacher - ' . $teacher->name)

@section('styles')
<style>
    .teacher-form {
        background: linear-gradient(to bottom right, #ffffff, #f8fafc);
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }
    .form-header {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border-radius: 0.75rem 0.75rem 0 0;
    }
    .form-label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    .form-input {
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
    }
    .form-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }
    .course-checkbox {
        accent-color: #6366f1;
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.75rem;
    }
    .course-item {
        transition: all 0.2s ease;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
    }
    .course-item:hover {
        background-color: #f3f4f6;
        transform: translateX(4px);
    }
    .btn-primary {
        background: linear-gradient(to right, #4f46e5, #7c3aed);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    .btn-secondary {
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
    }
    .btn-secondary:hover {
        background-color: #f3f4f6;
        transform: translateY(-2px);
    }
    .avatar-upload {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 1.5rem;
    }
    .avatar-preview {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: bold;
        color: #4f46e5;
    }
    .avatar-edit {
        position: absolute;
        right: 0;
        bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="teacher-form overflow-hidden">
        <!-- Form Header -->
        <div class="form-header px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Edit Teacher Profile</h1>
            <p class="text-indigo-100 mt-1">Update {{ $teacher->name }}'s information</p>
        </div>

        <!-- Form Body -->
        <div class="bg-white px-6 py-6 sm:p-8">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Name Field -->
                <div class="mb-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-input block w-full" id="name" name="name" 
                           value="{{ old('name', $teacher->name) }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-input block w-full" id="email" name="email" 
                           value="{{ old('email', $teacher->email) }}" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="form-label">New Password</label>
                    <div class="relative">
                        <input type="password" class="form-input block w-full" id="password" name="password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="togglePasswordVisibility()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Leave blank to keep current password</p>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Specialization Field -->
                <div class="mb-6">
                    <label for="specialization" class="form-label">Specialization</label>
                    <input type="text" class="form-input block w-full" id="specialization" name="specialization" 
                           value="{{ old('specialization', $teacher->specialization) }}" required>
                    @error('specialization')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bio Field -->
                <div class="mb-6">
                    <label for="bio" class="form-label">Biography</label>
                    <textarea class="form-input block w-full" id="bio" name="bio" rows="4">{{ old('bio', $teacher->bio) }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Assigned Courses -->
                <div class="mb-8">
                    <label class="form-label block mb-3">Assigned Courses</label>
                    <div class="space-y-2">
                        @foreach($courses as $course)
                        <div class="course-item flex items-center">
                            <input class="course-checkbox" type="checkbox" name="courses[]" 
                                   value="{{ $course->id }}" id="course{{ $course->id }}"
                                   {{ $teacher->courses->contains($course->id) ? 'checked' : '' }}>
                            <label for="course{{ $course->id }}" class="flex-1">
                                <span class="font-medium">{{ $course->title }}</span>
                                <span class="text-sm text-gray-500 ml-2">{{ $course->credits }} credits</span>
                            </label>
                            <span class="text-sm text-gray-500">
                                {{ $course->students_count }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    @error('courses')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('teachers.index') }}" class="btn-secondary inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-md">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-md text-dark shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Update Teacher
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    }

    // Animation for form elements
    document.addEventListener('DOMContentLoaded', () => {
        const formElements = document.querySelectorAll('.form-input, .course-item, .btn-primary, .btn-secondary');
        formElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(10px)';
            el.style.transition = `all 0.3s ease ${index * 0.05}s`;
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100);
        });
    });
</script>
@endsection