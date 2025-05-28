<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Status;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        return view('admin.memberships.index', compact('memberships'));
    }

    public function create()
    {
        $statuses = Status::all(); // Para elegir estado en el formulario
        return view('admin.memberships.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        // Validar datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1', // duración en días
            'status_id' => 'required|exists:statuses,id',
        ]);

        Membership::create($validated);

        return redirect()->route('admin.memberships.index')->with('success', 'Membresía creada correctamente.');
    }

    public function edit(Membership $membership)
    {
        $statuses = Status::all();
        return view('admin.memberships.edit', compact('membership', 'statuses'));
    }

    public function update(Request $request, Membership $membership)
    {
        // Validar datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'status_id' => 'required|exists:statuses,id',
        ]);

        $membership->update($validated);

        return redirect()->route('admin.memberships.index')->with('success', 'Membresía actualizada correctamente.');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('admin.memberships.index')->with('success', 'Membresía eliminada correctamente.');
    }
}

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\Membership;
// use Illuminate\Http\Request;
// use Carbon\Carbon;

// class MembershipController extends Controller
// {
//     public function index()
//     {
//         $memberships = Membership::all();
//         return view('admin.memberships.index', compact('memberships'));
//     }

//     public function create()
//     {
//         return view('admin.memberships.create');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'price' => 'required|numeric',
//             'start_date' => 'required|date',
//             // Si quieres dejar que el admin escriba end_date
//             'end_date' => 'required|date|after:start_date',
//         ]);

//         Membership::create($request->all());

//         return redirect()->route('admin.memberships.index')
//             ->with('success', 'Membresía creada correctamente.');
//     }

//     public function edit(Membership $membership)
//     {
//         return view('admin.memberships.edit', compact('membership'));
//     }

//     public function update(Request $request, Membership $membership)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'price' => 'required|numeric',
//             'start_date' => 'required|date',
//             'end_date' => 'required|date|after:start_date',
//         ]);

//         $membership->update($request->all());

//         return redirect()->route('admin.memberships.index')
//             ->with('success', 'Membresía actualizada correctamente.');
//     }

//     // Opcional: eliminar membresía
//     public function destroy(Membership $membership)
//     {
//         $membership->delete();
//         return redirect()->route('admin.memberships.index')
//             ->with('success', 'Membresía eliminada correctamente.');
//     }
// }
