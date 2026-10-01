@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-sm card-memberships">
                <div class="card-header card-header-custom">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <div class="eyebrow mb-1">Panel administrativo</div>
                            <h2 class="mb-0 d-flex align-items-center gap-2 title-card">
                                <span class="header-icon"><i class="fas fa-id-card-alt"></i></span>
                                MEMBRESÍAS
                            </h2>
                        </div>
                        <a href="{{ route('admin.memberships.create') }}" class="btn btn-primary-cta">
                            <i class="fas fa-plus-circle me-2"></i> CREAR MEMBRESÍA
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-dismissible fade show m-4 auto-dismiss" role="alert" 
                            style="background-color: #2EC4B6; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.4rem;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 fs-4"></i>
                            <strong style="font-size: 1.4rem !important;">{{ session('success') }}</strong>
                            <button type="button" class="btn-close btn-close-white ms-auto fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="card-body p-0">
                    <div class="table-responsive rounded-bottom">
                        <table class="table table-hover align-middle mb-0 table-memberships">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-signature me-2"></i>NOMBRE</th>
                                    <th class="text-center"><i class="fas fa-align-left me-2"></i>DESCRIPCIÓN</th>
                                    <th class="text-center"><i class="fas fa-tag me-2"></i>PRECIO</th>
                                    <th class="text-center"><i class="far fa-calendar-alt me-2"></i>DURACIÓN</th>
                                    <th class="text-center"><i class="fas fa-info-circle me-2"></i>ESTADO</th>
                                    <th class="text-center" style="width: 250px;"><i class="fas fa-cogs me-2"></i>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($memberships as $membership)
                                    <tr class="row-membership">
                                        <td class="text-center membership-name">
                                            <span class="name-pill">
                                                <i class="fas fa-id-card me-2"></i>{{ $membership->name }}
                                            </span>
                                        </td>
                                        <td class="text-center description-cell">
                                            <div class="description-container">
                                                <div class="short-description">
                                                    <i class="fas fa-align-left me-2 text-muted"></i>
                                                    {{ Str::limit($membership->description, 50) }}
                                                    @if(strlen($membership->description) > 50)
                                                        <a href="#" class="show-more">... <i class="fas fa-chevron-down"></i> Ver más</a>
                                                    @endif
                                                </div>
                                                <div class="full-description d-none">
                                                    <i class="fas fa-align-left me-2 text-muted"></i>
                                                    {{ $membership->description }}
                                                    <a href="#" class="show-less"> <i class="fas fa-chevron-up"></i> Ver menos</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center membership-price">
                                            <span class="meta-badge">
                                                <i class="fas fa-dollar-sign me-2"></i>${{ number_format($membership->price, 2) }}
                                            </span>
                                        </td>
                                        <td class="text-center membership-duration">
                                            <span class="meta-badge">
                                                <i class="far fa-clock me-2"></i>{{ $membership->duration }} días
                                            </span>
                                        </td>
                                        <td class="text-center membership-status">
                                            @php
                                                $status = strtolower($membership->status->name ?? 'N/A');
                                                $colors = [
                                                    'activo' => '#2EC4B6',
                                                    'inactivo' => '#FF6B35',
                                                    'pendiente' => '#FFD166',
                                                ];
                                                $color = $colors[$status] ?? '#A9A9A9';
                                                $icons = [
                                                    'activo' => 'fa-check-circle',
                                                    'inactivo' => 'fa-times-circle',
                                                    'pendiente' => 'fa-clock'
                                                ];
                                                $icon = $icons[$status] ?? 'fa-question-circle';
                                            @endphp
                                            <span class="status-badge" style="background-color: {{ $color }};">
                                                <i class="fas {{ $icon }} me-1"></i>
                                                {{ ucfirst($membership->status->name ?? 'N/A') }}
                                            </span>
                                        </td>
                                        <td class="text-center membership-actions">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.memberships.edit', $membership) }}" class="btn action-btn btn-edit"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                    <i class="fas fa-edit me-2"></i> EDITAR
                                                </a>
                                                <form action="{{ route('admin.memberships.destroy', $membership) }}" method="POST" class="d-inline form-eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn action-btn btn-eliminar"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                                        <i class="fas fa-trash-alt me-2"></i> ELIMINAR
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5" style="font-size: 1.2rem;">
                                            <i class="fas fa-id-card-alt fs-1 d-block mb-3 text-muted opacity-50"></i>
                                            <span class="fw-semibold">No hay membresías registradas</span>
                                        </td>
                                    </tr>
                                @endforelse
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
@endsection

@section('styles')
<style>
    :root {
        --cybac-navy: #1A365D;
        --cybac-navy-strong: #122947;
        --cybac-orange: #FF6B35;
        --cybac-orange-soft: #fff0ea;
        --cybac-teal: #2EC4B6;
        --cybac-slate: #f5f7fb;
        --cybac-text: #23314d;
        --cybac-muted: #6b7280;
        --cybac-border: rgba(26, 54, 93, 0.12);
        --cybac-shadow: 0 18px 45px rgba(17, 34, 60, 0.12);
    }

    .card-memberships {
        border: 1px solid var(--cybac-border) !important;
        border-radius: 18px !important;
        overflow: hidden;
        background: #ffffff;
        box-shadow: var(--cybac-shadow) !important;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #1A365D 0%, #223F6B 55%, #1A365D 100%) !important;
        color: #FFFFFF !important;
        border-bottom: 3px solid #FF6B35 !important;
        padding: 1.25rem 1.5rem !important;
    }

    .eyebrow {
        font-size: 0.75rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        opacity: 0.8;
        font-weight: 700;
    }

    .header-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.12);
        box-shadow: inset 0 0 0 1px rgba(255,255,255,0.18);
    }

    .title-card {
        font-weight: 800 !important;
        font-size: clamp(1.5rem, 2vw, 2.2rem) !important;
        letter-spacing: 0.02em;
    }

    .btn-primary-cta {
        background: linear-gradient(135deg, var(--cybac-orange) 0%, #ff895d 100%) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 700 !important;
        font-size: 1.08rem !important;
        border-radius: 12px !important;
        box-shadow: 0 12px 25px rgba(255, 107, 53, 0.28) !important;
        padding: 0.8rem 1.2rem !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease !important;
    }

    .btn-primary-cta:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 28px rgba(255, 107, 53, 0.34) !important;
    }

    .table-memberships {
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
    }

    .table-memberships thead th {
        background: linear-gradient(180deg, #1a365d 0%, #183356 100%);
        color: #ffffff;
        font-size: 1.08rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 1rem 0.8rem;
        border: none;
        vertical-align: middle;
    }

    .table-memberships tbody td {
        background: #ffffff;
        border-bottom: 1px solid rgba(26, 54, 93, 0.08);
        padding: 1rem 0.8rem;
        vertical-align: middle;
        font-size: 1.04rem;
        color: var(--cybac-text);
    }

    .row-membership {
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .row-membership:hover {
        background: linear-gradient(90deg, rgba(46,196,182,0.05), rgba(26,54,93,0.02));
    }

    .name-pill,
    .meta-badge,
    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        font-weight: 700;
    }

    .name-pill {
        background: rgba(26, 54, 93, 0.08);
        color: var(--cybac-navy);
        padding: 0.6rem 0.9rem;
        font-size: 0.98rem;
    }

    .meta-badge {
        font-size: 0.96rem;
        padding: 0.55rem 0.8rem;
        color: var(--cybac-navy);
        background: #f4f7fb;
        border: 1px solid rgba(26, 54, 93, 0.08);
    }

    .status-badge {
        color: #fff;
        font-size: 0.96rem;
        padding: 0.62rem 0.9rem;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,0.08);
    }

    .description-container {
        position: relative;
        background: #f8fafc;
        border: 1px solid rgba(26, 54, 93, 0.08);
        border-radius: 12px;
        padding: 0.8rem 0.9rem;
        max-width: 300px;
        margin: 0 auto;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
    }

    .short-description,
    .full-description {
        word-break: break-word;
        color: var(--cybac-text);
    }

    .show-more,
    .show-less {
        color: var(--cybac-navy) !important;
        font-weight: 700;
        text-decoration: none;
    }

    .show-more:hover,
    .show-less:hover {
        text-decoration: underline;
    }

    .action-btn {
        border-radius: 12px !important;
        border: none !important;
        color: #fff !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        padding: 0.8rem 1rem !important;
        box-shadow: 0 10px 18px rgba(17, 34, 60, 0.12);
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .btn-edit {
        background: linear-gradient(135deg, #2EC4B6 0%, #39c7b9 100%) !important;
    }

    .btn-eliminar {
        background: linear-gradient(135deg, #FF6B35 0%, #ff865d 100%) !important;
        border: none !important;
    }

    .alert {
        border-radius: 14px;
        padding: 14px 16px;
        border: none;
        box-shadow: 0 12px 22px rgba(17, 34, 60, 0.08);
    }

    .swal2-actions {
        gap: 1.25rem !important;
        margin-top: 1.5rem !important;
    }

    .swal2-confirm, .swal2-cancel {
        padding: 0.7rem 1.5rem !important;
        margin: 0 !important;
        border-radius: 10px !important;
    }

    .swal2-popup {
        border-radius: 18px !important;
        border: 2px solid rgba(26, 54, 93, 0.12) !important;
        font-size: 1.2rem !important;
        box-shadow: 0 24px 60px rgba(17, 34, 60, 0.18) !important;
    }

    .swal2-title {
        color: var(--cybac-navy) !important;
        font-size: 1.7rem !important;
        font-weight: 800 !important;
    }

    .swal2-icon.swal2-warning {
        color: var(--cybac-orange) !important;
        border-color: var(--cybac-orange) !important;
    }

    .swal2-confirm {
        background: linear-gradient(135deg, #FF6B35 0%, #ff865d 100%) !important;
        font-weight: 700 !important;
    }

    .swal2-cancel {
        background: linear-gradient(135deg, #2EC4B6 0%, #39c7b9 100%) !important;
        font-weight: 700 !important;
    }

    .btn-group {
        display: inline-flex;
        flex-wrap: nowrap;
    }

    @media (max-width: 992px) {
        .table-memberships th,
        .table-memberships td {
            white-space: nowrap;
            font-size: 1.05rem !important;
            padding: 14px 10px !important;
        }

        .btn-group {
            flex-direction: column;
            gap: 10px;
        }

        .btn-group .btn {
            width: 100%;
        }

        .description-container {
            max-width: 150px !important;
            white-space: normal !important;
            text-align: left;
        }

        .short-description, .full-description {
            white-space: normal;
            word-break: break-word;
            text-align: left;
        }

        .show-more, .show-less {
            display: block;
            margin-top: 5px;
            white-space: nowrap;
        }
    }

    @media (max-width: 768px) {
        .description-container {
            max-width: 120px !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Auto-dismiss alerts after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.auto-dismiss');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 3000);
        });
        
        // Toggle description visibility
        document.querySelectorAll('.show-more').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const container = this.closest('.description-container');
                container.querySelector('.short-description').classList.add('d-none');
                container.querySelector('.full-description').classList.remove('d-none');
            });
        });
        
        document.querySelectorAll('.show-less').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const container = this.closest('.description-container');
                container.querySelector('.full-description').classList.add('d-none');
                container.querySelector('.short-description').classList.remove('d-none');
            });
        });

        // Inicializar tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Delete confirmation
        const botonesEliminar = document.querySelectorAll('.btn-eliminar');
        botonesEliminar.forEach(boton => {
            boton.addEventListener('click', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    html: `<div style="text-align: center;">
                        <i class="fas fa-exclamation-triangle" style="color: #FF6B35; font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p>¿Está seguro que desea eliminar esta membresía permanentemente?</p>
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