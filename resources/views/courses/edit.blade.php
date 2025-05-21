@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-xl animate__animated animate__fadeIn">
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-indigo-700">
            <i class="fas fa-edit mr-2"></i> Edit Course: <span class="text-indigo-500">{{ $course->title }}</span>
        </h2>
        <p class="mt-1 text-gray-600">
            Modify the course details below.
        </p>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
            <strong class="font-bold">Whoops!</strong> There were some problems with your input.
            <ul class="list-disc list-inside mt-2 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-signature mr-2"></i> Course Title
            </label>
            <input type="text" id="title" name="title" value="{{ $course->title }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-file-alt mr-2"></i> Description
            </label>
            <textarea id="description" name="description" rows="3" required
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $course->description }}</textarea>
        </div>

        <div>
            <label for="credits" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-graduation-cap mr-2"></i> Credits
            </label>
            <input type="number" id="credits" name="credits" min="1" value="{{ $course->credits }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">
                <i class="fas fa-image mr-2"></i> Course Image
            </label>
            <input type="file" id="image" name="image"
                   class="mt-1 block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-700
                          hover:file:bg-indigo-100" accept="image/*">
            @if($course->image)
                <div class="mt-2">
                    <img src="{{ $course->image_url }}" width="100" class="rounded-md shadow-sm border" onerror="this.style.display='none'">
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500"
                                   id="remove_image" name="remove_image" value="1">
                            <span class="ml-2 text-sm text-gray-600">Remove current image</span>
                        </label>
                    </div>
                </div>
            @endif
            <small class="text-gray-500">Upload a new image (JPEG, PNG, JPG, GIF) max 2MB</small>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('courses.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
                <i class="fas fa-times mr-2"></i> Cancel
            </a>
            <button type="submit"
                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
                <i class="fas fa-save mr-2"></i> Update Course
            </button>
        </div>
    </form>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://kit.fontawesome.com/your_fontawesome_kit.js" crossorigin="anonymous"></script>
</div>
@endsection