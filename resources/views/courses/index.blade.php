@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Course Catalog</h1>
                <p class="mt-1 text-sm text-gray-500">Manage all available courses</p>
            </div>
            <a href="{{ route('courses.create') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                <i class="bi bi-plus-circle mr-2"></i> Add New Course
            </a>
        </div>

        @if($courses->isEmpty())
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <i class="bi bi-book text-4xl text-gray-300 mb-3"></i>
                <h3 class="text-lg font-medium text-gray-700">No courses found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by adding your first course</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                <div class="bg-white shadow-lg rounded-xl border border-gray-200 overflow-hidden hover:shadow-xl transition">
                    <div class="p-6 h-full flex flex-col">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full mb-1">
                                    #{{ $course->id }}
                                </span>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $course->title }}</h3>
                            </div>
                            @if($course->image)
                            <div class="flex-shrink-0 ml-4">
                                <img src="{{ asset('storage/' . $course->image) }}" 
                                     class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                            </div>
                            @endif
                        </div>

                        <p class="text-gray-600 mb-4 flex-grow-1">{{ $course->description }}</p>

                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="bi bi-credit-card mr-1"></i> {{ $course->credits }} Credits
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="bi bi-people mr-1"></i> {{ $course->students->count() }} Students
                                </span>
                            </div>

                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('courses.edit', $course->id) }}" 
                                   class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                   data-bs-toggle="tooltip" title="Edit Course">
                                    <i class="bi bi-pencil mr-1"></i> Edit
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition"
                                            data-bs-toggle="tooltip" title="Delete Course"
                                            onclick="return confirm('Are you sure you want to delete this course?')">
                                        <i class="bi bi-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center bg-white rounded-lg p-4 shadow-sm">
                <p class="text-sm text-gray-600 mb-4 sm:mb-0">
                    Showing <span class="font-medium">{{ $courses->firstItem() }}</span> to 
                    <span class="font-medium">{{ $courses->lastItem() }}</span> of 
                    <span class="font-medium">{{ $courses->total() }}</span> courses
                </p>
                <div class="flex items-center">
                    {{ $courses->onEachSide(1)->links('pagination.custom') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Add hover effect to course cards
        const courseCards = document.querySelectorAll('.bg-white.shadow-lg');
        courseCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('ring-2', 'ring-blue-500');
                card.classList.remove('shadow-lg');
                card.classList.add('shadow-xl');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('ring-2', 'ring-blue-500');
                card.classList.add('shadow-lg');
                card.classList.remove('shadow-xl');
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
    .course-card {
        transition: all 0.2s ease;
    }
    .pagination .page-item.active .page-link {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }
    .pagination .page-link {
        color: #3b82f6;
    }
</style>
@endpush