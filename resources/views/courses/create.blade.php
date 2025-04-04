@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Add New Course</h2>
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
        
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Course Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div> 
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="credits" class="form-label">Credits</label>
        <input type="number" class="form-control" id="credits" name="credits" min="1" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Course</button>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
</form>
    </div>
</div>
@endsection