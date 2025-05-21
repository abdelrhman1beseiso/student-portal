<nav class="bg-white dark:bg-gray-800 shadow-lg animate__animated animate__fadeInDown">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('welcome') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200 ease-in-out">
                    <i class="fas fa-home mr-2"></i> Home
                </a>

                <div class="ml-4 flex items-center space-x-3">
                    <a href="{{ route('student.dashboard') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 px-3 py-2 rounded-md text-sm font-semibold transition duration-200 ease-in-out">
                        <i class="fas fa-graduation-cap mr-2"></i> Dashboard
                    </a>
                    
                    <span class="text-gray-700 dark:text-gray-300 text-sm font-medium">
                        <i class="fas fa-user mr-1"></i> {{ auth('student')->user()->name }}
                    </span>
                </div>
            </div>

            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="ml-4 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200 ease-in-out focus:outline-none">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>