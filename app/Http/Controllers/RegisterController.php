<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'names' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ✅ Obtener el rol por defecto desde la tabla roles
        $defaultRole = Role::where('name', Role::USUARIO)->firstOrFail();

        // ✅ Crear el usuario
        $user = User::create([
            'names' => $request->names,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_id' => 1, // o el status que desees por defecto
        ]);

        // ✅ Asignar el rol usando Spatie
        $user->assignRole($defaultRole->name);

        // Registrar evento de usuario registrado
        event(new Registered($user));

        // Autenticar al usuario
        Auth::login($user);

        // Redirigir a su panel correspondiente según el rol
        return match (true) {
            $user->hasRole(Role::ADMIN) => redirect()->intended('/admin/index'),
            $user->hasRole(Role::INSTRUCTOR) => redirect()->intended('/instructor/index'),
            $user->hasRole(Role::INSTRUCTOR) => redirect()->intended('/users/index'),
            default => redirect()->intended('login'),
        };
    }
}
