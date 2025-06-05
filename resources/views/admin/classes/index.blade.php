@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Gestión de Clases</h3>
                    <a href="{{ route('admin.classes.create') }}" class="btn btn-light">
                        <i class="fas fa-plus me-2"></i>Nueva Clase
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Servicio</th>
                                    <th>Instructor</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Capacidad</th>
                                    <th>Inscritos</th>
                                    <th>Salón</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classes as $class)
                                    <tr>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->service->name }}</td>
                                        <td>{{ $class->instructor->names }} {{ $class->instructor->last_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($class->date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}</td>
                                        <td>{{ $class->max_capacity }}</td>
                                        <td>{{ $class->registrations->count() }} / {{ $class->max_capacity }}</td>
                                        <td>{{ $class->room }}</td>
                                        <td>{{ $class->description }}</td>
                                         <td>
                                            <span class="badge bg-{{ $class->status_id == 3 ? 'success' : 'success' }}">
                                                {{ $class->status->name }}
                                            </span>
                                        </td>
                                        <td class="d-flex gap-1">
                                            <a href="{{ route('admin.classes.edit', $class->id) }}" 
                                               class="btn btn-sm btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.classes.destroy', $class->id) }}" 
                                                  method="POST" onsubmit="return confirm('¿Eliminar esta clase?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                            <a href="{{ route('admin.classes.registrations', $class->id) }}"
                                               class="btn btn-sm btn-info" title="Ver inscritos">
                                                <i class="fas fa-users"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted py-4">
                                            No hay clases registradas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $classes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
