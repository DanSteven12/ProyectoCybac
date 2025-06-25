@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                            <i class="fas fa-user-tag me-3"></i>GESTIÓN DE ROLES
                        </h2>
                        <a href="{{ route('admin.roles.create') }}" class="btn py-2 px-4" style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                            <i class="fas fa-plus-circle me-2"></i> NUEVO ROL
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if (session('success'))
                        <div class="alert alert-dismissible fade show m-4 auto-dismiss" role="alert" style="background-color: #2EC4B6; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.3rem;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-3 fs-4"></i>
                                    <strong class="fs-5">{{ session('success') }}</strong>
                                <button type="button" class="btn-close btn-close-white ms-auto fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="border-top: none;">
                            <thead>
                                <tr style="background-color: #1A365D; color: #FFFFFF;">
                                    <th class="ps-5 py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">NOMBRE</th>
                                    <th class="text-end pe-5 py-3" style="width: 220px; font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                <tr style="border-bottom: 2px solid #F4F4F4;">
                                    <td class="ps-5">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-circle me-4" style="background-color: rgba(26, 54, 93, 0.1); width: 50px; height: 50px;">
                                                <i class="fas fa-user-tag fs-5" style="color: #1A365D;"></i>
                                            </div>
                                            <div>
                                                <h4 class="mb-1" style="color: #1A365D; font-size: 1.4rem; font-weight: 600;">{{ $role->name }}</h4>
                                                <small class="text-muted d-block" style="font-size: 1.3rem; font-weight: 500;">ÚLTIMA ACTUALIZACIÓN: {{ \Carbon\Carbon::parse($role->updated_at)->translatedFormat('d \d\e F \d\e Y')}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pe-5 text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn py-2 px-3 mx-1" 
                                            style="background-color: #2EC4B6; color: #FFFFFF; font-size: 1.3rem; font-weight: 500; min-width: 100px;">
                                                <i class="fas fa-edit me-2"></i> EDITAR
                                            </a>
                                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn py-2 px-3 mx-1 btn-eliminar" onclick="confirmarEliminacion(event)">
                                                    <i class="fas fa-trash-alt me-2"></i> ELIMINAR
                                                </button>   
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-user-tag fs-1" style="color: #1A365D;"></i>
                                            <p class="mt-2 fs-5">No hay roles registrados</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer py-4" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted" style="font-size: 1.4rem; font-weight: 500;">
                                <i class="fas fa-clipboard-list me-2"></i> MOSTRANDO <span class="fw-bold">{{ $roles->count() }}</span> ROLES REGISTRADOS
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .icon-circle {
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .table th {
        padding: 18px 16px;
        text-transform: uppercase;
    }
    
    .table td {
        padding: 16px;
        vertical-align: middle;
    }
    
    .btn {
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(46, 196, 182, 0.08);
        transform: translateY(-1px);
    }
    
    .alert {
        border-radius: 6px;
    }
    
    body {
        font-size: 1.3rem;
    }

    /* Estilo para el botón de eliminar */
    .btn-eliminar {
        background-color: #FF6B35 !important;
        color: #FFFFFF !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
        min-width: 100px !important;
        border: none !important;
        transition: all 0.3s ease !important;
    }
    
    .swal2-actions {
        gap: 1.5rem !important;
        margin-top: 1.5rem !important;
    }
    
    .swal2-confirm, .swal2-cancel {
        padding: 0.6rem 1.5rem !important;
        margin: 0 !important;
    }
    
    /* Estilos para el modal de confirmación */
    .swal2-popup {
        border-radius: 10px !important;
        border: 2px solid #1A365D !important;
        font-size: 1.3rem !important;
    }
    
    .swal2-title {
        color: #1A365D !important;
        font-size: 1.7rem !important;
        font-weight: 700 !important;
    }
    
    .swal2-icon.swal2-warning {
        color: #FF6B35 !important;
        border-color: #FF6B35 !important;
    }
    
    .swal2-confirm {
        background-color: #FF6B35 !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
    }
    
    .swal2-cancel {
        background-color: #2EC4B6 !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
    }

    /* Ajustes para móviles */
    @media (max-width: 992px) {
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .table th, .table td {
            white-space: nowrap;
            font-size: 1.1rem !important;
            padding: 14px 10px !important;
        }
        
        .btn {
            padding: 0.5rem 1.0rem !important;
            font-size: 1.1rem !important;
            min-width: auto !important;
        }
        
        .card-header h2 {
            font-size: 1.6rem !important;
        }
        
        .card-header .btn {
            font-size: 1.1rem !important;
            padding: 0.5rem 1.0rem !important;
        }
        
        .icon-circle {
            width: 40px !important;
            height: 40px !important;
            margin-right: 10px !important;
        }
        
        .card-footer div {
            font-size: 1.1rem !important;
        }
    }
</style>

@section('scripts')
<!-- SweetAlert2 para diálogos personalizados -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Auto-dismiss alerts after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.auto-dismiss');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 3000); // 3000 milisegundos = 3 segundos
        });
    });

    // Función para confirmación de eliminación
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');
        
        Swal.fire({
            title: '¿Eliminar Rol?',
            html: `<div style="text-align: center;">
                    <i class="fas fa-exclamation-triangle" style="color: #FF6B35; font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>¿Está seguro que desea eliminar este rol permanentemente?</p>
                    <p style="font-weight: 600;">Esta acción no se puede deshacer.</p>
                </div>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-trash-alt me-2"></i> Eliminar',
            cancelButtonText: '<i class="fas fa-times me-2"></i> Cancelar',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-eliminar',
                cancelButton: 'btn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // Enable tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection