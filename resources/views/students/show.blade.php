@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Student Details</h2>
                    <p class="text-sm text-gray-500 mt-1">Complete profile information</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    <i class="bi bi-person-badge mr-1"></i> ID: #{{ $student->id }}
                </span>
            </div>

            <!-- Card Body -->
            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Basic Information -->
                    <div>
                        <div class="flex items-center mb-4">
                            <i class="bi bi-info-circle-fill text-blue-500 mr-2"></i>
                            <h3 class="text-lg font-semibold text-gray-800">Basic Information</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Name : </div>
                                <div class="w-2/3 text-gray-700">{{ $student->name }}</div>
                            </div>
                            
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Email : </div>
                                <div class="w-2/3">
                                    <a href="mailto:{{ $student->email }}" class="text-blue-600 hover:text-blue-800 transition">
                                        {{ $student->email }}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Date of Birth  : </div>
                                <div class="w-2/3 text-gray-700">{{ $student->dob->format('M d, Y') }}</div>
                            </div>
                            
                            <div class="flex">
                                <div class="w-1/3 text-sm font-medium text-gray-500">Address   : </div>
                                <div class="w-2/3 text-gray-700">{{ $student->address ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Courses -->
                    <div>
                        <div class="flex items-center mb-4">
                            <i class="bi bi-book-fill text-blue-500 mr-2"></i>
                            <h3 class="text-lg font-semibold text-gray-800">Enrolled Courses</h3>
                        </div>
                        
                        @if($student->courses->count() > 0)
                            <div class="space-y-3">
                                @foreach($student->courses as $course)
                                <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-800">{{ $course->title }}</h4>
                                            @php
                                                $teacher = $student->teachers()
                                                    ->wherePivot('course_id', $course->id)
                                                    ->first();
                                            @endphp
                                            @if($teacher)
                                                <p class="text-sm text-gray-500 mt-1">
                                                    <i class="bi bi-person-fill mr-1"></i> {{ $teacher->name }}
                                                </p>
                                            @endif
                                        </div>
                                        <span class="text-xs font-medium px-2 py-1 bg-gray-100 text-gray-700 rounded-full">
                                            Enrolled: {{ $course->pivot->enrolled_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-info-circle-fill text-blue-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            This student is not enrolled in any courses yet.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end space-x-3">
                <a href="{{ route('students.edit', $student->id) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <i class="bi bi-pencil mr-2"></i> Edit Student
                </a>
                <a href="{{ route('students.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <i class="bi bi-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bi {
        display: inline-block;
        vertical-align: -0.125em;
        fill: currentColor;
    }
</style>
@endpush