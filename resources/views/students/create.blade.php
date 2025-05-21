@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-2xl font-bold text-gray-800">Add New Student</h2>
                <p class="text-sm text-gray-500 mt-1">Fill in the details below to register a new student</p>
            </div>

            <!-- Card Body -->
            <div class="p-6 sm:p-8">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    
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
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" required
                                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>
                                
                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                    <input type="email" id="email" name="email" required
                                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>
                                
                                <!-- Password Field -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password" required
                                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition pr-10"
                                               placeholder="Create a secure password">
                                        <button type="button" onclick="togglePasswordVisibility('password')" 
                                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                                </div>
                                
                                <!-- Date of Birth Field -->
                                <div>
                                    <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                                    <input type="date" id="dob" name="dob" required
                                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>
                                
                                <!-- Address Field -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address <span class="text-red-500">*</span></label>
                                    <textarea id="address" name="address" rows="3" required
                                              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
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
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded course-checkbox">
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <label for="course{{ $course->id }}" class="block text-sm font-medium text-gray-700">
                                                {{ $course->title }}
                                                <span class="text-gray-500 text-xs block">({{ $course->credits }} credits)</span>
                                            </label>
                                            
                                            <!-- Teacher Selection -->
                                            <div class="teacher-selection mt-2" style="display: none;">
                                                @if($course->teachers->count() > 0)
                                                    <select name="teachers[{{ $course->id }}]"
                                                            class="mt-1 block w-full pl-3 pr-10 py-1 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                        <option value="">Select Teacher</option>
                                                        @foreach($course->teachers as $teacher)
                                                            <option value="{{ $teacher->id }}">
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
                                <i class="bi bi-check-circle mr-2"></i> Create Student
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
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        window.togglePasswordVisibility = function(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);
        };

        // Toggle teacher selection when course checkbox changes
        document.querySelectorAll('.course-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const teacherSelection = this.closest('.border-gray-200').querySelector('.teacher-selection');
                teacherSelection.style.display = this.checked ? 'block' : 'none';
            });
        });
    });
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