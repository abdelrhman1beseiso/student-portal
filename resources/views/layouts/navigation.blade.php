<nav class="bg-white dark:bg-gray-800 shadow-lg animate__animated animate__fadeInDown">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('welcome') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200 ease-in-out">
                    <i class="fas fa-home mr-2"></i> Home
                </a>

                @auth
                    @if(auth()->guard('student')->check())
                        @include('layouts.student-navigation')
                    @elseif(auth()->guard('teacher')->check())
                        @include('layouts.teacher-navigation')
                    @endif
                @endauth
            </div>

            <div class="flex items-center">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200 ease-in-out">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200 ease-in-out">
                            <i class="fas fa-user-plus mr-2"></i> Register
                        </a>
                    @endif
                @else
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                         @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://kit.fontawesome.com/your_fontawesome_kit.js" crossorigin="anonymous"></script>
</nav>