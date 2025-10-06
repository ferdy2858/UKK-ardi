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
    public function store(Request $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard.admin');
        } elseif ($user->hasRole('petugas')) {
            return redirect()->route('dashboard.petugas');
        } elseif ($user->hasRole('siswa')) {
            // langsung ke halaman khusus siswa (bukan dashboard)
            return redirect()->route('siswa.histori');
        }

        // fallback kalau tidak punya role
        return redirect()->route('dashboard');
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
