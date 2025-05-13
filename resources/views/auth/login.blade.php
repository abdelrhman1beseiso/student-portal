<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden p-8 space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Welcome Back</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Sign in to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input 
                    id="email" 
                    class="block w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="Enter your email"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 dark:text-red-400" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>
                <x-text-input 
                    id="password" 
                    class="block w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
                    placeholder="Enter your password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
            </div>

            <!-- Role Hint -->
            <div class="text-sm text-center text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 p-3 rounded-lg">
                Use your student or teacher email to log in. The system will detect your role automatically.
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700 dark:checked:bg-indigo-600" 
                    name="remember"
                >
                <label for="remember_me" class="ms-2 text-sm text-gray-600 dark:text-gray-300">
                    {{ __('Remember me') }}
                </label>
            </div>

            <div>
                <x-primary-button class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition duration-150">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 font-medium">
                    {{ __('Register') }}
                </a>
            </div>
        @endif
    </div>
</x-guest-layout>