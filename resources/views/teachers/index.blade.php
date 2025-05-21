@extends('layouts.app')

@section('title', 'Teachers List')

@section('styles')
<style>
    .teacher-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-left: 4px solid transparent;
        background: linear-gradient(to bottom right, white, #f9fafb);
    }
    .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-left: 4px solid #6366f1;
    }
    .teacher-avatar {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        text-transform: uppercase;
    }
    .course-badge {
        transition: all 0.2s ease;
        background: linear-gradient(to right, #e0e7ff, #c7d2fe);
    }
    .course-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .action-btn {
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .empty-state {
        background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
        border-radius: 16px;
    }
    .pagination .page-item.active .page-link {
        background: linear-gradient(to right, #6366f1, #8b5cf6);
        border-color: #6366f1;
    }
    .divider {
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(0,0,0,0.1), transparent);
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800">Faculty Members</h1>
            <p class="text-gray-600 mt-2">Manage your institution's teaching staff</p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <div class="relative flex-grow">
                <input type="text" placeholder="Search teachers..." 
                       class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 bg-white/80 backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            
            <a href="{{ route('teachers.create') }}" 
               class="flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                Add Teacher
            </a>
        </div>
    </div>

    @if($teachers->isEmpty())
        <!-- Empty State -->
        <div class="empty-state p-8 rounded-xl text-center max-w-2xl mx-auto">
            <div class="mx-auto h-40 w-40 flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-100 to-indigo-50 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800">No faculty members yet</h3>
            <p class="mt-2 text-gray-600 max-w-md mx-auto">Start building your faculty directory by adding the first teacher</p>
            <div class="mt-6">
                <a href="{{ route('teachers.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700">
                    Add First Teacher
                </a>
            </div>
        </div>
    @else
        <!-- Teachers Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($teachers as $teacher)
            <div class="teacher-card rounded-xl overflow-hidden border border-gray-100">
                <!-- Teacher Header -->
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="teacher-avatar h-14 w-14 rounded-full text-xl">
                            {{ substr($teacher->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $teacher->name }}</h3>
                            <p class="text-sm text-gray-500 truncate">{{ $teacher->email }}</p>
                        </div>
                    </div>
                    
                    <!-- Specialization -->
                    <div class="mt-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            {{ $teacher->specialization }}
                        </span>
                    </div>
                    
                    <!-- Courses -->
                    @if($teacher->courses->isNotEmpty())
                    <div class="mt-5">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Teaching Courses</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($teacher->courses as $course)
                            <span class="course-badge px-3 py-1 rounded-full text-xs font-medium text-gray-800">
                                {{ $course->title }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Divider -->
                <div class="divider mx-6"></div>
                
                <!-- Actions -->
                <div class="px-6 py-4 flex justify-end space-x-2">
                    <a href="{{ route('teachers.show', $teacher->id) }}" 
                       class="action-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View
                    </a>
                    <a href="{{ route('teachers.edit', $teacher->id) }}" 
                       class="action-btn inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="action-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700"
                                onclick="return confirm('Are you sure you want to delete this teacher?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $teachers->links() }}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Animate cards on load
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.teacher-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.animation = `fadeInUp 0.5s ease forwards ${index * 0.1}s`;
        });

        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endsection