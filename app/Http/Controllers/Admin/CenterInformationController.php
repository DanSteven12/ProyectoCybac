<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CenterInformation;

class CenterInformationController extends Controller
{
    public function index()
    {
        $info = CenterInformation::first();
        return view('admin.center-information.index', compact('info'));
    }

    public function create()
    {
        return view('admin.center-information.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        CenterInformation::create($request->all());

        return redirect()->route('admin.center-information.index')->with('success', 'Información creada correctamente.');
    }

    public function edit($id)
    {
        $centerInformation = CenterInformation::findOrFail($id);
        return view('admin.center-information.edit', compact('centerInformation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'schedule' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        $centerInformation = CenterInformation::findOrFail($id);
        $centerInformation->update($request->all());

        return redirect()->route('admin.center-information.index')->with('success', 'Información actualizada correctamente.');
    }
}