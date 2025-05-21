<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight animate__animated animate__fadeIn">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg animate__animated animate__fadeInUp animate__delay-1s">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center space-x-4 animate__animated animate__fadeInLeft animate__delay-2s">
                        <div class="rounded-full bg-indigo-100 p-3">
                            <svg class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Hello, <span class="text-indigo-600">{{ Auth::user()->name }}</span>!</h3>
                            <p class="text-sm text-gray-500">Welcome to your personalized dashboard.</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 animate__animated animate__fadeInRight animate__delay-2s">
                        <div class="rounded-full bg-blue-100 p-3">
                            <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-7 2v4m-7-4v4m-1 5h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 012-2h1z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Your Email</h3>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 animate__animated animate__fadeInLeft animate__delay-3s">
                        <div class="rounded-full bg-green-100 p-3">
                            <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2a9 9 0 00-9-9v1h-1a2 2 0 00-2 2v9a2 2 0 002 2h1a7 7 0 017-7zm7 9h1a2 2 0 002-2v-9a2 2 0 00-2-2h-1a7 7 0 01-7 7v-1a9 9 0 009 9z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Enrollment ID</h3>
                            <p class="text-sm text-gray-500">{{ Auth::user()->student_id }}</p>
                        </div>
                    </div>
                     <div class="flex items-center space-x-4 animate__animated animate__fadeInRight animate__delay-3s">
                        <div class="rounded-full bg-orange-100 p-3">
                            <svg class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Student Details</h3>
                            <button onclick="showKeyModal('{{ route('students.index') }}')" class="mt-1 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-info-circle mr-2"></i> View All Details
                            </button>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 mt-8 px-6 pb-6 animate__animated animate__fadeInUp animate__delay-4s">
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('students.tasks', Auth::user()) }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-indigo-600 border border-transparent rounded-full font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            View & Submit Tasks
                        </a>

                        <a href="{{ route('students.show', Auth::user()) }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-blue-600 border border-transparent rounded-full font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            View Profile
                        </a>

                        <a href="{{ route('students.edit', Auth::user()) }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-green-600 border border-transparent rounded-full font-semibold text-black hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="keyModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 2h.01m-6-9h12a2 2 0 002 2v10a2 2 0 00-2 2H6a2 2 0 00-2-2V5a2 2 0 002-2z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Enter Access Key
                            </h3>
                            <div class="mt-2">
                                <input type="password" id="accessKey" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md text-center" placeholder="">
                                <p id="invalidKey" class="text-red-500 text-sm mt-1 text-center hidden">Invalid Key!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="checkKey()">
                        Access
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeKeyModal()">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        let targetUrl;

        function showKeyModal(url) {
            targetUrl = url;
            document.getElementById('keyModal').classList.remove('hidden');
            document.getElementById('accessKey').value = ''; // Clear any previous input
            document.getElementById('invalidKey').classList.add('hidden'); // Ensure error message is hidden
        }

        function closeKeyModal() {
            document.getElementById('keyModal').classList.add('hidden');
            document.getElementById('invalidKey').classList.add('hidden');
            document.getElementById('accessKey').value = '';
        }

        function checkKey() {
            const enteredKey = document.getElementById('accessKey').value;
            const defaultKey = '0000'; // Define your default key here
            const invalidKeyMessage = document.getElementById('invalidKey');

            if (enteredKey === defaultKey) {
                window.location.href = targetUrl;
            } else {
                invalidKeyMessage.classList.remove('hidden');
                setTimeout(() => {
                    invalidKeyMessage.classList.add('hidden');
                }, 1500); // Hide the message after 1.5 seconds
            }
        }
    </script>
</x-app-layout>

<style>
    /* Add any custom styles here if needed */
    .grid-cols-2 > div {
        display: flex;
        align-items: center;
    }
</style>