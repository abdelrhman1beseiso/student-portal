<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Welcome, {{ Auth::user()->name }}!<br>
                    Your email: {{ Auth::user()->email }}<br>
                    Your enrollment ID: {{ Auth::user()->student_id }}<br>
                    <a href="{{ route('students.index') }}" class="text-blue-500">Go to Student Details</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
