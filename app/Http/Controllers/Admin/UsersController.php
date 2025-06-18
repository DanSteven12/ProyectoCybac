<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  // <--- Aquí importas el controlador base
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function dashboard()
    {
        // Tu lógica para mostrar el dashboard admin
        return view('user.dashboard');
    }
    
    public function index()
{
    $users = User::paginate(10);
    $currentDate = now()->format('d/m/Y'); // Formato DD/MM/YYYY
    $totalUsers = User::count(); // Total de usuarios registrados
    
    return view('admin.users.index', compact('users', 'currentDate', 'totalUsers'));
}


    public function create()
    {
        $roles = Role::all();
        $statuses = Status::all();
    
        return view('admin.users.create', compact('roles', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'names' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:Masculino,Femenino,Otro',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name',  // Validar por nombre del rol
            'status_id' => 'required|integer|exists:statuses,id',
            'specialty' => 'nullable|string|max:255',
            'certification' => 'nullable|string',
        ]);

        $user = User::create([
            'names' => $request->names,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_id' => $request->status_id,
            'specialty' => $request->specialty,
            'certification' => $request->certification,
        ]);

        // Asignar rol usando Spatie
        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')
                        ->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $user)
    {
        $user->load(['roles', 'status']);
        $edad = Carbon::parse($user->birth_date)->age;
        
        return view('admin.users.show', compact('user', 'edad'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $statuses = Status::all();
        $user->load(['roles', 'status']);
    
        return view('admin.users.edit', compact('user', 'roles', 'statuses'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'names' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:Masculino,Femenino,Otro',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name',
            'status_id' => 'required|integer|exists:statuses,id',
            'specialty' => 'nullable|string|max:255',
            'certification' => 'nullable|string',
        ]);

        $data = $request->except('password', 'role');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Actualizar roles (quita todos y pone el nuevo)
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->route('admin.users.index')
                        ->with('success', 'Usuario eliminado exitosamente.');
    }

    public function adminUsers()
{
    $adminRole = Role::where('name', 'admin')->first();
    $usuariosAdmin = $adminRole->users;

    return view('users.admins', compact('usuariosAdmin'));
}
}
