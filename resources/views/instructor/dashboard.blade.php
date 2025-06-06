@extends('layouts.instructor-app-master')

@section('content')
<div class="container">
    <h2>Mis registros de clases como instructor</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($registrations->isEmpty())
        <p>No hay alumnos registrados en tus clases.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Servicio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $registration->user->names }} {{ $registration->user->last_name }}</td>
                        <td>{{ $registration->class->service->name }}</td>
                        <td>{{ $registration->class->date->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($registration->class->time)->format('h:i A') }}</td>
                        <td>{{ $registration->class->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <hr>
</div>
@endsection
