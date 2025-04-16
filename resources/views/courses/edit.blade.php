@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Course: {{ $course->title }}</h2>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $course->title }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $course->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="credits" class="form-label">Credits</label>
                <input type="number" class="form-control" id="credits" name="credits" min="1" value="{{ $course->credits }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Course Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($course->image)
    <div class="mt-2">
        <img src="{{ $course->image_url }}" width="100" class="img-thumbnail" onerror="this.style.display='none'">
        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
            <label class="form-check-label" for="remove_image">Remove current image</label>
        </div>
    </div>
@endif
                <small class="text-muted">Upload an image (JPEG, PNG, JPG, GIF) max 2MB</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Course</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection