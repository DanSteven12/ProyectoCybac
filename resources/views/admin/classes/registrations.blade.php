@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid py-4">
    @if($class->status && strtolower($class->status->name) === 'cancelada' && !empty($class->comment))
        <div class="alert alert-secondary border-start border-4 border-danger mb-4 shadow-sm" style="background-color: #FFD166; border-left: 5px solid #FF6B35 !important;">
            <h5 class="mb-2 text-danger fw-bold" style="color: #1A365D !important; font-size: 1.4rem;">
                <i class="fas fa-exclamation-circle me-1"></i> Motivo de cancelación
            </h5>
            <p class="mb-0 text-muted" style="color: #1A365D; font-size: 1.3rem;">{{ $class->comment }}</p>
        </div>
    @endif

<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="fw-bold" style="color: #1A365D; font-size: 2rem;">
            Inscripciones para la clase:
            <span class="text-primary" style="color: #FF6B35 !important;">
                {{ $class->service?->name ?? 'Servicio no disponible' }}
            </span>
            <small class="text-muted d-block mt-1" style="color: #1A365D !important; font-size: 1.4rem;">
                {{ \Carbon\Carbon::parse($class->date)->format('d/m/Y') }} -
                {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}
            </small>
        </h2>
    </div>

    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <ul class="list-group" style="border: 2px solid #1A365D; border-radius: 8px;">
                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #F4F4F4; font-size: 1.3rem;">
                    <strong style="color: #1A365D;">Cupo máximo:</strong>
                    <span style="color: #FF6B35; font-weight: 600;">{{ $class->max_capacity ?? 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #F4F4F4; font-size: 1.3rem;">
                    <strong style="color: #1A365D;">Inscritos:</strong>
                    <span style="color: #FF6B35; font-weight: 600;">{{ $inscritos->count() }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #F4F4F4; font-size: 1.3rem;">
                    <strong style="color: #1A365D;">Cupos disponibles:</strong>
                    <span style="color: #FF6B35; font-weight: 600;">{{ $faltantes }}</span>
                </li>
            </ul>
        </div>

        <div class="col-md-4">
            <p style="color: #1A365D; font-size: 1.4rem; font-weight: 600;"><strong>Estado:</strong></p>
            @if($class->status)
                @php $statusName = strtolower($class->status->name); @endphp
                @php
                    $badgeColor = match ($statusName) {
                        'disponible' => '#2EC4B6',
                        'cupo lleno' => '#FF6B35',
                        'cancelada' => '#FFD166',
                        default => '#A9A9A9',
                    };
                @endphp
                <span class="badge" style="background-color: {{ $badgeColor }}; color: #FFFFFF; font-size: 1.3rem; padding: 0.5em 0.8em;">
                    {{ $class->status->name }}
                </span>
            @else
                <span class="badge" style="background-color: #A9A9A9; color: #FFFFFF; font-size: 1.3rem; padding: 0.5em 0.8em;">
                    Estado desconocido
                </span>
            @endif
        </div>
    </div>

    <div class="card mb-5" style="border: 2px solid #1A365D; border-radius: 8px;">
        <div class="card-header" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
            <h5 class="mb-0" style="font-size: 1.8rem;">Actualizar estado de la clase</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.classes.update', $class->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <input type="hidden" name="from" value="registrations">

                <div class="col-md-6">
                    <label for="status_id" class="form-label" style="color: #1A365D; font-size: 1.4rem; font-weight: 600;">
                        Estado de la clase <span class="text-danger">*</span>
                    </label>
                    <select name="status_id" id="status_id" class="form-select @error('status_id') is-invalid @enderror" required style="border: 2px solid #1A365D; font-size: 1.3rem;">
                        @foreach ($classStatuses as $status)
                            <option value="{{ $status->id }}" {{ $class->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="invalid-feedback" style="font-size: 1.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="comment" class="form-label" style="color: #1A365D; font-size: 1.4rem; font-weight: 600;">
                        Comentario (Obligatorio)
                    </label>
                    <textarea
                        name="comment"
                        id="comment"
                        rows="3"
                        class="form-control @error('comment') is-invalid @enderror"
                        placeholder="Añade un comentario sobre la cancelación o el estado"
                        style="border: 2px solid #1A365D; font-size: 1.3rem;">{{ old('comment', $class->comment) }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback" style="font-size: 1.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn" style="background-color: #FF6B35; color: #FFFFFF; font-size: 1.3rem; font-weight: 600;">
                        <i class="fas fa-save me-1"></i> Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div>
        <h4 class="mb-3" style="color: #1A365D; font-size: 1.8rem;">Lista de inscritos</h4>

        @if($inscritos->isEmpty())
            <p class="text-muted fst-italic" style="color: #1A365D; font-size: 1.5rem;">No hay usuarios inscritos en esta clase.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" style="border: 2px solid #1A365D;">
                    <thead class="table-dark" style="background-color: #1A365D; color: #FFFFFF;">
                        <tr>
                            <th scope="col" style="width: 50px; font-size: 1.4rem;">#</th>
                            <th scope="col" style="font-size: 1.4rem;">Nombre completo</th>
                            <th scope="col" style="font-size: 1.4rem;">Correo electrónico</th>
                            <th scope="col" style="width: 180px; font-size: 1.4rem;">Fecha de inscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inscritos as $index => $registration)
                            <tr style="border-bottom: 2px solid #F4F4F4;">
                                <td style="font-size: 1.3rem;">{{ $index + 1 }}</td>
                                <td style="font-size: 1.3rem;">
                                    {{ $registration->user?->names ?? 'Nombre no disponible' }}
                                    {{ $registration->user?->last_name ?? '' }}
                                </td>
                                <td>{{ $registration->user?->email ?? 'Correo no disponible' }}</td>
                                <td>{{ \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y') }}</td>
                                <td style="font-size: 1.3rem;">{{ $registration->user?->email ?? 'Correo no disponible' }}</td>
                                <td style="font-size: 1.3rem;">{{ \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.classes.index') }}" class="btn" style="background-color: #1A365D; color: #FFFFFF; font-size: 1.4rem; font-weight: 600;">
            <i class="fas fa-arrow-left me-1"></i> Volver a clases
        </a>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .table th {
        padding: 14px 12px;
        text-transform: uppercase;
    }
    
    .table td {
        padding: 12px 10px;
        vertical-align: middle;
    }
    
    .btn {
        padding: 0.6rem 1rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(46, 196, 182, 0.08);
    }
    
    .alert {
        border-radius: 6px;
        padding: 12px 16px;
    }
    
    body {
        font-size: 1.15rem;
    }

    .badge {
        padding: 0.5em 0.9em;
        font-size: 1.1rem;
    }

    @media (max-width: 992px) {
        .table-responsive {
            overflow-x: auto;
        }

        .table th, .table td {
            font-size: 1.1rem !important;
            padding: 10px 8px !important;
        }

        .btn {
            padding: 0.5rem 0.9rem !important;
            font-size: 1.1rem !important;
        }

        .card-header h5 {
            font-size: 1.3rem !important;
        }

        .card-header .btn {
            font-size: 1.1rem !important;
            padding: 0.4rem 0.9rem !important;
        }
    }
</style>
@endsection