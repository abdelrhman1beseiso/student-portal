@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Explore Our Courses</h1>
                <p class="mt-2 text-gray-600">Browse and manage all available learning opportunities</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('courses.create') }}" 
                   class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-black text-sm font-medium rounded-lg shadow-md hover:from-blue-700 hover:to-blue-600 transition-all transform hover:-translate-y-0.5">
                    <i class="bi bi-plus-circle mr-2"></i> Create New Course
                </a>
                
            </div>
        </div>

        <!-- Empty State -->
        @if($courses->isEmpty())
            <div class="bg-white shadow rounded-xl p-8 text-center max-w-md mx-auto">
                <div class="mx-auto h-24 w-24 text-blue-500 mb-4">
                    <i class="bi bi-book text-5xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">No courses available yet</h3>
                <p class="mt-2 text-gray-500 mb-6">Start building your course catalog by adding the first course</p>
                <a href="{{ route('courses.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="bi bi-plus-lg mr-2"></i> Add Course
                </a>
            </div>
        @else
            <!-- Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-blue-200 group">
                    <!-- Course Image -->
                    @if($course->image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $course->image) }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    @endif

                    <!-- Course Content -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-50 rounded-full">
                                {{ $course->credits }} Credits
                            </span>
                            <span class="text-xs text-gray-500">
                                #{{ str_pad($course->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $course->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $course->description }}</p>

                        <!-- Stats -->
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center space-x-2">
                                <i class="bi bi-people text-gray-400"></i>
                                <span class="text-sm text-gray-600">{{ $course->students->count() }} enrolled</span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('courses.show', $course->id) }}" 
                                   class="p-2 text-gray-500 hover:text-blue-600 transition"
                                   data-bs-toggle="tooltip" title="View Details">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('courses.edit', $course->id) }}" 
                                   class="p-2 text-gray-500 hover:text-blue-600 transition"
                                   data-bs-toggle="tooltip" title="Edit Course">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 text-gray-500 hover:text-red-600 transition"
                                            data-bs-toggle="tooltip" title="Delete Course"
                                            onclick="return confirm('Are you sure you want to delete this course?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 bg-white rounded-xl p-4 shadow-sm">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-600">
                        Showing <span class="font-medium">{{ $courses->firstItem() }}</span>–<span class="font-medium">{{ $courses->lastItem() }}</span> of <span class="font-medium">{{ $courses->total() }}</span> courses
                    </p>
                    <div class="flex items-center">
                        {{ $courses->onEachSide(1)->links('pagination.custom') }}
                    </div>
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

        // Add animation to cards
        const courseCards = document.querySelectorAll('.group');
        courseCards.forEach((card, index) => {
            card.style.transitionDelay = `${index * 50}ms`;
            card.classList.add('opacity-0', 'translate-y-5');
            
            setTimeout(() => {
                card.classList.remove('opacity-0', 'translate-y-5');
            }, 100 + (index * 50));
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
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .pagination .page-item.active .page-link {
        @apply bg-blue-600 border-blue-600 text-white;
    }
    .pagination .page-link {
        @apply text-blue-600 border-gray-300 hover:bg-gray-50;
    }
    .group {
        transition: all 0.3s ease, opacity 0.5s ease, transform 0.5s ease;
    }
</style>
@endpush