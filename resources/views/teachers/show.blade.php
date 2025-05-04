@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2>{{ $teacher->name }}</h2>
            <p class="mb-0">{{ $teacher->specialization }}</p>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $teacher->email }}</p>
            <p><strong>Bio:</strong> {{ $teacher->bio }}</p>
        </div>
    </div>

    <!-- Teacher's Courses Section -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h4>Assigned Courses</h4>
        </div>
        <div class="card-body">
            @if($teacher->courses->count() > 0)
                <ul class="list-group">
                    @foreach($teacher->courses as $course)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $course->title }} ({{ $course->credits }} credits)
                            <span class="badge bg-primary">
                                {{ $course->students_count }} students
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No courses assigned</p>
            @endif
        </div>
    </div>

    <!-- Students Directly Assigned to Teacher -->
    <div class="card mb-4 border-success">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h4>Directly Assigned Students</h4>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#assignStudentModal">
                <i class="fas fa-plus"></i> Assign Student
            </button>
        </div>
        <div class="card-body">
            @if($teacher->students->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Enrolled</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teacher->students as $student)
                                @php
                                    $course = $student->courses()
                                        ->where('courses.id', $student->pivot->course_id)
                                        ->first();
                                @endphp
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $course ? $course->title : 'N/A' }}</td>
                                    <td>
                                        @if($course)
                                            {{ $course->pivot->enrolled_at->format('Y-m-d') }}
                                        @endif
                                    </td>
                                    <td>
                                    <form action="{{ route('teacher-course.remove-student') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="course_id" value="{{ $student->pivot->course_id }}">
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                         onclick="return confirm('Are you sure you want to remove this student from the course?')">
                                         <i class="fas fa-times"></i> Remove
                                     </button>
                                     </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No students directly assigned</p>
            @endif
        </div>
    </div>
    <div class="card">
    <div class="card-header bg-light">
        <h4>All Students in Teacher's Courses</h4>
    </div>
    <div class="card-body">
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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Enrollment Date</th>
                            <th>Course</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allStudents as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    @if(is_string($student->enrollment_date))
                                        {{ \Carbon\Carbon::parse($student->enrollment_date)->format('Y-m-d') }}
                                    @else
                                        {{ $student->enrollment_date->format('Y-m-d') }}
                                    @endif
                                </td>
                                <td>{{ $student->course_title }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No students enrolled in teacher's courses</p>
        @endif
    </div>
</div>

    <!-- Assign Student Modal -->
    <div class="modal fade" id="assignStudentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('teacher-course.assign-student') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Student</label>
                            <select class="form-select" name="student_id" required>
                                <option value="">Select Student</option>
                                @foreach(App\Models\Student::all() as $student)
                                    @if(!$teacher->students->contains($student->id))
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <select class="form-select" name="course_id" required>
                                <option value="">Select Course</option>
                                @foreach($teacher->courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
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
        // Confirm before removing student from course
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