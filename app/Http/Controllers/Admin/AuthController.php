<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $adminUsername = env('ADMIN_USERNAME', 'admin');
        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        if ($credentials['username'] !== $adminUsername || $credentials['password'] !== $adminPassword) {
            return back()
                ->withErrors(['username' => 'Invalid admin login details.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_logged_in', true);

        return redirect()->route('admin.investment.edit');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
