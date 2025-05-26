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
     * Redirect logged-in users to their dashboard.
     */
    public function create(): View|RedirectResponse
    {
        // Check if a student is logged in
        if (Auth::guard('student')->check()) {
            return redirect('/student/dashboard');
        }

        // Check if a teacher is logged in
        if (Auth::guard('teacher')->check()) {
            return redirect('/teacher/dashboard');
        }

        // If no user is logged in, show the login page
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

        if ($student = Student::where('email', $email)->first()) {
            if (Hash::check($password, $student->password)) {
                Auth::guard('student')->login($student);
                return redirect()->intended('/student/dashboard'); 
            }
        }

        if ($teacher = Teacher::where('email', $email)->first()) {
            if (Hash::check($password, $teacher->password)) {
                Auth::guard('teacher')->login($teacher);
                return redirect()->intended('/teacher/dashboard');
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function destroy(Request $request): RedirectResponse
    {
        // Force logout from all guards
        foreach (config('auth.guards') as $guardName => $guardConfig) {
            if (method_exists(Auth::guard($guardName), 'logout')) {
                Auth::guard($guardName)->logout();
            }
        }
    
        // Completely destroy the session
        session()->flush();
        session()->regenerate(true);
    
        // Manually remove the session cookie
        $cookie = \Cookie::forget(config('session.cookie'));
    
        // Redirect to login page with a success message
        return redirect()->route('login')
                       ->withCookie($cookie)
                       ->with('status', 'You have been logged out successfully.');
    }
}