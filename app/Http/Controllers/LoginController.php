<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return $this->authenticatedRedirect();
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }

    protected function authenticatedRedirect()
{
    $user = Auth::user();

    if (!$user->roles || $user->roles->isEmpty()) {
        Auth::logout();
        return redirect()->route('login')->withErrors(['error' => 'Tu cuenta no tiene un rol asignado']);
    }

    if ($user->hasRole(Role::ADMIN)) {
        return redirect()->intended(route('admin.dashboard'));
    }

    if ($user->hasRole(Role::INSTRUCTOR)) {
        return redirect()->intended(route('instructor.dashboard'));
    }

    if ($user->hasRole(Role::USUARIO)) {
        return redirect()->intended(route('user.dashboard'));
    }

    // Por si no tiene ninguno de esos roles:
    return redirect()->intended('/');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
