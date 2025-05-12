@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Teacher</h1>
    
    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" required>
</div>
        <div class="mb-3">
            <label for="specialization" class="form-label">Specialization</label>
            <input type="text" class="form-control" id="specialization" name="specialization" required>
        </div>
        
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Assign Courses</label>
            @foreach($courses as $course)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" id="course{{ $course->id }}">
                <label class="form-check-label" for="course{{ $course->id }}">
                    {{ $course->title }} ({{ $course->credits }} credits)
                </label>
            </div>
            @endforeach
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection