<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Registration;
use App\Models\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    
public function index()
{
    $disponibleStatusId = Status::where('type', 3)
        ->where('name', 'Disponible')
        ->value('id');

    $classes = $disponibleStatusId
        ? Classes::withCount('registrations')
            ->with(['service', 'instructor', 'registrations'])
            ->where('status_id', $disponibleStatusId)
            ->where('date', '>=', now()->startOfDay())
            ->orderBy('date')
            ->orderBy('time')
            ->get()
        : collect();

    $userId = auth()->id();

    $upcomingRegistrations = Registration::with('class.service', 'class.instructor')
        ->where('user_id', $userId)
        ->whereHas('class', function ($query) {
            $query->where('date', '>=', now()->startOfDay());
        })
        ->get();

    return view('user.classes.index', compact('classes', 'upcomingRegistrations'));
}

public function reserve($classId)
{
    $user = auth()->user();
    $class = Classes::findOrFail($classId);

    if ($class->registrations()->where('user_id', $user->id)->exists()) {
        return back()->with('error', 'Ya estás registrado en esta clase.');
    }

    if ($class->registrations()->count() >= $class->max_capacity) {
        return back()->with('error', 'No hay cupos disponibles.');
    }

    $conflict = $user->registrations()
        ->whereHas('class', function ($query) use ($class) {
            $query->where('date', $class->date)->where('time', $class->time);
        })->exists();

    if ($conflict) {
        return back()->with('error', 'Ya tienes una clase en ese horario.');
    }

    Registration::create([
        'user_id' => $user->id,
        'class_id' => $class->id
    ]);

    return back()->with('success', 'Clase reservada con éxito.');
}

public function cancelReservation($classId)
{
    $user = auth()->user();
    $registration = Registration::where('user_id', $user->id)
        ->where('class_id', $classId)
        ->first();

    if (!$registration) {
        return back()->with('error', 'No estás registrado en esta clase.');
    }

    $class = $registration->class;
    $fechaHoraClase = Carbon::parse("{$class->date} {$class->time}");

    if (now()->greaterThan($fechaHoraClase->copy()->subHours(2))) {
        return back()->with('error', 'Ya no puedes cancelar esta clase con menos de 2 horas de anticipación.');
    }

    $registration->delete();
    return back()->with('success', 'Inscripción cancelada correctamente.');
  }

}

