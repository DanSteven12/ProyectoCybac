@extends('layouts.app-master')

@section('content')
<div class="container">
    <h2>Clases disponibles</h2>

    @foreach ($classes as $class)
        <div class="card my-3">
            <div class="card-body">
                <h5>{{ $class->service->name }} - {{ $class->description }}</h5>
                <p>Instructor: {{ $class->instructor->names }} {{ $class->instructor->last_name }}</p>
                <p>Fecha: {{ $class->date->format('d/m/Y') }} | Hora: {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}</p>
                <p>Cupos: {{ $class->registrations_count }} / {{ $class->max_capacity }}</p>

                @php
                    $isRegistered = $class->registrations->contains('user_id', auth()->id());
                @endphp

                @if ($isRegistered)
                    <form method="POST" action="{{ route('user.classes.cancel', $class->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Cancelar inscripción</button>
                    </form>
                @elseif ($class->registrations_count < $class->max_capacity)
                    <form method="POST" action="{{ route('user.classes.register', $class->id) }}">
                        @csrf
                        <button class="btn btn-primary">Reservar clase</button>
                    </form>
                @else
                    <p class="text-danger">Cupo lleno</p>
                @endif
            </div>
        </div>
    @endforeach

    {{-- Historial de reservas futuras --}}
    <h3 class="mt-5">Próximas clases reservadas</h3>
    @if ($upcomingRegistrations->isEmpty())
        <p>No tienes reservas próximas.</p>
    @else
        @foreach ($upcomingRegistrations as $registration)
            <div class="card my-2">
                <div class="card-body">
                    <h5>{{ $registration->class->service->name }} - {{ $registration->class->description }}</h5>
                    <p>Instructor: {{ $registration->class->instructor->names }} {{ $registration->class->instructor->last_name }}</p>
                    <p>Fecha: {{ $registration->class->date->format('d/m/Y') }} | Hora: {{ \Carbon\Carbon::parse($registration->class->time)->format('h:i A') }}</p>
                </div>
            </div>
        @endforeach
    @endif

</div>
@endsection