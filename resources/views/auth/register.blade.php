<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register as')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <option value="">Select your role</option>
                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Teacher Specific Fields -->
        <div id="teacher-fields" class="mt-4 space-y-4" style="display: none;">
            <div>
                <x-input-label for="specialization" :value="__('Specialization')" />
                <x-text-input id="specialization" class="block mt-1 w-full" type="text" name="specialization" :value="old('specialization')" />
                <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="bio" :value="__('Bio')" />
                <textarea id="bio" name="bio" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('bio') }}</textarea>
                <x-input-error :messages="$errors->get('bio')" class="mt-2" />
            </div>
        </div>

        <!-- Student Specific Fields -->
        <div id="student-fields" class="mt-4 space-y-4" style="display: none;">
            <div>
                <x-input-label for="dob" :value="__('Date of Birth')" />
                <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" />
                <x-input-error :messages="$errors->get('dob')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="address" :value="__('Address')" />
                <textarea id="address" name="address" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('address') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            const teacherFields = document.getElementById('teacher-fields');
            const studentFields = document.getElementById('student-fields');
            
            if (this.value === 'teacher') {
                teacherFields.style.display = 'block';
                studentFields.style.display = 'none';
            } else if (this.value === 'student') {
                teacherFields.style.display = 'none';
                studentFields.style.display = 'block';
            } else {
                teacherFields.style.display = 'none';
                studentFields.style.display = 'none';
            }
        });

        // Trigger change event on page load to show/hide fields based on old input
        document.getElementById('role').dispatchEvent(new Event('change'));
    </script>
</x-guest-layout>
