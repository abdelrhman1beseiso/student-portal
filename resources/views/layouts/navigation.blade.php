<nav class="bg-white dark:bg-gray-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Common Navigation -->
                <a href="{{ route('welcome') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                    Home
                </a>

                <!-- Student Navigation -->
                @auth('student')
                    <a href="{{ route('student.dashboard') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        Student Dashboard
                    </a>
                    <a href="{{ route('student.profile.edit') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        My Profile
                    </a>
                    <span class="ml-4 text-gray-700 dark:text-gray-300 text-sm font-medium">
                        Welcome, {{ auth('student')->user()->name }}
                    </span>
                @endauth

                <!-- Teacher Navigation -->
                @auth('teacher')
                    <a href="{{ route('teacher.dashboard') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        Teacher Dashboard
                    </a>
                    <a href="{{ route('teacher.profile.edit') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        My Profile
                    </a>
                    <a href="{{ route('courses.index') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        Manage Courses
                    </a>
                    <span class="ml-4 text-gray-700 dark:text-gray-300 text-sm font-medium">
                        Welcome, {{ auth('teacher')->user()->name }}
                    </span>
                @endauth
            </div>

            <div class="flex items-center">
                <!-- Authentication Links -->
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Register
                        </a>
                    @endif
                @else
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
