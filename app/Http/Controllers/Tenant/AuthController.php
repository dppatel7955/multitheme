<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the tenant login form.
     */
    public function showLoginForm()
    {
        // If already logged in on this tenant
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        
        return view('tenant.auth.login');
    }

    /**
     * Handle tenant login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt authentication. 
        // Stancl\Tenancy single-database BelongsToTenant automatically scopes this attempt to the current tenant!
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you do not have an account in this organization.',
        ])->onlyInput('email');
    }

    /**
     * Handle tenant logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
