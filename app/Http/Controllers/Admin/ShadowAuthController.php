<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShadowAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.financial.index');
            }
            return redirect()->route('admin.dashboard.index');
        }
        return view('admin.shadow_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.financial.index'));
            }
            return redirect()->intended(route('admin.dashboard.index'));
        }

        return back()->withErrors([
            'username' => 'Identitas tersebut tidak cocok dengan data kami.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
