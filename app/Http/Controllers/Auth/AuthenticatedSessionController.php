<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        // ✅ Proses login (sudah include Auth::attempt)
        $request->authenticate();

        // ✅ Regenerate session (biar aman)
        $request->session()->regenerate();

        // ✅ Ambil user login
        $user = Auth::user();

        // ❗ Tambahan pengaman (kalau role kosong)
        if (!$user || !$user->role) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun tidak memiliki role.'
            ]);
        }

        // ✅ Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login sebagai admin berhasil');
        }

        // default = user
        return redirect()->route('user.dashboard')
            ->with('success', 'Login berhasil');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}


