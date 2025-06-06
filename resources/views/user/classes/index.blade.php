@extends('layouts.app-master')

@section('content')
<div class="container">

@if($comments->count())
    <div class="grid grid-cols-1 gap-4 mb-6">
        @foreach($comments as $class)
            <div class="bg-white border-l-4 border-red-500 shadow-md p-4 rounded-lg">
                <h2 class="text-lg font-semibold text-red-600 mb-2">Motivo de cancelación de la clase</h2>
                <p class="text-sm text-gray-700">
                    <span class="font-medium text-gray-800">Clase:</span> {{ $class->service->name }}<br>
                    <span class="font-medium text-gray-800">Fecha:</span> {{ \Carbon\Carbon::parse($class->date)->format('d/m/Y') }}<br>
                    <span class="font-medium text-gray-800">Motivo:</span> {{ $class->comment }}
                </p>
            </div>
        @endforeach
    </div>
@endif



    <h2>Clases disponibles</h2>

    @foreach ($classes as $class)
        <div class="card my-3">
            <div class="card-body">
                <h5>{{ $class->service->name }} - {{ $class->description }}</h5>
                <p><strong>Requisitos:</strong></p>
                <ul>
                    @foreach ($class->service->requirements as $requirement)
                        <li>{{ $requirement->name }}</li>
                    @endforeach
                </ul>
                <p>Instructor: {{ $class->instructor->names }} {{ $class->instructor->last_name }}</p>
                <p>Fecha: {{ $class->date->format('d/m/Y') }} | Hora: {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}</p>
                <p>Cupos: {{ $class->registrations_count }} / {{ $class->max_capacity }}</p>

                @php
                    $isRegistered = $class->registrations->contains('user_id', auth()->id());
                @endphp

                @if ($isRegistered)
                    <!-- Botón para abrir el modal -->
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $class->id }}">
                        Cancelar inscripción
                    </button>

                    <!-- Modal de cancelación -->
                    <div class="modal fade" id="cancelModal{{ $class->id }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $class->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('user.classes.cancel', $class->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel{{ $class->id }}">Cancelar inscripción</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Por favor, indica el motivo de la cancelación:</p>
                                        <textarea name="reason" class="form-control" rows="3" required placeholder="Motivo..."></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Confirmar cancelación</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                    <p><strong>Requisitos:</strong></p>
                    <ul>
                        @foreach ($registration->class->service->requirements as $requirement)
                            <li>{{ $requirement->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif

</div>
@endsection
