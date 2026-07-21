<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    // Register Page
    public function showRegister(): View
    {
        return view('auth.register');
    }

    // Register User
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:15', 'unique:users,phone'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registration completed successfully. Please login.');
    }

    // Login Page
    public function showLogin(): View
    {
        return view('auth.login');
    }

    // Login User (Email or Phone)
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone';

        if (!Auth::attempt([
            $field => $request->login,
            'password' => $request->password,
        ])) {

            return back()
                ->withErrors([
                    'login' => 'Invalid Email/Phone or Password.'
                ])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}