<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Teacher;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Try student login
        if ($student = Student::where('email', $email)->first()) {
            if (Hash::check($password, $student->password)) {
                Auth::guard('student')->login($student);
                return redirect()->intended('/student/dashboard'); // Redirect to student dashboard
            }
        }

        // Try teacher login
        if ($teacher = Teacher::where('email', $email)->first()) {
            if (Hash::check($password, $teacher->password)) {
                Auth::guard('teacher')->login($teacher);
                return redirect()->intended('/teacher/dashboard'); // Redirect to teacher dashboard
            }
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('student')->logout();
        Auth::guard('teacher')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
