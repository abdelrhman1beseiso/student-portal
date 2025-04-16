@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Students List</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add New Student
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="80px">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="120px">Date of Birth</th>
                    <th width="120px">Courses</th>
                    <th width="150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td class="fw-bold">#{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></td>
                    <td>{{ $student->dob->format('Y-m-d') }}</td>
                    <td>
                        <span class="badge bg-primary rounded-pill">
                            {{ $student->courses->count() }} Courses
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('students.show', $student->id) }}" 
                               class="btn btn-sm btn-info" title="View" data-bs-toggle="tooltip">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('students.edit', $student->id) }}" 
                               class="btn btn-sm btn-warning" title="Edit" data-bs-toggle="tooltip">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        title="Delete" data-bs-toggle="tooltip"
                                        onclick="return confirm('Are you sure you want to delete this student?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @section('pagination')
    <div class="row mt-4">
        <div class="col-md-6">
            <p class="pagination-info">
                Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} 
                of {{ $students->total() }} students
            </p>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            {{-- Use custom pagination view --}}
            {{ $students->onEachSide(1)->links('pagination.custom') }}
        </div>
    </div>
@endsection
</div>
@endsection

@section('scripts')
<script>
    // Enable Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection