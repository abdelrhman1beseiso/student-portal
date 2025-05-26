<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:teacher,student'],
        ]);

        // Check if email exists in either teachers or students table
        if (Teacher::where('email', $request->email)->exists() || 
            Student::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'This email is already registered.']);
        }

        if ($request->role === 'teacher') {
            $user = Teacher::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'specialization' => $request->specialization ?? null,
                'bio' => $request->bio ?? null,
            ]);
            Auth::guard('teacher')->login($user);
            $redirectRoute = 'teacher.dashboard';
        } else {
            $user = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'dob' => $request->dob ?? null,
                'address' => $request->address ?? null,
                'student_id' => 'S' . time() . rand(100, 999),
            ]);
            Auth::guard('student')->login($user);
            $redirectRoute = 'student.dashboard';
        }

       // event(new Registered($user));

        //Auth::login($user);

        return redirect(route($redirectRoute, absolute: false));
    }
}
