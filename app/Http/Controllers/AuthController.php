<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user->role) {
            abort(403, 'User tidak punya role');
        }

        $role = strtolower(trim($user->role->nama));

        if ($role === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        if ($role === 'customer') {
            return redirect()->route('dashboard.customer');
        }

        abort(403, 'Role tidak dikenal: ' . $user->role->nama);
    }

    return back()->withErrors([
        'username' => 'Username atau password salah',
    ]);
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
