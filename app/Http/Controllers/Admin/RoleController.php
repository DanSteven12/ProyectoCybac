<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin')->except(['index']);
    }

    public function index()
{
    $roles = Role::all();
    return view('admin.roles.index', compact('roles'));
}

    public function create()
    {
        Gate::authorize('admin'); 
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:roles',
            'guard_name' => 'required|max:50'
        ]);

        Role::create($request->only('name', 'guard_name'));

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente');
    }


    public function edit(Role $role)
    {
    Gate::authorize('admin');
    return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:50|unique:roles,name,' . $role->id,
            'guard_name' => 'required|max:50'
        ]);

        // Evita actualizar el rol de admin por seguridad
        if ($role->slug === 'admin') {
            return redirect()->back()->with('error', 'No se puede modificar el rol de administrador');
        }

        $role->update($request->only('name', 'guard_name'));

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
    }

    public function destroy(Role $role)
    {
        try {
            // Protege el rol admin de ser eliminado
            if ($role->slug === 'admin') {
                return redirect()->back()->with('error', 'No se puede eliminar el rol de administrador');
            }

            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
