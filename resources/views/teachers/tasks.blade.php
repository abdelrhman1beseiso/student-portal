@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-500 text-white font-medium rounded-md shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-colors duration-300 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 15l-5-5m0 0l5-5m-5 5h14" />
        </svg>
        Go Back
    </a>

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $teacher->name }}'s Tasks</h2>
    <a href="{{ route('teachers.tasks.create', $teacher) }}" class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 text-white font-medium rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-300 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Create New Task
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($tasks as $task)
        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-shadow duration-300 hover:shadow-lg">
            <div class="p-6">
                <h5 class="text-xl font-semibold text-gray-800 mb-2">{{ $task->title }}</h5>
                <p class="text-gray-700 mb-4">{{ $task->description }}</p>
                <p class="text-gray-600 mb-2">Course: <span class="font-medium">{{ $task->course->title }}</span></p>
                <p class="text-gray-600 mb-4">Deadline: <span class="font-medium">{{ $task->deadline->format('M d, Y H:i') }}</span></p>
                <div class="flex justify-between items-center">
                    <a href="{{ route('teachers.tasks.show', [$teacher, $task]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-500 text-move font-medium rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-colors duration-300">
                        View Submissions ({{ $task->solutions_count }})
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <form action="{{ route('teachers.tasks.destroy', [$teacher, $task]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-500 text-move font-medium rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
