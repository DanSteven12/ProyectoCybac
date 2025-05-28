<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Service;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassesController extends Controller
{
    // Mostrar todas las clases
    public function index()
    {
        $classes = ClassModel::with(['service', 'instructor', 'status'])
            ->orderBy('date')
            ->orderBy('time')
            ->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    // Mostrar formulario para crear una clase
    public function create()
    {
        $services = Service::all();
        $instructors = User::role('instructor')->get(); // usando Spatie
        $statuses = Status::where('type', 1)->get(); // ✔️ Estados para clases

        return view('admin.classes.create', compact('services', 'instructors', 'statuses'));
    }

    // Guardar nueva clase
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'     => 'required|exists:services,id',
            'instructor_id'  => 'required|exists:users,id',
            'status_id'      => 'required|exists:statuses,id',
            'date'           => 'required|date|after_or_equal:today',
            'time'           => 'required',
            'description'    => 'required|string|max:500',
            'max_capacity'   => 'required|integer|min:1|max:30',
            'room'           => 'required|string|max:50',
        ]);

        ClassModel::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Clase creada exitosamente');
    }

    // Mostrar detalles de una clase
    public function show(ClassModel $class)
    {
        return view('admin.classes.show', compact('class'));
    }

    // Mostrar formulario para editar una clase
    public function edit(ClassModel $class)
    {
        $services = Service::all();
        $instructors = User::role('instructor')->get(); // usando Spatie
        $statuses = Status::where('type', 1)->get(); // ✔️ Estados para clases

        return view('admin.classes.edit', compact('class', 'services', 'instructors', 'statuses'));
    }

    // Actualizar clase
    public function update(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'service_id'     => 'required|exists:services,id',
            'instructor_id'  => 'required|exists:users,id',
            'status_id'      => 'required|exists:statuses,id',
            'date'           => 'required|date',
            'time'           => 'required',
            'description'    => 'required|string|max:500',
            'max_capacity'   => 'required|integer|min:1|max:30',
            'room'           => 'required|string|max:50',
        ]);

        $class->update($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Clase actualizada exitosamente');
    }

    // Eliminar clase
    public function destroy(ClassModel $class)
    {
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Clase eliminada exitosamente');
    }

    // Mostrar clases disponibles para usuarios
    public function availableClasses()
    {
        $services = Service::all();
        $classes = ClassModel::whereHas('status', function ($query) {
                $query->where('name', 'Activo')->where('type', 1);
            })
            ->where('date', '>=', Carbon::today())
            ->with(['service', 'instructor'])
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        return view('classes.available', compact('classes', 'services'));
    }
}
