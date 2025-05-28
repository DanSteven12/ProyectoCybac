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
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Servicio</th>
                                    <th>Instructor</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Capacidad maxima</th>
                                    <th>Salon</th>
                                    <th>Descrpcion</th>
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
                                         <td>{{ $class->description }}</td>
                                         <td>{{ $class->max_capacity }}</td>
                                        <td>{{ $class->room }}</td>
                                        <td>
                                            <span class="badge bg-{{ $class->status_id == 1 ? 'success' : 'danger' }}">
                                                {{ $class->status->name }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.classes.edit', $class->id) }}" 
                                               class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.classes.destroy', $class->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Eliminar esta clase?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
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