<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        // If already logged in as admin, redirect to dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle admin login submission.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Please enter your email address.',
            'email.email'       => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
            'password.min'      => 'Password must be at least 6 characters.',
        ]);

        // Admin credentials (stored in .env for security)
        $adminEmail    = config('admin.email',    env('ADMIN_EMAIL',    'admin@example.com'));
        $adminPassword = config('admin.password', env('ADMIN_PASSWORD', 'admin123'));

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            // Store admin session
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_email', $request->email);
            $request->session()->put('admin_name', 'Admin');

            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Invalid email or password. Please try again.']);
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_email', 'admin_name']);
        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }
}
