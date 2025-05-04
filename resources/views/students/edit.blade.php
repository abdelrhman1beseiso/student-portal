@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Student: {{ $student->name }}</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="{{ old('name', $student->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="{{ old('email', $student->email) }}" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" 
                       value="{{ old('dob', $student->dob->format('Y-m-d')) }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $student->address) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Courses</label>
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input class="form-check-input course-checkbox" type="checkbox" 
                                   name="courses[]" value="{{ $course->id }}" 
                                   id="course{{ $course->id }}"
                                   {{ $student->courses->contains($course->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="course{{ $course->id }}">
                                {{ $course->title }} ({{ $course->credits }} credits)
                            </label>
                        </div>
                        
                        <!-- Teacher Selection (only shown if course is checked) -->
                        <div class="teacher-selection ms-4 mt-2" style="{{ $student->courses->contains($course->id) ? '' : 'display: none;' }}">
                            @if($course->teachers->count() > 0)
                                <select class="form-select form-select-sm" name="teachers[{{ $course->id }}]">
                                    <option value="">Select Teacher</option>
                                    @foreach($course->teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ $student->teachers->contains($teacher->id) && $student->teachers->find($teacher->id)->pivot->course_id == $course->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-warning p-1 mb-0 small">
                                    No teachers available for this course
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.course-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const teacherSelection = this.closest('.col-md-4').querySelector('.teacher-selection');
            teacherSelection.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
@endsection