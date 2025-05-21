@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Student Management</h1>
                <p class="mt-1 text-sm text-gray-500">View and manage all registered students</p>
            </div>
            <a href="{{ route('students.create') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                <i class="bi bi-plus-circle mr-2"></i> Add New Student
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date of Birth
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Courses
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($students as $student)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $student->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $student->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <a href="mailto:{{ $student->email }}" class="text-blue-600 hover:text-blue-800 transition">
                                    {{ $student->email }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $student->dob->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="bi bi-book mr-1"></i> {{ $student->courses->count() }} Courses
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('students.show', $student->id) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-blue-500 text-sm font-medium rounded-lg text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                       data-bs-toggle="tooltip" title="View Details">
                                        <i class="bi bi-eye mr-1"></i> View
                                    </a>
                                    <a href="{{ route('students.edit', $student->id) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-yellow-500 text-sm font-medium rounded-lg text-yellow-600 bg-white hover:bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition"
                                       data-bs-toggle="tooltip" title="Edit Student">
                                        <i class="bi bi-pencil mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 border border-red-500 text-sm font-medium rounded-lg text-red-600 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition"
                                                data-bs-toggle="tooltip" title="Delete Student"
                                                onclick="return confirm('Are you sure you want to delete this student?')">
                                            <i class="bi bi-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center bg-white rounded-lg p-4 shadow-sm">
            <p class="text-sm text-gray-600 mb-4 sm:mb-0">
                Showing <span class="font-medium">{{ $students->firstItem() }}</span> to 
                <span class="font-medium">{{ $students->lastItem() }}</span> of 
                <span class="font-medium">{{ $students->total() }}</span> students
            </p>
            <div class="flex items-center">
                {{ $students->onEachSide(1)->links('pagination.custom') }}
            </div>
        </div>
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
    table {
        min-width: 768px;
    }
    @media (min-width: 1024px) {
        table {
            min-width: 100%;
        }
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