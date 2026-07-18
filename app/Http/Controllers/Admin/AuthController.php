<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (in_array(Auth::user()->role, ['admin', 'pemilik'])) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }
        return view('admin.auth.login', ['title' => 'Login Admin']);
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            if (in_array(Auth::user()->role, ['admin', 'pemilik'])) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }
        return view('admin.auth.register', ['title' => 'Daftar Pemilik']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (in_array(Auth::user()->role, ['admin', 'pemilik'])) {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Jika bukan admin, logout lagi
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Anda tidak memiliki akses admin atau pemilik.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pemilik', // Default to pemilik for this route
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
