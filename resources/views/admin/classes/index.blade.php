@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-4 px-4" style="background: linear-gradient(135deg, #1A365D 0%, #223F6B 55%, #1A365D 100%); color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div>
                            <div class="eyebrow mb-1">Panel administrativo</div>
                            <h2 class="mb-0 d-flex align-items-center gap-2" style="font-weight: 800; font-size: clamp(1.5rem, 2vw, 2.2rem); letter-spacing: 0.02em;">
                                <span class="header-icon"><i class="fas fa-dumbbell"></i></span>
                                GESTIÓN DE CLASES
                            </h2>
                        </div>
                        <a href="{{ route('admin.classes.create') }}" class="btn btn-primary-cta py-2 px-4">
                            <i class="fas fa-plus-circle me-2"></i> NUEVA CLASE
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-dismissible fade show m-3 auto-dismiss" role="alert" 
                             style="background-color: #2EC4B6; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.4rem;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2 fs-4"></i>
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-dismissible fade show m-3" role="alert" 
                             style="background-color: #FF6B35; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.2rem;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-2 fs-4"></i>
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive rounded-bottom">
                        <table class="table table-hover align-middle mb-0 table-classlist">
                            <thead>
                                <tr>
                                    <th class="th-service"><i class="fas fa-list-alt me-2"></i>SERVICIO</th>
                                    <th class="th-instructor"><i class="fas fa-chalkboard-teacher me-2"></i>INSTRUCTOR</th>
                                    <th class="text-center th-date"><i class="far fa-calendar-alt me-2"></i>FECHA</th>
                                    <th class="text-center th-time"><i class="far fa-clock me-2"></i>HORA</th>
                                    <th class="text-center th-capacity"><i class="fas fa-users me-2"></i>CAPACIDAD</th>
                                    <th class="text-center th-registered"><i class="fas fa-user-check me-2"></i>INSCRITOS</th>
                                    <th class="text-center th-room"><i class="fas fa-door-open me-2"></i>SALÓN</th>
                                    <th class="text-center th-description"><i class="fas fa-align-left me-2"></i>DESCRIPCIÓN</th>
                                    <th class="text-center th-status"><i class="fas fa-info-circle me-2"></i>ESTADO</th>
                                    <th class="text-center th-actions"><i class="fas fa-cogs me-2"></i>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classes as $class)
                                    <tr class="row-class">
                                        <td class="cell-service">
                                            <span class="service-pill">
                                                <i class="fas fa-{{ $class->service ? 'check-circle text-success' : 'times-circle text-danger' }} me-2"></i>
                                                {{ $class->service?->name ?? 'Sin servicio' }}
                                            </span>
                                        </td>
                                        <td class="cell-instructor">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="avatar-badge"><i class="fas fa-user-tie"></i></span>
                                                <span>{{ $class->instructor->names }} {{ $class->instructor->last_name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center cell-date">
                                            <span class="meta-badge meta-date">
                                                <i class="far fa-calendar me-2"></i>
                                                {{ \Carbon\Carbon::parse($class->date)->translatedFormat('d \d\e F \d\e Y')}}
                                            </span>
                                        </td>
                                        <td class="text-center cell-time">
                                            <span class="meta-badge meta-time">
                                                <i class="fas fa-clock me-2"></i>
                                                {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}
                                            </span>
                                        </td>
                                        <td class="text-center cell-capacity">
                                            <span class="meta-badge meta-capacity">
                                                <i class="fas fa-chair me-2"></i>
                                                {{ $class->max_capacity }}
                                            </span>
                                        </td>
                                        <td class="text-center cell-registered">
                                            <span class="meta-badge meta-registered">
                                                <i class="fas fa-user-plus me-2"></i>
                                                {{ $class->registrations->count() }} / {{ $class->max_capacity }}
                                            </span>
                                        </td>
                                        <td class="text-center cell-room">
                                            <span class="meta-badge meta-room">
                                                <i class="fas fa-door-closed me-2"></i>
                                                {{ $class->room }}
                                            </span>
                                        </td>
                                        <td class="text-center description-cell">
                                            <div class="description-container" style="max-width: 300px; margin: 0 auto;">
                                                <div class="short-description">
                                                    <i class="fas fa-align-left me-2 text-muted"></i>
                                                    {{ Str::limit($class->description, 50) }}
                                                    @if(strlen($class->description) > 50)
                                                        <a href="#" class="show-more">... <i class="fas fa-chevron-down"></i> Ver más</a>
                                                    @endif
                                                </div>
                                                <div class="full-description d-none">
                                                    <i class="fas fa-align-left me-2 text-muted"></i>
                                                    {{ $class->description }}
                                                    <a href="#" class="show-less"> <i class="fas fa-chevron-up"></i> Ver menos</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center status-cell">
                                            @php
                                            $status = strtolower($class->status->name ?? 'N/A');
                                            $colors = [
                                                'disponible' => '#2EC4B6',
                                                'cupo lleno' => '#FF6B35',
                                                'cancelada' => '#FFD166',
                                            ];
                                            $color = $colors[$status] ?? '#A9A9A9';
                                            $icons = [
                                                'disponible' => 'fa-check-circle',
                                                'cupo lleno' => 'fa-times-circle',
                                                'cancelada' => 'fa-ban'
                                            ];
                                            $icon = $icons[$status] ?? 'fa-question-circle';
                                            @endphp

                                            <span class="status-badge" style="background-color: {{ $color }};">
                                                <i class="fas {{ $icon }} me-1"></i>
                                                {{ ucfirst($class->status->name ?? 'N/A') }}
                                            </span>
                                        </td>
                                        <td class="text-center actions-cell">
                                            <div class="d-flex justify-content-center align-items-center gap-2" role="group">
                                                <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn action-btn btn-edit"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn action-btn btn-eliminar"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.classes.registrations', $class->id) }}" class="btn action-btn btn-view"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Inscripciones">
                                                    <i class="fas fa-users"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4 empty-state" style="font-size: 1.4rem;">
                                            <i class="fas fa-exclamation-triangle me-2"></i>No hay clases registradas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer py-3" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="text-muted" style="font-size: 1.4rem; font-weight: 500;">
                                <i class="fas fa-clipboard-list me-1"></i> MOSTRANDO <span class="fw-bold">{{ $classes->count() }}</span> CLASES REGISTRADAS
                            </div>
                            <div class="mt-2 mt-md-0">
                                {{ $classes->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    .container-fluid {
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }

    .card {
        border-radius: 18px;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid var(--cybac-border);
        box-shadow: var(--cybac-shadow);
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

    .btn-primary-cta {
        background: linear-gradient(135deg, var(--cybac-orange) 0%, #ff895d 100%) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 700 !important;
        font-size: 1.08rem !important;
        border-radius: 12px !important;
        box-shadow: 0 12px 25px rgba(255, 107, 53, 0.28) !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease !important;
    }

    .btn-primary-cta:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 28px rgba(255, 107, 53, 0.34) !important;
    }

    .table-classlist {
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
    }

    .table-classlist thead th {
        background: linear-gradient(180deg, #1a365d 0%, #183356 100%);
        color: #ffffff;
        font-size: 1.12rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 1rem 0.75rem;
        border: none;
        vertical-align: middle;
    }

    .table-classlist tbody td {
        background: #ffffff;
        border-bottom: 1px solid rgba(26, 54, 93, 0.08);
        padding: 1rem 0.8rem;
        vertical-align: middle;
        font-size: 1.05rem;
        color: var(--cybac-text);
    }

    .row-class {
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .row-class:hover {
        background: linear-gradient(90deg, rgba(46,196,182,0.05), rgba(26,54,93,0.02));
    }

    .service-pill,
    .meta-badge,
    .status-badge,
    .avatar-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        font-weight: 600;
    }

    .service-pill {
        background: rgba(46, 196, 182, 0.12);
        color: var(--cybac-navy);
        padding: 0.55rem 0.8rem;
        font-size: 0.98rem;
    }

    .avatar-badge {
        width: 32px;
        height: 32px;
        min-width: 32px;
        background: rgba(26, 54, 93, 0.10);
        color: var(--cybac-navy);
        font-size: 0.85rem;
    }

    .meta-badge {
        font-size: 0.96rem;
        padding: 0.45rem 0.7rem;
        color: var(--cybac-navy);
        background: #f4f7fb;
        border: 1px solid rgba(26, 54, 93, 0.08);
    }

    .status-badge {
        color: #fff;
        font-size: 0.96rem;
        padding: 0.6rem 0.9rem;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,0.08);
    }

    .description-cell {
        color: var(--cybac-navy);
    }

    .description-container {
        background: #f8fafc;
        border: 1px solid rgba(26, 54, 93, 0.08);
        border-radius: 12px;
        padding: 0.8rem 0.9rem;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
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
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 12px !important;
        border: none !important;
        color: #fff !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 1rem !important;
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

    .btn-view {
        background: linear-gradient(135deg, #1A365D 0%, #244a7d 100%) !important;
    }

    .alert {
        border-radius: 14px;
        padding: 14px 16px;
        border: none;
        box-shadow: 0 12px 22px rgba(17, 34, 60, 0.08);
    }

    .auto-dismiss {
        font-size: 1.05rem;
    }

    .card-footer {
        background: linear-gradient(180deg, #f8fafc 0%, #f2f6fb 100%);
        border-top: 1px solid var(--cybac-border);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--cybac-navy) 0%, #234b85 100%);
        border-color: var(--cybac-navy);
        color: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 18px rgba(26, 54, 93, 0.18);
    }

    .pagination .page-link {
        color: var(--cybac-navy);
        border: 1px solid rgba(26, 54, 93, 0.12);
        border-radius: 10px;
        margin: 0 0.2rem;
        font-weight: 600;
        padding: 0.55rem 0.8rem;
        background: white;
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

    @media (max-width: 992px) {
        .table-responsive {
            overflow-x: auto;
        }

        .table-classlist th,
        .table-classlist td {
            white-space: nowrap;
        }

        .card-header {
            padding: 1.2rem 1rem !important;
        }

        .card-header .d-flex {
            align-items: flex-start !important;
        }

        .btn-primary-cta {
            width: 100%;
            justify-content: center;
        }

        .card-footer .d-flex {
            align-items: flex-start !important;
        }

        .d-flex.justify-content-center {
            flex-direction: column;
            gap: 8px;
        }

        .d-flex.justify-content-center .btn,
        .d-flex.justify-content-center form {
            width: 100%;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.auto-dismiss');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 3000); // 3000 milisegundos = 3 segundos
        });

        // Funcionalidad para "Ver más" / "Ver menos"
        document.querySelectorAll('.show-more').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const container = this.closest('.description-container');
                container.querySelector('.short-description').classList.add('d-none');
                container.querySelector('.full-description').classList.remove('d-none');
            });
        });

        document.querySelectorAll('.show-less').forEach(link => {
            link.addEventListener('click', function(e) {
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

        // Tu código existente para los botones de eliminar...
        const botonesEliminar = document.querySelectorAll('.btn-eliminar');

        botonesEliminar.forEach(boton => {
            boton.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    html: `<div style="text-align: center; font-size: 1.4rem;">
                    <i class="fas fa-exclamation-triangle" style="color: #FF6B35; font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>¿Está seguro que desea eliminar esta clase permanentemente?</p>
                    <p style="font-weight: 600;">Esta acción no se puede deshacer.</p>
                </div>`,                    
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Eliminar',
                    cancelButtonText: '<i class="fas fa-times me-1"></i> Cancelar',
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