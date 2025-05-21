<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate__animated animate__fadeIn">
            {{ __('Your Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 px-4 sm:px-0">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center animate__animated animate__fadeInLeft">
                        <i class="bi bi-clipboard2-check text-indigo-600 mr-3"></i> Your Tasks
                    </h1>
                    <p class="text-gray-600 mt-1 animate__animated animate__fadeInLeft animate__delay-0_5s">Manage your current assignments</p>
                </div>
                <span class="mt-4 sm:mt-0 px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full font-semibold text-sm shadow animate__animated animate__fadeInRight animate__delay-0_8s">
                    {{ count($tasks) }} {{ Str::plural('Task', count($tasks)) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tasks as $task)
                    @php
                        $now = now();
                        $isUrgent = $task->deadline->diffInHours($now) < 24 && !$task->deadline->isPast();
                        $isPastDue = $task->deadline->isPast();

                        $statusColorClass = $isPastDue ? 'border-red-500' : ($isUrgent ? 'border-yellow-500' : 'border-indigo-600');
                        $textColorClass = $isPastDue ? 'text-red-600' : ($isUrgent ? 'text-yellow-600' : 'text-indigo-600');
                        $badgeBgClass = $isPastDue ? 'bg-red-100 text-red-700' : ($isUrgent ? 'bg-yellow-100 text-yellow-800' : 'bg-indigo-100 text-indigo-800');
                        $buttonClass = $isPastDue ? 'bg-gray-500 hover:bg-gray-600' : ($isUrgent ? 'bg-yellow-500 hover:bg-yellow-600 text-yellow-900' : 'bg-indigo-600 hover:bg-indigo-700');

                        $statusText = $isPastDue ? 'Past Due' : ($isUrgent ? 'Due Soon' : 'Active');
                        $statusIcon = $isPastDue ? 'bi-exclamation-circle' : ($isUrgent ? 'bi-hourglass-split' : 'bi-calendar-event');
                    @endphp

                    <div class="relative bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl
                                border-l-4 {{ $statusColorClass }} animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight">
                                    <a href="{{ route('students.tasks.show', [$student, $task]) }}"
                                       class="hover:underline-offset-4 hover:underline decoration-2 decoration-indigo-500">
                                        {{ $task->title }}
                                    </a>
                                </h3>
                                <span class="px-3 py-1 {{ $badgeBgClass }} rounded-full text-xs font-semibold flex items-center ml-2">
                                    <i class="bi {{ $statusIcon }} mr-1"></i>
                                    {{ $statusText }}
                                </span>
                            </div>

                            <p class="text-gray-700 mb-4 flex-grow">{{ Str::limit($task->description, 100) }}</p>

                            <div class="bg-gray-50 p-4 rounded-md mb-4 text-sm text-gray-700">
                                <div class="flex items-center mb-2">
                                    <i class="bi bi-book text-indigo-500 mr-2"></i>
                                    <span>{{ $task->course->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="bi bi-person text-indigo-500 mr-2"></i>
                                    <span>{{ $task->teacher->name }}</span>
                                </div>
                            </div>

                            <div class="mt-auto pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <i class="bi bi-calendar-event mr-2 {{ $textColorClass }}"></i>
                                        <small class="{{ $textColorClass }}">
                                            Due {{ $task->deadline->format('M d, Y \a\t H:i') }}
                                        </small>
                                        @if ($isPastDue)
                                            <p class="text-red-500 text-xs mt-1">
                                                <i class="bi bi-clock-history mr-1"></i> Overdue by {{ $task->deadline->diffForHumans($now, true) }}
                                            </p>
                                        @else
                                            <p class="text-green-600 text-xs mt-1">
                                                <i class="bi bi-hourglass-split mr-1"></i> {{ $task->deadline->diffForHumans($now) }} remaining
                                            </p>
                                        @endif
                                    </div>
                                    <small class="text-gray-500">
                                        <i class="bi bi-clock-history mr-2"></i>
                                        Created {{ $task->created_at->format('M d') }}
                                    </small>
                                </div>
                                <a href="{{ route('students.tasks.show', [$student, $task]) }}"
                                   class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md font-semibold text-black uppercase tracking-widest transition ease-in-out duration-150 shadow-md {{ $buttonClass }}">
                                    <i class="bi bi-arrow-right-circle mr-2"></i> View Task
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-lg shadow-xl p-8 text-center">
                            <i class="bi bi-check-circle text-green-500 text-6xl mb-4 animate__animated animate__bounceIn"></i>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-2">No tasks assigned</h3>
                            <p class="text-gray-600">You're all caught up with your work!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</x-app-layout>

<style>
    /* Custom utility to animate the underline */
    .hover\:underline-offset-4:hover {
        text-underline-offset: 4px;
    }

    .hover\:underline.decoration-indigo-500:hover {
        text-decoration-color: #6366f1; /* Tailwind indigo-500 */
    }
</style>