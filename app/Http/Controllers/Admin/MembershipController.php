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
        $memberships = Membership::with('latestPayment')->get();
        return view('admin.memberships.index', compact('memberships'));
    }

    public function create()
    {
        // Filtrar solo los estados de tipo 1 (para membresías)
        $statuses = Status::where('type', 1)->get();
        return view('admin.memberships.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'status_id' => 'required|exists:statuses,id',
            'price' => 'required|numeric|min:0',
        ]);

        Membership::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'status_id' => $request->status_id,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.memberships.index')->with('success', 'Membresía creada correctamente.');
    }

    public function edit(Membership $membership)
    {
        $statuses = Status::where('type', 1)->get();
        return view('admin.memberships.edit', compact('membership', 'statuses'));
    }

    public function update(Request $request, Membership $membership)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'status_id' => 'required|exists:statuses,id',
            'price' => 'required|numeric|min:0',
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
