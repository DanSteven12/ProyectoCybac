@extends('layouts.admi-app-master')

@section('content')
<style>
    /* Estilos profesionales mejorados */
    .card {
        border: none;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
    }
    
    /* Estilo mejorado para el encabezado */
    .card-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }
    
    .card-header h3 {
        font-weight: 700;
        letter-spacing: 0.8px;
        margin: 0;
        font-size: 1.5rem;
    }
    
    /* Botón de creación mejorado */
    .btn-create {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        background-color: white;
        color: #3a7bd5;
        border: 2px solid white;
        border-radius: 0.5rem;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .btn-create:hover {
        background-color: transparent;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Botones de acción mejorados */
    .action-btn {
        padding: 0.75rem 1.25rem;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 0.5rem;
        margin-right: 0.75rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 100px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }
    
    .btn-edit {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }
    
    .btn-edit:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);
    }
    
    .btn-delete {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    
    .btn-delete:hover {
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
    }
    
    /* Iconos en botones */
    .btn i {
        margin-right: 8px;
        font-size: 1.1em;
    }
    
    /* Estilos para la tabla */
    .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 1.25rem 1.5rem;
        background-color: #2c3e50;
        color: white;
    }
    
    .table tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border-top: 1px solid #f0f0f0;
        font-size: 0.95rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(58, 123, 213, 0.05);
    }
    
    /* Mensaje cuando no hay requisitos */
    .empty-message {
        padding: 3rem;
        font-size: 1.1rem;
        color: #6c757d;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .action-btn {
            width: 100%;
            margin-right: 0;
        }
        
        .card-header {
            flex-direction: column;
            gap: 1.5rem;
            text-align: center;
        }
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Gestión de Requisitos</h3>
                    <a href="{{ route('admin.requirements.create') }}" class="btn btn-create">
                        <i class="fas fa-plus-circle"></i>Nuevo Requisito
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
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="25%">Servicio</th>
                                    <th width="50%">Nombre</th>
                                    <th width="20%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requirements as $requirement)
                                    <tr>
                                        <td>{{ $requirement->id }}</td>
                                        <td>{{ $requirement->service->name ?? 'Sin servicio' }}</td>
                                        <td>{{ $requirement->name }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.requirements.edit', $requirement->id) }}" 
                                                   class="btn btn-edit action-btn">
                                                    <i class="fas fa-edit"></i>Editar
                                                </a>
                                                <form action="{{ route('admin.requirements.destroy', $requirement->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete action-btn" 
                                                            onclick="return confirm('¿Estás seguro de eliminar este requisito?')">
                                                        <i class="fas fa-trash-alt"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center empty-message">
                                            <i class="fas fa-inbox fa-2x mb-3"></i><br>
                                            No hay requisitos registrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($requirements->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $requirements->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection