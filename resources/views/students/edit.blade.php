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
                <textarea class="form-control" id="address" name="address" rows="3" required>
                    {{ old('address', $student->address) }}
                </textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Courses</label>
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="courses[]" value="{{ $course->id }}" 
                                   id="course{{ $course->id }}"
                                   {{ $student->courses->contains($course->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="course{{ $course->id }}">
                                {{ $course->title }} ({{ $course->credits }} credits)
                            </label>
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
@endsection