@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                            <i class="fas fa-users me-3"></i>GESTIÓN DE USUARIOS
                        </h2>
                        <a href="{{ route('admin.users.create') }}" class="btn py-2 px-4" style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                            <i class="fas fa-plus-circle me-2"></i> NUEVO USUARIO
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if (session('success'))
                        <div class="alert alert-dismissible fade show m-4" role="alert" 
                             style="background-color: #2EC4B6; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.3rem;">
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
                                    <th class="ps-5 py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Nombres</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Apellidos</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Email</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Rol</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Estado</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Fecha Nac.</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Género</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Especialidad</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Certificación</th>
                                    <th class="text-end pe-5 py-3" style="font-weight: 600; font-size: 1.4rem; letter-spacing: 0.5px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr style="border-bottom: 2px solid #F4F4F4;">
                                    <td class="ps-5" style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ $user->names }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ $user->last_name }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ $user->email }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ $user->getRoleNames()->first() ?? 'N/A' }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ $user->statuses->name ?? 'N/A' }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d M Y') }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ $user->gender }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ $user->specialty ?? 'N/A' }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">{{ $user->certification ?? 'N/A' }}</td>
                                    <td class="pe-5 text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn py-2 px-3 mx-1" 
                                               style="background-color: #2EC4B6; color: #FFFFFF; font-size: 1.3rem; font-weight: 500; min-width: 100px;">
                                                <i class="fas fa-edit me-2"></i> EDITAR
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn py-2 px-3 mx-1 btn-eliminar" onclick="confirmarEliminacion(event)" 
                                                        style="font-size: 1.3rem; font-weight: 500; min-width: 100px;">
                                                    <i class="fas fa-trash-alt me-2"></i> ELIMINAR
                                                </button>   
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-users-slash fs-1" style="color: #1A365D; font-size: 3rem;"></i>
                                            <p class="mt-2 fs-5" style="font-size: 1.4rem; font-weight: 600;">No hay usuarios registrados</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Contador con fuente más grande -->
                    <div class="card-footer py-4" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted" style="font-size: 1.4rem; font-weight: 500;">
                                <i class="fas fa-clipboard-list me-2"></i> MOSTRANDO <span class="fw-bold">{{ $users->count() }}</span> USUARIOS REGISTRADOS
                            </div>
                        </div>
                    </div>

                    @if($users->hasPages())
                    <div class="card-footer py-4" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                        <div class="d-flex justify-content-center">
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-size: 1.3rem;
    }
    
    .card {
        border-radius: 10px;
        overflow: hidden;
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

    .btn-eliminar {
        background-color: #FF6B35 !important;
        color: #FFFFFF !important;
        border: none !important;
        transition: all 0.3s ease !important;
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
        
        .card-footer div {
            font-size: 1.1rem !important;
        }
    }
</style>

@section('scripts')
<!-- SweetAlert2 para diálogos personalizados -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Función para confirmación de eliminación
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');
        
        Swal.fire({
            title: '¿Eliminar Usuario?',
            html: `<div style="text-align: center;">
                     <i class="fas fa-exclamation-triangle" style="color: #FF6B35; font-size: 3rem; margin-bottom: 1rem;"></i>
                     <p>¿Está seguro que desea eliminar este usuario permanentemente?</p>
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
</script>
@endsection