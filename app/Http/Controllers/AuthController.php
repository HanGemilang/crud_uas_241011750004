<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin()
    {
        // If already logged in, redirect to dashboard
        if (session()->has('user_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Find User
        $user = User::where('email', $request->email)->first();

        // Check password using Hash::check()
        if ($user && Hash::check($request->password, $user->password)) {
            // Set sessions
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
            ]);

            return redirect()->route('admin.dashboard');
        }

        // Login failed, return with flash error message
        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

    /**
     * Handle admin logout request.
     */
    public function logout(Request $request)
    {
        // Remove user sessions
        session()->forget(['user_id', 'user_name']);

        // Regenerate session to prevent session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    }
}
