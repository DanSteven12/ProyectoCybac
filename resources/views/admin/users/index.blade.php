@extends('layouts.admi-app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0 d-flex justify-content-between align-items-center">
                        Listado de Usuarios
                        <a href="{{ route('admin.users.create') }}" class="btn btn-light fw-bold">
                            <i class="bi bi-plus-circle me-2"></i>NUEVO USUARIO
                        </a>
                    </h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Género</th>
                                    <th>Especialidad</th>
                                    <th>Certificación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                    <td>{{ $user->names }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->getRoleNames()->first() ?? 'N/A' }}</td>
                                    <td>{{ $user->statuses->name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->specialty ?? 'N/A' }}</td>
                                    <td>{{ $user->certification ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('¿Eliminar usuario?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-people-x fs-1"></i>
                                            <p class="mt-2">No hay usuarios registrados</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($users->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .table th {
        background: #2c3e50;
        color: white;
        vertical-align: middle;
        white-space: nowrap;
        font-size: 1.6rem; /* Tamaño aumentado para encabezados */
        padding: 1.3rem 0.9rem; /* Más padding vertical */
        text-align: center;
        vertical-align: middle;
    }
    
    
    .table td {
        font-size: 1.5rem; /* Texto más grande en celdas */
        padding: 1.2rem 0.9rem; /* Más espacio en celdas */
        text-align: center;
    }
    
    .btn-group .btn {
        transition: all 0.2s ease;
        margin: 0 3px; /* Más separación entre botones */
        font-size: 1.25rem; /* Íconos más grandes */
        padding: 0.7rem 1rem; /* Botones más grandes */
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Ajustes para móviles */
    @media (max-width: 768px) {
        .table th {
            font-size: 1rem;
            padding: 1rem 0.5rem;
        }
        
        .table td {
            font-size: 0.95rem;
            padding: 0.8rem 0.5rem;
        }
        
        .btn-group .btn {
            font-size: 1rem;
            padding: 0.4rem 0.6rem;
        }
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.03);
    }

    .main-wrapper {
    margin-top: 80px; /* Ajusta según la altura de tu navbar */
    padding: 20px 0;
}

/* Para dispositivos móviles */
@media (max-width: 768px) {
    .main-wrapper {
        margin-top: 60px;
        padding: 15px 0;
    }
}
</style>
@endsection