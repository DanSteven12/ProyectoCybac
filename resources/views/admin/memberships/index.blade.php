@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h2 class="mb-3 mb-md-0" style="font-weight: 700; font-size: 2rem;">
                            <i class="fas fa-id-card-alt me-3"></i>MEMBRESÍAS
                        </h2>
                        <a href="{{ route('admin.memberships.create') }}" class="btn py-2 px-4" style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                            <i class="fas fa-plus-circle me-2"></i> CREAR MEMBRESÍA
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if(session('success'))
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
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background-color: #1A365D; color: #FFFFFF;">
                                <tr>
                                    <th style="font-size: 1.4rem; font-weight: 600;">NOMBRE</th>
                                    <th style="font-size: 1.4rem; font-weight: 600;">DESCRIPCIÓN</th>
                                    <th style="font-size: 1.4rem; font-weight: 600;">PRECIO</th>
                                    <th style="font-size: 1.4rem; font-weight: 600;">DURACIÓN</th>
                                    <th style="font-size: 1.4rem; font-weight: 600;">ESTADO</th>
                                    <th class="text-end" style="font-size: 1.4rem; font-weight: 600;">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($memberships as $membership)
                                    <tr style="border-bottom: 2px solid #F4F4F4;">
                                        <td style="font-size: 1.3rem; font-weight: 600; color: #1A365D;">{{ $membership->name }}</td>
                                        <td style="font-size: 1.3rem;">{{ $membership->description }}</td>
                                        <td style="font-size: 1.3rem;">${{ number_format($membership->price, 2) }}</td>
                                        <td style="font-size: 1.3rem;">{{ $membership->duration }} días</td>
                                        <td>
                                        @php
                                        $status = strtolower($membership->status->name ?? 'N/A');
                                        $colors = [
                                            'activo' => '#2EC4B6',      // Verde
                                            'inactivo' => '#FF6B35',    // Naranja
                                            'pendiente' => '#FFD166',   // Amarillo
                                            ];
                                        $color = $colors[$status] ?? '#A9A9A9'; // Gris por defecto
                                        @endphp

                                        <span class="badge" style="background-color: {{ $color }}; color: #FFFFFF; font-size: 1.2rem;">
                                        {{ ucfirst($membership->status->name ?? 'N/A') }}
                                        </span>
                                        </td>

                                        <td class="text-end">
                                            <div class="btn-group flex-wrap justify-content-end" role="group">
                                                <a href="{{ route('admin.memberships.edit', $membership) }}" class="btn py-2 px-3 mx-1 mb-2 mb-md-0" 
                                                    style="background-color: #2EC4B6; color: #FFFFFF; font-size: 1.3rem; font-weight: 500;">
                                                    <i class="fas fa-edit me-2"></i> EDITAR
                                                </a>
                                                <form action="{{ route('admin.memberships.destroy', $membership) }}" method="POST" class="d-inline form-eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn py-2 px-3 mx-1 mb-2 mb-md-0 btn-eliminar" 
                                                            style="background-color: #FF6B35; color: #FFFFFF; font-size: 1.3rem; font-weight: 500;">
                                                        <i class="fas fa-trash-alt me-2"></i> ELIMINAR
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer py-4" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div class="text-muted" style="font-size: 1.4rem; font-weight: 500;">
                                <i class="fas fa-clipboard-list me-2"></i> MOSTRANDO <span class="fw-bold">{{ $memberships->count() }}</span> MEMBRESÍAS REGISTRADAS
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('content')
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

    .btn-eliminar {
        background-color: #FF6B35 !important;
        color: #FFFFFF !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
        min-width: 100px !important;
        border: none !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    /*Estilo del alert*/    
    .btn-eliminar {
        background-color: #FF6B35 !important;
        color: #FFFFFF !important;
        font-size: 1.3rem !important; /* Aumentado de 1.1rem */
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

        .btn-group {
            flex-direction: column;
            gap: 10px;
        }

        .btn-group .btn {
            width: 100%;
            margin: 5px 0;
        }

        .table td .fa-info-circle {
            font-size: 1.2rem !important;
            margin-right: 8px !important;
        }
    }
</style>
{{-- SweetAlert2 --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botonesEliminar = document.querySelectorAll('.btn-eliminar');

        botonesEliminar.forEach(boton => {
            boton.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    html: `<div style="text-align: center;">
                    <i class="fas fa-exclamation-triangle" style="color: #FF6B35; font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>¿Está seguro que desea eliminar esta membresia permanentemente?</p>
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
                        this.closest('form').submit();
                    }
                });
            });
        });
    });
</script>
@endsection

