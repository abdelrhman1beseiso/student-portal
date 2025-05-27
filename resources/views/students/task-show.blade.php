<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate__animated animate__fadeIn">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 animate__animated animate__fadeInUp">
                <div class="lg:w-3/4 mx-auto bg-white rounded-lg shadow-lg overflow-hidden
                            border-l-4 border-indigo-600 transition-all duration-300 hover:shadow-xl hover:scale-[1.01]">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-indigo-100 p-3 rounded-full mr-4 flex-shrink-0">
                                <i class="bi bi-file-earmark-text-fill text-indigo-600 text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 leading-tight">{{ $task->title }}</h2>
                                <p class="text-gray-600 text-sm">{{ $task->course->title }}</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-start text-gray-700">
                                <i class="bi bi-info-circle text-gray-500 text-lg mr-3 mt-1 flex-shrink-0"></i>
                                <p class="mb-0">{{ $task->description }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="flex items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                <i class="bi bi-person-circle text-indigo-500 text-xl mr-3 flex-shrink-0"></i>
                                <div>
                                    <small class="text-gray-500 block">Instructor</small>
                                    <span class="font-semibold text-gray-800">{{ $task->teacher->name }}</span>
                                </div>
                            </div>
                            <div class="flex items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                <i class="bi bi-calendar-check text-indigo-500 text-xl mr-3 flex-shrink-0"></i>
                                <div>
                                    <small class="text-gray-500 block">Deadline</small>
                                    <span class="font-semibold {{ $task->deadline->isPast() ? 'text-red-600' : 'text-gray-800' }}">
                                        {{ $task->deadline->format('M d, Y \a\t H:i') }}
                                    </span>
                                    @if ($task->deadline->isPast())
                                        <span class="ml-2 px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">
                                            <i class="bi bi-exclamation-circle mr-1"></i> Passed
                                        </span>
                                        <p class="text-red-500 text-xs mt-1">
                                            <i class="bi bi-clock-history mr-1"></i> Overdue by {{ $task->deadline->diffForHumans(now(), true) }}
                                        </p>
                                    @else
                                        <p class="text-green-600 text-xs mt-1">
                                            <i class="bi bi-hourglass-split mr-1"></i> {{ $task->deadline->diffForHumans(now()) }} remaining
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-8 animate__animated animate__fadeInUp animate__delay-0_5s">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="bg-indigo-100 p-2 rounded-full mr-3 flex-shrink-0">
                        <i class="bi bi-journal-check text-indigo-600 text-lg"></i>
                    </span>
                    Your Submissions
                </h3>

                @forelse($solutions as $solution)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4 p-6
                                border-l-4 border-gray-400 transition-all duration-300 hover:shadow-lg hover:scale-[1.005]">
                        <div class="flex mb-4 text-gray-700">
                            <i class="bi bi-chat-square-text text-gray-500 text-lg mr-3 mt-1 flex-shrink-0"></i>
                            <p class="mb-0 leading-relaxed">{{ $solution->content }}</p>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pt-4 border-t border-gray-200">
                            <div class="mb-3 sm:mb-0">
                            @if($solution->file_path)
                            <a href="{{ route('solutions.download', $solution->id) }}">
                             <i class="bi bi-download mr-2"></i> Download Attachment
                                </a>
                            @endif
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="bi bi-clock-history mr-2"></i>
                                {{ $solution->created_at->format('M d, Y H:i') }}
                                @if($solution->is_late)
                                    <span class="ml-3 px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">
                                        <i class="bi bi-clock mr-1"></i> Late
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-xl p-8 text-center animate__animated animate__fadeIn">
                        <i class="bi bi-inbox text-gray-400 text-6xl mb-4"></i>
                        <h4 class="text-xl font-semibold text-gray-800 mb-2">No submissions yet</h4>
                        <p class="text-gray-600">You haven't submitted any solutions for this task.</p>
                    </div>
                @endforelse
            </div>

            <div class="mb-8 animate__animated animate__fadeInUp animate__delay-1s">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="bg-indigo-100 p-2 rounded-full mr-3 flex-shrink-0">
                        <i class="bi bi-cloud-arrow-up text-indigo-600 text-lg"></i>
                    </span>
                    Submit New Solution
                </h3>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden p-6">
                    <form method="POST" action="{{ route('students.solutions.store', [$student, $task]) }}" enctype="multipart/form-data" id="submit-solution-form">
                        @csrf

                        <div class="mb-6">
                            <label for="content" class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                                <i class="bi bi-pencil-square text-indigo-500 mr-2"></i>
                                Solution Content
                                <span class="text-gray-500 ml-2 font-normal">(Optional if uploading file)</span>
                            </label>
                            <textarea class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out" id="content" name="content" rows="5" placeholder="Enter your solution details..."></textarea>
                        </div>

                        <div class="mb-6">
                            <label for="file" class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                                <i class="bi bi-paperclip text-indigo-500 mr-2"></i>
                                Upload File
                                <span class="text-gray-500 ml-2 font-normal">(Optional)</span>
                            </label>
                            <input class="form-input block w-full text-gray-700
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-md file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-indigo-50 file:text-indigo-700
                                       hover:file:bg-indigo-100"
                                   type="file" id="file" name="file">
                            <p class="mt-2 text-sm text-gray-500">
                                Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max 10MB)
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="bi bi-send-check mr-2"></i> Submit Solution
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('submit-solution-form');
        const content = document.getElementById('content');
        const file = document.getElementById('file');

        form.addEventListener('submit', function(e) {
            if (!content.value.trim() && !file.value) {
                e.preventDefault();
                alert('Please provide either solution content or upload a file.');
            }
        });
    });
</script>