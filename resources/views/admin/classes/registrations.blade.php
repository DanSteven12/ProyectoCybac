@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid py-4">
    @if($class->status && strtolower($class->status->name) === 'cancelada' && !empty($class->comment))
        <div class="alert alert-secondary border-start border-4 border-danger mb-4 shadow-sm">
            <h5 class="mb-2 text-danger fw-bold">
                <i class="bi bi-x-circle-fill me-1"></i> Motivo de cancelación
            </h5>
            <p class="mb-0 text-muted">{{ $class->comment }}</p>
        </div>
    @endif

<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="fw-bold">
            Inscripciones para la clase:
            <span class="text-primary">
                {{ $class->service?->name ?? 'Servicio no disponible' }}
            </span>
            <small class="text-muted d-block mt-1">
                {{ \Carbon\Carbon::parse($class->date)->format('d/m/Y') }} -
                {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}
            </small>
        </h2>
    </div>

    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Cupo máximo:</strong>
                    <span>{{ $class->max_capacity ?? 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Inscritos:</strong>
                    <span>{{ $inscritos->count() }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Cupos disponibles:</strong>
                    <span>{{ $faltantes }}</span>
                </li>
            </ul>
        </div>

        <div class="col-md-4">
            <p><strong>Estado:</strong></p>
            @if($class->status)
                @php $statusName = strtolower($class->status->name); @endphp
                @php
                    $badgeClass = match ($statusName) {
                        'disponible' => 'bg-success',
                        'cupo lleno' => 'bg-danger',
                        'cancelada' => 'bg-secondary',
                        default => 'bg-warning text-dark',
                    };
                @endphp
                <span class="badge {{ $badgeClass }}">{{ $class->status->name }}</span>
            @else
                <span class="badge bg-warning text-dark">Estado desconocido</span>
            @endif
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header">
            <h5 class="mb-0">Actualizar estado de la clase</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.classes.update', $class->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <!-- Campo oculto para detectar origen y quedarnos en esta vista -->
                <input type="hidden" name="from" value="registrations">

                <div class="col-md-6">
                    <label for="status_id" class="form-label">Estado de la clase <span class="text-danger">*</span></label>
                    <select name="status_id" id="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                        @foreach ($classStatuses as $status)
                            <option value="{{ $status->id }}" {{ $class->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="comment" class="form-label">Comentario (Obligatorio)</label>
                    <textarea
                        name="comment"
                        id="comment"
                        rows="3"
                        class="form-control @error('comment') is-invalid @enderror"
                        placeholder="Añade un comentario sobre la cancelación o el estado">{{ old('comment', $class->comment) }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div>
        <h4 class="mb-3">Lista de inscritos</h4>

        @if($inscritos->isEmpty())
            <p class="text-muted fst-italic">No hay usuarios inscritos en esta clase.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 50px;">#</th>
                            <th scope="col">Nombre completo</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col" style="width: 180px;">Fecha de inscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inscritos as $index => $registration)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ $registration->user?->names ?? 'Nombre no disponible' }}
                                    {{ $registration->user?->last_name ?? '' }}
                                </td>
                                <td>{{ $registration->user?->email ?? 'Correo no disponible' }}</td>
                                <td>{{ \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Volver a clases
        </a>
    </div>
</div>
@endsection
