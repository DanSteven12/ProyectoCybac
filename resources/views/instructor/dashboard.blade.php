@extends('layouts.instructor-app-master')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
:root {
    --primary-dark: #1A365D;
    --primary-light: #2EC4B6;
    --accent-yellow: #FFD166;
    --accent-orange: #FF6B35;
    --accent-red: #d82c0d;
    --white: #FFFFFF;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
}

.registrations-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
    width: 95%;
}

.registrations-header {
    text-align: center;
    margin-bottom: 3rem;
}

.registrations-title {
    font-size: clamp(1.4rem, 4vw, 1.8rem);
    color: var(--primary-dark);
    margin-bottom: 1rem;
    font-weight: 700;
}

.registrations-subtitle {
    font-size: clamp(1.2rem, 3vw, 1.6rem);
    color: var(--primary-dark);
    opacity: 0.8;
}

.registrations-card {
    background-color: var(--white);
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    padding: clamp(1rem, 3vw, 2rem);
    margin-bottom: 2rem;
    border: 4px solid var(--primary-dark);
}

.alert {
    padding: 1rem;
    margin-bottom: 1.5rem;
    border-radius: 6px;
    font-size: clamp(1.1rem, 3vw, 1.3rem);
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.alert-success {
    background-color: var(--primary-light);
    color: var(--white);
    border: 1px solid var(--primary-dark);
}

.alert-danger {
    background-color: var(--accent-orange);
    color: var(--white);
    border: 1px solid var(--primary-dark);
}

.registrations-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1.5rem;
    border: 1px solid #000;
}

.registrations-table thead {
    background-color: var(--primary-dark);
    color: var(--white);
}

.registrations-table th, 
.registrations-table td {
    padding: clamp(0.6rem, 2vw, 1.2rem);
    text-align: left;
    font-size: clamp(1rem, 3vw, 1.3rem);
    border: 1px solid #000;
}

.registrations-table th {
    font-weight: 600;
    border-bottom: 2px solid #000;
}

.registrations-table tbody tr:hover {
    background-color: rgba(26, 54, 93, 0.05);
}

.empty-message {
    font-size: clamp(1.2rem, 3vw, 1.4rem);
    color: var(--primary-dark);
    text-align: center;
    padding: 2rem;
}

.divider {
    height: 1px;
    background-color: var(--primary-dark);
    margin: 2rem 0;
    opacity: 0.2;
}

/* Estilos responsivos para la tabla en móviles */
@media (max-width: 768px) {
    .registrations-table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    
    .registrations-table thead {
        display: none;
    }
    
    .registrations-table tbody, 
    .registrations-table tr, 
    .registrations-table td {
        display: block;
        width: 100%;
    }
    
    .registrations-table tr {
        margin-bottom: 1rem;
        border: 2px solid var(--primary-dark);
    }
    
    .registrations-table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
        white-space: normal;
    }
    
    .registrations-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 1rem;
        width: 45%;
        padding-right: 1rem;
        font-weight: bold;
        text-align: left;
        color: var(--primary-dark);
    }
}

/* Mejoras para móviles muy pequeños */
@media (max-width: 480px) {
    .registrations-container {
        padding: 1rem 0.5rem;
    }
    
    .registrations-header {
        margin-bottom: 1.5rem;
    }
    
    .registrations-card {
        padding: 1rem;
    }
    
    .alert {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .empty-message {
        padding: 1rem;
    }
}
</style>

<div class="registrations-container">
    <div class="registrations-header">
        <i class="fas fa-chalkboard-teacher fa-4x mb-3" style="color: var(--primary-dark); font-size: clamp(2rem, 10vw, 4rem);"></i>
        <h1 class="registrations-title">Mis registros de clases como instructor</h1>
        <p class="registrations-subtitle">Alumnos registrados en tus clases programadas</p>
    </div>

    <div class="registrations-card">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if($registrations->isEmpty())
            <p class="empty-message">
                <i class="fas fa-user-slash" style="margin-right: 0.9rem;"></i>
                No hay alumnos registrados en tus clases.
            </p>
        @else
            <table class="registrations-table">
                <thead>
                    <tr>
                        <th data-label="Alumno"><i class="fas fa-user"></i> Alumno</th>
                        <th data-label="Servicio"><i class="fas fa-dumbbell"></i> Servicio</th>
                        <th data-label="Fecha"><i class="far fa-calendar-alt"></i> Fecha</th>
                        <th data-label="Hora"><i class="far fa-clock"></i> Hora</th>
                        <th data-label="Descripción"><i class="fas fa-align-left"></i> Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $registration)
                        <tr>
                            <td data-label="Alumno">{{ $registration->user->names }} {{ $registration->user->last_name }}</td>
                            <td data-label="Servicio">{{ $registration->class->service->name }}</td>
                            <td data-label="Fecha">{{ $registration->class->date->translatedFormat('d \d\e F \d\e Y') }}</td>
                            <td data-label="Hora">{{ \Carbon\Carbon::parse($registration->class->time)->format('h:i A') }}</td>
                            <td data-label="Descripción">{{ $registration->class->description }}</td>
                            {{-- {{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d \d\e F \d\e Y') }} --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="divider"></div>
    </div>
</div>
@endsection