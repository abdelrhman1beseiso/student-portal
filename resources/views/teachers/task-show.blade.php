@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Task Header -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
            <div class="px-6 py-5 bg-indigo-600 border-b border-indigo-500">
                <h2 class="text-2xl font-bold text-white">{{ $task->title }}</h2>
                <p class="text-indigo-100 mt-1">Course: {{ $task->course->name }} | Instructor: {{ $task->teacher->name }}</p>
            </div>
            <div class="px-6 py-4">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900">Task Description</h3>
                        <p class="mt-2 text-gray-600 whitespace-pre-line">{{ $task->description }}</p>
                        
                        <!-- Task Attachment Download Section -->
                        @if($task->attachment_path)
                        <div class="mt-4">
                            <h4 class="text-md font-medium text-gray-900 mb-2">Task Attachment:</h4>
                            <a href="{{ route('teacher.tasks.download', $task) }}" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="bi bi-download mr-2"></i>
                                    Download Task File
                                </a>
                            <p class="mt-1 text-sm text-gray-500">
                                File: {{ basename($task->attachment_path) }}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-4 rounded-lg border border-indigo-100 min-w-[280px]">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-500">Deadline Status</span>
                            @if($task->deadline->isPast())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Deadline Passed
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Active
                                </span>
                            @endif
                        </div>
                        <p class="text-lg font-semibold text-indigo-700">
                            {{ $task->deadline->format('F j, Y \a\t g:i A') }}
                        </p>
                        <p class="text-sm mt-1 {{ $task->deadline->isPast() ? 'text-red-500' : 'text-green-500' }}">
                            @if($task->deadline->isPast())
                                Deadline was {{ $task->deadline->diffForHumans() }}
                            @else
                                Due in {{ $task->deadline->diffForHumans() }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Submissions Section -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Student Submissions</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                        {{ $task->solutions->count() }} {{ Str::plural('Submission', $task->solutions->count()) }}
                    </span>
                </div>
            </div>

            @if($task->solutions->isEmpty())
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No submissions yet</h3>
                    <p class="mt-1 text-gray-500">Students haven't submitted any work for this task.</p>
                </div>
            @else
                <div class="divide-y divide-gray-200">
                    @foreach($task->solutions as $solution)
                    <div class="px-6 py-4 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <span class="text-indigo-600 font-medium">
                                            {{ substr($solution->student->name, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium text-gray-900">{{ $solution->student->name }}</h4>
                                    <p class="text-sm text-gray-500">
                                        Submitted {{ $solution->created_at->diffForHumans() }}
                                        @if($solution->is_late)
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-600 text-white animate-pulse">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-300" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Late Submission
                                        </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                @if($solution->file_path)
                                <a href="{{ route('solutions.download', $solution->id) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="bi bi-download mr-2"></i>
                                    Download Attachment
                                </a>
                                @endif
                            </div>
                        </div>
                        
                        @if($solution->content)
                        <div class="mt-4 pl-14">
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Solution Content:</h5>
                                <p class="text-gray-600 whitespace-pre-line">{{ $solution->content }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection