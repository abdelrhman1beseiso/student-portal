<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-extrabold text-gray-900 leading-tight tracking-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl border border-gray-200">
                <div class="px-8 py-10">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Welcome back, {{ Auth::user()->name }} 👋
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Here's a quick overview of your teaching profile.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
                        <div class="space-y-1">
                            <span class="block text-sm font-medium text-gray-500">Full Name</span>
                            <span class="text-base font-semibold">{{ Auth::user()->name }}</span>
                        </div>

                        <div class="space-y-1">
                            <span class="block text-sm font-medium text-gray-500">Email Address</span>
                            <span class="text-base font-semibold">{{ Auth::user()->email }}</span>
                        </div>

                        <div class="space-y-1">
                            <span class="block text-sm font-medium text-gray-500">Specialization</span>
                            <span class="text-base font-semibold">{{ Auth::user()->specialization }}</span>
                        </div>
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('teachers.index') }}"
                           class="inline-flex items-center px-5 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                            View Full Teacher Profile
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
