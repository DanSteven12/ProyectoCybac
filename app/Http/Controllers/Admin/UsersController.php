<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('user.dashboard');
    }

    public function index()
    {
        $users = User::with(['role', 'status'])->paginate(10);
        $currentDate = now()->format('d/m/Y');
        $totalUsers = User::count();

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
            'rol_id' => 'required|integer|exists:roles,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'specialty' => 'nullable|string|max:255',
            'certification' => 'nullable|string',
        ]);

        User::create([
            'names' => $request->names,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
            'status_id' => $request->status_id,
            'specialty' => $request->specialty,
            'certification' => $request->certification,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $user)
    {
        $user->load(['role', 'status']);
        $edad = Carbon::parse($user->birth_date)->age;

        return view('admin.users.show', compact('user', 'edad'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $statuses = Status::all();
        $user->load(['role', 'status']);

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
            'rol_id' => 'required|integer|exists:roles,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'specialty' => 'nullable|string|max:255',
            'certification' => 'nullable|string',
        ]);

        $data = $request->only([
            'names', 'last_name', 'birth_date', 'gender', 'email',
            'rol_id', 'status_id', 'specialty', 'certification'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
{
    // Verificar si el usuario tiene pagos relacionados
    if ($user->payments()->exists()) {
        return redirect()->route('admin.users.index')
            ->with('error', 'No se puede eliminar el usuario porque tiene pagos registrados.');
    }

    // Si no tiene pagos, se elimina con seguridad
    $user->delete();

    return redirect()->route('admin.users.index')
        ->with('success', 'Usuario eliminado exitosamente.');
}

}
