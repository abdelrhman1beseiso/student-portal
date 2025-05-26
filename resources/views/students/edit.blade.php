@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Edit Student</h2>
                        <p class="text-sm text-gray-500 mt-1">Update student information</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        ID: #{{ $student->id }}
                    </span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 sm:p-8">
                <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Basic Information Section -->
                        <div>
                            <div class="flex items-center mb-4">
                                <i class="bi bi-info-circle-fill text-blue-500 mr-2"></i>
                                <h3 class="text-lg font-semibold text-gray-800">Basic Information</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" id="name" name="name" 
                                           value="{{ old('name', $student->name) }}"
                                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                           required>
                                </div>
                                
                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email" 
                                           value="{{ old('email', $student->email) }}"
                                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                           required>
                                </div>
                                
                                 <!-- Password Fields -->
                <div class="mb-6">
                    <label for="old_password" class="form-label">Current Password</label>
                    <div class="relative">
                        <input type="password" class="form-input block w-full pr-10" id="old_password" name="old_password">
                        <span class="password-toggle" onclick="togglePasswordVisibility('old_password', 'toggleOldPassword')">
                            <svg id="toggleOldPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Required if you want to change your password</p>
                    @error('old_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="new_password" class="form-label">New Password</label>
                    <div class="relative">
                        <input type="password" class="form-input block w-full pr-10" id="new_password" name="new_password">
                        <span class="password-toggle" onclick="togglePasswordVisibility('new_password', 'toggleNewPassword')">
                            <svg id="toggleNewPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                    @error('new_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" class="form-input block w-full pr-10" id="new_password_confirmation" name="new_password_confirmation">
                        <span class="password-toggle" onclick="togglePasswordVisibility('new_password_confirmation', 'toggleConfirmPassword')">
                            <svg id="toggleConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                    @error('new_password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                                
                                <!-- Date of Birth Field -->
                                <div>
                                    <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" 
                                           value="{{ old('dob', $student->dob->format('Y-m-d')) }}"
                                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                           required>
                                </div>
                                
                                <!-- Address Field -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <textarea id="address" name="address" rows="3"
                                              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('address', $student->address) }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Courses Section -->
                        <div>
                            <div class="flex items-center mb-4">
                                <i class="bi bi-book-fill text-blue-500 mr-2"></i>
                                <h3 class="text-lg font-semibold text-gray-800">Course Enrollment</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($courses as $course)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="course{{ $course->id }}" name="courses[]" 
                                                   type="checkbox" value="{{ $course->id }}"
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded course-checkbox"
                                                   {{ $student->courses->contains($course->id) ? 'checked' : '' }}>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <label for="course{{ $course->id }}" class="block text-sm font-medium text-gray-700">
                                                {{ $course->title }}
                                                <span class="text-gray-500 text-xs block">({{ $course->credits }} credits)</span>
                                            </label>
                                            
                                            <!-- Teacher Selection -->
                                            <div class="teacher-selection mt-2" style="{{ $student->courses->contains($course->id) ? '' : 'display: none;' }}">
                                                @if($course->teachers->count() > 0)
                                                    <select name="teachers[{{ $course->id }}]"
                                                            class="mt-1 block w-full pl-3 pr-10 py-1 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                        <option value="">Select Teacher</option>
                                                        @foreach($course->teachers as $teacher)
                                                            <option value="{{ $teacher->id }}"
                                                                {{ $student->teachers->contains($teacher->id) && $student->teachers->find($teacher->id)->pivot->course_id == $course->id ? 'selected' : '' }}>
                                                                {{ $teacher->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-2 rounded mt-2">
                                                        <div class="flex">
                                                            <div class="flex-shrink-0">
                                                                <i class="bi bi-exclamation-triangle-fill text-yellow-400"></i>
                                                            </div>
                                                            <div class="ml-2">
                                                                <p class="text-xs text-yellow-700">No teachers available</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                            <a href="{{ route('students.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                <i class="bi bi-x-circle mr-2"></i> Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                <i class="bi bi-check-circle mr-2"></i> Update Student
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
</script>
@endsection

@push('styles')
<style>
    .bi {
        display: inline-block;
        vertical-align: -0.125em;
        fill: currentColor;
    }
    [required] {
        background-position: right 0.5rem center;
        background-size: 1rem 1rem;
    }
</style>
@endpush