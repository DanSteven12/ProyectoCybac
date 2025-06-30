<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesHomeController extends Controller
{
    public function index()
    {
        $services = ServicesHome::all();
        return view('admin.services_home.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services_home.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data['image_url'] = $request->file('image_url')->store('services', 'public');

    ServicesHome::create($data);

    return redirect()->route('admin.services_home.index')->with('success', 'Servicio creado correctamente');
}

    public function edit($id)
    {
        $service = ServicesHome::findOrFail($id);
        return view('admin.services_home.edit', compact('service'));
    }

    public function update(Request $request, $id)
{
    $service = ServicesHome::findOrFail($id);

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image_url' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image_url')) {
        // Eliminar imagen anterior
        if ($service->image_url) {
            Storage::disk('public')->delete($service->image_url);
        }
        // Guardar nueva imagen
        $data['image_url'] = $request->file('image_url')->store('services', 'public');
    } else {
        // Mantener la imagen existente si no se sube una nueva
        $data['image_url'] = $service->image_url;
    }

    $service->update($data);

    return redirect()->route('admin.services_home.index')->with('success', 'Servicio actualizado correctamente');
}

    public function destroy($id)
    {
        $service = ServicesHome::findOrFail($id);
        if ($service->image_url) {
            Storage::disk('public')->delete($service->image_url);
        }
        $service->delete();

        return redirect()->route('admin.services_home.index')->with('success', 'Service deleted');
    }
}