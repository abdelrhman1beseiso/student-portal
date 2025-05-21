@extends('layouts.app')

@section('title', $teacher->name . ' Profile')

@section('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        border-radius: 0.5rem 0.5rem 0 0;
    }
    .teacher-avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #8b5cf6, #a78bfa);
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
    }
    .card-hover {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    .card-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-left: 4px solid #4f46e5;
    }
    .badge-gradient {
        background: linear-gradient(to right, #6366f1, #8b5cf6);
        color: white;
    }
    .enrollment-badge {
        background: linear-gradient(to right, #10b981, #34d399);
        color: white;
    }
    .modal-header {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
    }
    .course-item {
        transition: all 0.2s ease;
    }
    .course-item:hover {
        background-color: #f8fafc;
        transform: translateX(3px);
    }
    .action-btn {
        transition: all 0.2s ease;
    }
    .action-btn:hover {
        transform: scale(1.05);
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Teacher Profile Header -->
    <div class="card card-hover mb-6 overflow-hidden">
        <div class="profile-header px-6 py-4">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="teacher-avatar rounded-full flex items-center justify-center shadow-md">
                    {{ substr($teacher->name, 0, 1) }}
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-2xl font-bold">{{ $teacher->name }}</h1>
                    <p class="text-indigo-100">{{ $teacher->specialization }}</p>
                    <div class="mt-2 flex flex-wrap justify-center md:justify-start gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $teacher->email }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $teacher->courses->count() }} Courses
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 bg-white">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Bio</h3>
            <p class="text-gray-600">{{ $teacher->bio ?? 'No bio available' }}</p>
        </div>
    </div>

    <!-- Teacher's Courses Section -->
    <div class="card card-hover mb-6">
        <div class="card-header bg-white border-b px-6 py-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-800">Assigned Courses</h3>
                <span class="badge-gradient px-3 py-1 rounded-full text-sm font-medium">
                    {{ $teacher->courses->count() }} Total
                </span>
            </div>
        </div>
        <div class="card-body px-6 py-4">
            @if($teacher->courses->count() > 0)
                <div class="space-y-3">
                    @foreach($teacher->courses as $course)
                        <div class="course-item bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $course->title }}</h4>
                                <p class="text-sm text-gray-600">{{ $course->credits }} credits • {{ $course->students_count }} students</p>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h4 class="mt-3 text-lg font-medium text-gray-700">No courses assigned</h4>
                    <p class="mt-1 text-gray-500">This teacher hasn't been assigned to any courses yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Students Directly Assigned to Teacher -->
    <div class="card card-hover mb-6 border-l-4 border-green-500">
        <div class="card-header bg-white border-b px-6 py-4 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Directly Assigned Students</h3>
                <p class="text-sm text-gray-600">Students specifically assigned to this teacher</p>
            </div>
            <button class="action-btn inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700"
                    data-bs-toggle="modal" data-bs-target="#assignStudentModal">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Assign Student
            </button>
        </div>
        <div class="card-body px-6 py-4">
            @if($teacher->students->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrolled</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($teacher->students as $student)
                                @php
                                    $course = $student->courses()
                                        ->where('courses.id', $student->pivot->course_id)
                                        ->first();
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                                {{ substr($student->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $student->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $course ? $course->title : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($course)
                                            {{ $course->pivot->enrolled_at->format('M d, Y') }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('teacher-course.remove-student') }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                            <input type="hidden" name="course_id" value="{{ $student->pivot->course_id }}">
                                            <button type="submit" class="action-btn inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700"
                                                    onclick="return confirm('Are you sure you want to remove this student?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h4 class="mt-3 text-lg font-medium text-gray-700">No students assigned</h4>
                    <p class="mt-1 text-gray-500">This teacher doesn't have any directly assigned students</p>
                    <button class="mt-4 action-btn inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700"
                            data-bs-toggle="modal" data-bs-target="#assignStudentModal">
                        Assign First Student
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- All Students in Teacher's Courses -->
    <div class="card card-hover">
        <div class="card-header bg-white border-b px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-800">All Students in Teacher's Courses</h3>
            <p class="text-sm text-gray-600">Students enrolled in any of this teacher's courses</p>
        </div>
        <div class="card-body px-6 py-4">
            @php
                $allStudents = collect();
                foreach ($teacher->courses as $course) {
                    $allStudents = $allStudents->merge($course->students->map(function ($student) use ($course) {
                        $student->course_title = $course->title;
                        $student->enrollment_date = $student->pivot->enrolled_at;
                        return $student;
                    }));
                }
                $allStudents = $allStudents->unique('id');
            @endphp

            @if($allStudents->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrolled</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($allStudents as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                                {{ substr($student->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $student->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->course_title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if(is_string($student->enrollment_date))
                                            {{ \Carbon\Carbon::parse($student->enrollment_date)->format('M d, Y') }}
                                        @else
                                            {{ $student->enrollment_date->format('M d, Y') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h4 class="mt-3 text-lg font-medium text-gray-700">No students enrolled</h4>
                    <p class="mt-1 text-gray-500">There are no students enrolled in this teacher's courses</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Assign Student Modal -->
    <div class="modal fade" id="assignStudentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title text-white">Assign Student to Teacher</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('teacher-course.assign-student') }}" method="POST">
                    @csrf
                    <div class="modal-body bg-gray-50 p-6">
                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Select Student</label>
                                <select class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="student_id" required>
                                    <option value="">Choose a student...</option>
                                    @foreach(App\Models\Student::all() as $student)
                                        @if(!$teacher->students->contains($student->id))
                                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Select Course</label>
                                <select class="form-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="course_id" required>
                                    <option value="">Choose a course...</option>
                                    @foreach($teacher->courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }} ({{ $course->credits }} credits)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-gray-100 px-6 py-4 flex justify-end">
                        <button type="button" class="mr-3 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Assign Student
                        </button>
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
        // Animation for cards
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = `all 0.5s ease ${index * 0.1}s`;
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });

        // Confirm before removing student
        const removeForms = document.querySelectorAll('form[action*="remove-student"]');
        removeForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to remove this student from the course?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection