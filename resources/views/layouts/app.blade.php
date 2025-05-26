<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://kit.fontawesome.com/your_fontawesome_kit.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Force option styling -->
    <style>
        /* Fix for invisible select options */
        select,
        select option {
            color: #111827 !important; /* text-gray-900 */
            background-color: #ffffff !important;
            font-family: 'Figtree', sans-serif !important;
            font-size: 16px !important;
            line-height: 1.5 !important;
        }

        select:invalid {
            color: #9CA3AF !important; /* text-gray-400 for placeholder */
        }

        select option:hover,
        select option:checked {
            background-color: #E0E7FF !important; /* light indigo hover */
        }
    </style>

    @stack('head')
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white text-black">
    
    @auth('student')
        @include('layouts.student-navigation')
    @endauth

    @auth('teacher')
        @include('layouts.teacher-navigation')
    @endauth

    @isset($header)
        <header class="bg-white text-black border-b">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main>
        {{ $slot ?? '' }}
        @hasSection('content')
            @yield('content')
        @endif
    </main>

    @isset($footer)
        <footer class="bg-white text-black border-t py-6">
            {{ $footer }}
        </footer>
    @endisset

    @stack('scripts')
</body>
</html>
