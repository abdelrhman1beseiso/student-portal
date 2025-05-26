<x-app-layout>
  <x-slot name="header">
   <h2 class="text-3xl font-extrabold text-indigo-900 leading-tight tracking-tight">
    {{ __('Teacher Dashboard') }}
   </h2>
  </x-slot>

  <div class="py-12 bg-indigo-50">
   <div class="max-w-5xl mx-auto px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-3xl border border-indigo-200">
     <div class="px-8 py-12">
      <div class="mb-8">
       <h3 class="text-2xl font-semibold text-indigo-800">
        👋 Welcome back, <span class="text-indigo-600">{{ Auth::user()->name }}</span>!
       </h3>
       <p class="mt-2 text-md text-gray-600">
        Your personalized teaching overview awaits.
       </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-gray-800">
       <div
        class="bg-indigo-100 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-300 ease-in-out">
        <div class="flex items-center space-x-4">
         <div class="p-2 rounded-md bg-indigo-200">
          <svg class="w-6 h-6 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
         </div>
         <div>
          <span class="block text-sm font-medium text-indigo-500">Full Name</span>
          <span class="text-lg font-semibold">{{ Auth::user()->name }}</span>
         </div>
        </div>
       </div>

       <div class="bg-blue-100 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-300 ease-in-out">
        <div class="flex items-center space-x-4">
         <div class="p-2 rounded-md bg-blue-200">
          <svg class="w-6 h-6 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-7 2v4m-7-4v4m-1 5h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 012-2h1z" />
          </svg>
         </div>
         <div>
          <span class="block text-sm font-medium text-blue-500">Email Address</span>
          <span class="text-lg font-semibold">{{ Auth::user()->email }}</span>
         </div>
        </div>
       </div>

       <div
        class="bg-green-100 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-300 ease-in-out sm:col-span-2">
        <div class="flex items-center space-x-4">
         <div class="p-2 rounded-md bg-green-200">
          <svg class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 21h10a2 2 0 002-2V9a2 2 0 00-2-2h-10a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6m-3 3v3m-3-3h6m2 0h.01M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
         </div>
         <div>
          <span class="block text-sm font-medium text-green-500">Specialization</span>
          <span class="text-lg font-semibold">{{ Auth::user()->specialization }}</span>
         </div>
        </div>
       </div>
      </div>
       <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-4">
    <a href="{{ route('teachers.tasks', Auth::user()) }}"
       class="inline-flex items-center justify-center px-6 py-3 bg-black-600 text-move text-md font-semibold rounded-full shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300 ease-in-out">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        View and Create New Task
    </a>
    
    <a href="{{ route('teachers.show', Auth::user()) }}"
       class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white text-md font-semibold rounded-full shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        View My Profile
    </a>
    <a href="{{ route('teachers.edit', Auth::user()) }}"
       class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white text-md font-semibold rounded-full shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        Edit Profile
    </a>
</div>
<div class="mt-10 animate__animated animate__fadeInUp animate__delay-4s">
       
      </div>

     </div>
    </div>
   </div>
  </div>

  <div id="keyVerificationModal"
   class="fixed z-10 inset-0 overflow-y-auto hidden"
   aria-labelledby="modal-title" role="dialog" aria-modal="true">
   <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    <div
     class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
     <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
      <div class="sm:flex sm:items-start">
       <div
        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
        <i class="fas fa-key text-red-600"></i>
       </div>
       <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
         Key Verification
        </h3>
        <div class="mt-2">
         <p class="text-sm text-gray-500">
          Please enter the valid key to proceed.
         </p>
         <input type="password" id="keyInput"
          class="mt-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
          placeholder="Enter key" />
         <p id="keyError" class="text-red-500 text-sm mt-2 hidden">Invalid key.</p>
        </div>
       </div>
      </div>
     </div>
     <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
      <button type="button" id="verifyKeyBtn"
       class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
       Verify
      </button>
      <button type="button" id="cancelKeyBtn"
       class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
       Cancel
      </button>
     </div>
    </div>
   </div>
  </div>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
   integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
   crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script>


  viewDetailsBtn.addEventListener('click', () => {
   keyVerificationModal.classList.remove('hidden');
  });

  cancelKeyBtn.addEventListener('click', () => {
   keyVerificationModal.classList.add('hidden');
   keyError.classList.add('hidden'); // Ensure error message is hidden on cancel
   keyInput.value = ''; // Clear the input field
  });

  verifyKeyBtn.addEventListener('click', () => {
   if (keyInput.value === '0000') {
    window.location.href = "{{ route('teachers.index') }}"; // Replace with your actual route
   } else {
    keyError.classList.remove('hidden');
   }
  });
  </script>
  <style>
  /* Optional custom styles */
  </style>
 </x-app-layout>