@extends('layouts.admi-app-master')

@section('content')

<div class="container-fluid py-4">
    <!-- Encabezado -->
    <div class="mb-4">
        <h1 class="fw-bold text-azul-marino mb-1" style="font-size: 1.9rem;">
            FITINIFLOW
        </h1>
        <h2 class="fw-bold text-azul-marino mb-1" style="font-size: 1.6rem;">
            Lista de Pagos
        </h2>
        <p class="text-azul-marino opacity-80" style="font-size: 1.5rem;">
            Gestión de pagos de membresías
        </p>
    </div>

    <!-- Filtro por estado -->
    <form action="{{ route('admin.payments.index') }}" method="GET" class="mb-4 card shadow-sm border-0" style="background-color: var(--azul-oscuro);">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="estado" class="form-label fw-semibold text-white" style="font-size: 1.4rem">Filtrar por estado:</label>
                    <select name="estado" id="estado" class="form-select-enhanced" style="font-size: 1.3rem; background-color: var(--blanco);" onchange="this.form.submit()">
                        <option value="pendiente" {{ request('estado', 'pendiente') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                        <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                        <option value="vencido" {{ request('estado') == 'vencido' ? 'selected' : '' }}>Vencido</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="search" class="form-label fw-semibold text-white" style="font-size: 1.4rem">Buscar usuario:</label>
                    <input 
                        type="text"
                        name="search"
                        id="search"
                        class="form-control"
                        placeholder="Buscar por nombre, apellido o correo..."
                        value="{{ request('search') }}"
                        style="background-color: var(--blanco); font-size: 1.3rem;"
                    >
                </div>
            </div>
            <center class="mt-3">
                <button type="submit" class="btn py-2 px-4" style="background-color: var(--naranja-brillante); color: var(--blanco); font-weight: 600; font-size: 1.3rem;">
                    <i class="fas fa-search me-2"></i> BUSCAR
                </button>

                <a href="{{ route('admin.payments.index', ['estado' => request('estado', 'pendiente')]) }}" 
                   class="btn py-2 px-4" 
                   style="background-color: var(--azul-marino); color: var(--blanco); font-weight: 600; font-size: 1.3rem;">
                    <i class="fas fa-times me-2"></i> LIMPIAR
                </a>
            </center>
        </div>
    </form>

    <!-- Resumen de totales -->
    @if(request('estado') == 'aprobado')
    <div class="alert text-white mb-4" style="font-size: 1.4rem; background-color: var(--verde-esmeralda);">
        <div class="d-flex justify-content-between">
            <span>Total de ventas: <strong>${{ number_format($payments->sum('price'), 2) }}</strong></span>
            <span>Total de membresías: <strong>{{ $payments->count() }}</strong></span>
        </div>
    </div>
    @endif

    <!-- Formulario de reportes -->
    <form action="{{ route('admin.payments.report') }}" method="GET" class="mb-4 card shadow-sm border-0" id="report-form" style="background-color: var(--azul-oscuro);">
        <div class="card-body">
            <input type="hidden" name="estado" value="{{ request('estado', 'pendiente') }}">
            <input type="hidden" name="format" value="pdf">
            <input type="hidden" name="view" value="0" id="view-input">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="mes" class="form-label fw-semibold text-white" style="font-size: 1.4rem">Mes:</label>
                    <div class="custom-select-wrapper">
                        <select name="mes" id="mes" class="form-select-enhanced" style="font-size: 1.3rem; background-color: var(--blanco);" required>
                            @foreach([
                                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                            ] as $numero => $nombre)
                                <option value="{{ $numero }}" {{ $numero == date('n') ? 'selected' : '' }}>{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="anio" class="form-label fw-semibold text-white" style="font-size: 1.4rem">Año:</label>
                    <div class="custom-select-wrapper">
                        <select name="anio" id="anio" class="form-select-enhanced" required style="font-size: 1.3rem; background-color: var(--blanco);">
                            @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                                <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-sm w-100" style="font-size: 1.4rem; background-color: var(--naranja-brillante); color: var(--blanco);"
                        onclick="document.getElementById('view-input').value=0">
                        <i class="fas fa-file-download me-1"></i> Descargar PDF
                    </button>
                    <button type="submit" class="btn btn-sm w-100" style="font-size: 1.4rem; background-color: var(--verde-esmeralda); color: var(--blanco);"
                        onclick="document.getElementById('view-input').value=1; this.form.target='_blank';">
                        <i class="fas fa-eye me-1"></i> Ver PDF
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Paginación superior -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-3">
            <span class="badge text-white" style="font-size: 1.4rem; background-color: var(--azul-marino);">
                {{ ucfirst(request('estado', 'pendiente')) }}
            </span>
            @if(request('estado') == 'aprobado')
            <span class="text-azul-marino" style="font-size: 1.4rem;">
                <i class="fas fa-dollar-sign me-1"></i>{{ number_format($payments->sum('price'), 2) }}
            </span>
            @endif
        </div>
        
        <nav>
            <ul class="pagination pagination-rounded mb-0">
                <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link text-azul-marino" href="{{ $payments->previousPageUrl() }}" style="border-color: var(--azul-marino); font-size: 1.3rem;">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                
                @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                    <li class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link {{ $payments->currentPage() == $page ? 'bg-azul-marino text-white' : 'text-azul-marino' }}" 
                           href="{{ $url }}" style="border-color: var(--azul-marino); font-size: 1.4rem;">{{ $page }}</a>
                    </li>
                @endforeach
                
                <li class="page-item {{ $payments->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link text-azul-marino" href="{{ $payments->nextPageUrl() }}" style="border-color: var(--azul-marino); font-size: 1.4rem;">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Tabla de pagos -->
    <div class="card border-0 shadow-sm mb-5 overflow-hidden">
        <div class="card-header text-white py-2" style="background-color: var(--azul-marino);">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="font-size: 1.5rem;">
                    <i class="fas fa-list-alt me-2"></i>Registros de pagos
                </h5>
                <span class="badge" style="font-size: 1.4rem; background-color: var(--blanco); color: var(--azul-marino);">
                    {{ $payments->total() }} registros
                </span>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: var(--verde-esmeralda);">
                        <tr>
                            <th style="font-size: 1.4rem;">Usuario</th>
                            <th style="font-size: 1.4rem;">Membresía</th>
                            <th style="font-size: 1.4rem;">Monto</th>
                            <th style="font-size: 1.4rem;">Estado</th>
                            <th style="font-size: 1.4rem;">Fecha</th>
                            <th style="font-size: 1.4rem;">Comprobante</th>
                            <th id="th-comentario" style="display: none; font-size: 1.4rem;">Comentario</th>
                            <th id="th-accion" style="display: none; font-size: 1.4rem;">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="payment-table-body">
                        @foreach($payments as $payment)
                        @php
                            $statusClass = match($payment->status->name) {
                                'Pendiente de revisión' => 'pendiente',
                                'Aprobado' => 'aprobado',
                                'Rechazado' => 'rechazado',
                                'Vencido' => 'vencido',
                                default => ''
                            };
                        @endphp
                        <tr class="payment-row {{ $statusClass }}">
                            <td class="py-2" style="font-size: 1.4rem;">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm rounded-circle d-flex align-items-center justify-content-center me-2" style="background-color: var(--azul-marino); color: var(--blanco);">
                                        {{ substr($payment->user->names, 0, 1) }}{{ substr($payment->user->last_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold" style="font-size: 1.4rem;">{{ $payment->user->names }} {{ $payment->user->last_name }}</div>
                                        <small class="text-muted" style="font-size: 1.4rem;">{{ $payment->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2" style="font-size: 1.4rem;">
                                <span class="fw-semibold">{{ $payment->membership->name }}</span>
                                <small class="text-muted d-block" style="font-size: 1.4rem;">({{ $payment->membership->duration }} días)</small>
                            </td>
                            <td class="py-2 fw-semibold" style="font-size: 1.4rem;">${{ number_format($payment->price, 2) }}</td>
                            <td class="py-2" style="font-size: 1.4rem;">
                                <span class="badge status-badge" style="font-size: 1.4rem;">{{ $payment->status->name }}</span>
                            </td>
                            <td class="py-2" style="font-size: 1.4rem;">
                                <div class="d-flex flex-column">
                                    <span>{{ \Carbon\Carbon::parse($payment->date)->translatedFormat('d M Y') }}</span>
                                    @if($statusClass === 'vencido' && $payment->expiration_date)
                                    <small class="text-danger" style="font-size: 1.4rem;">
                                        <i class="fas fa-clock me-1"></i>Expiró: {{ \Carbon\Carbon::parse($payment->expiration_date)->translatedFormat('d M Y') }}
                                    </small>
                                    @endif
                                </div>
                            </td>
                            <td class="py-2" style="font-size: 1.4rem;">
                                <a href="{{ Storage::url($payment->receipt_url) }}" target="_blank" 
                                   class="btn btn-sm" style="background-color: var(--verde-esmeralda); color: var(--blanco); font-size: 1.4rem;">
                                    <i class="fas fa-eye me-1"></i> Ver
                                </a>
                            </td>
                            <td class="comentario-col py-2" style="{{ $statusClass === 'rechazado' ? '' : 'display:none' }}; font-size: 1.4rem;">
                                <small style="font-size: 1.4rem;">{{ $statusClass === 'rechazado' ? ($payment->comment ?? 'Sin comentario') : '' }}</small>
                            </td>
                            <td class="accion-col py-2" style="{{ $statusClass === 'pendiente' ? '' : 'display:none' }}; font-size: 1.4rem;">
                                @if($statusClass === 'pendiente')
                                <form id="form-{{ $payment->id }}" action="{{ route('admin.payments.update', $payment) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex gap-2">
                                        <div class="custom-select-container select-sm">
                                            <select name="status_id" onchange="handleStatusChange(this, {{ $payment->id }})" class="custom-select" style="font-size: 1.4rem;">
                                                <option value="4" selected>Pendiente</option>
                                                <option value="5">Aprobar</option>
                                                <option value="6">Rechazar</option>
                                            </select>
                                            <div class="custom-select-arrow">
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                        <div id="comment-area-{{ $payment->id }}" class="flex-grow-1" style="display: none;">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="comment" class="form-control" 
                                                    placeholder="Motivo" required style="font-size: 1.4rem;">
                                                <button type="submit" class="btn btn-sm" style="background-color: var(--naranja-brillante); color: var(--blanco); font-size: 1.4rem;">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginación inferior -->
    <div class="d-flex justify-content-center">
        <nav>
            <ul class="pagination pagination-rounded mb-0">
                <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link text-azul-marino" href="{{ $payments->previousPageUrl() }}" style="border-color: var(--azul-marino); font-size: 1.4rem;">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                
                @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                    <li class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link {{ $payments->currentPage() == $page ? 'bg-azul-marino text-white' : 'text-azul-marino' }}" 
                        href="{{ $url }}" style="border-color: var(--azul-marino); font-size: 1.4rem;">{{ $page }}</a>
                    </li>
                @endforeach
                
                <li class="page-item {{ $payments->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link text-azul-marino" href="{{ $payments->nextPageUrl() }}" style="border-color: var(--azul-marino); font-size: 1.4rem;">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<style>
    :root {
        --azul-marino: #1A365D;
        --naranja-brillante: #FF6B35;
        --verde-esmeralda: #2EC4B6;
        --blanco: #FFFFFF;
        --azul-oscuro: #0f2a4a;
        --neon-glow: #2EC4B6;
    }
    
    .text-azul-marino { color: var(--azul-marino); }
    .bg-azul-marino { background-color: var(--azul-marino); }
    .bg-verde-esmeralda { background-color: var(--verde-esmeralda); }
    .bg-naranja-brillante { background-color: var(--naranja-brillante); }
    
    .status-badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
        border-radius: 0.5rem;
    }
    
    .pendiente .status-badge { background-color: #FFD166; color: var(--azul-marino); }
    .aprobado .status-badge { background-color: var(--verde-esmeralda); color: white; }
    .rechazado .status-badge { background-color: var(--naranja-brillante); color: white; }
    .vencido .status-badge { background-color: #6C757D; color: white; }
    
    .card {
        border-radius: 0.5rem;
        border: none;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(26, 54, 93, 0.05);
    }

    /* Select personalizado */
    .custom-select-container {
        position: relative;
        width: 100%;
    }
    
    .custom-select {
        width: 100%;
        padding: 0.5rem 2rem 0.5rem 1rem;
        color: var(--azul-marino);
        background-color: white;
        border: 1px solid rgba(26, 54, 93, 0.2);
        border-radius: 0.5rem;
        appearance: none;
        transition: all 0.3s ease;
    }
    
    .select-sm .custom-select {
        padding: 0.25rem 1.5rem 0.25rem 0.75rem;
    }
    
    .custom-select:focus {
        outline: none;
        border-color: var(--azul-marino);
        box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1);
    }
    
    .custom-select-arrow {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        pointer-events: none;
        color: var(--azul-marino);
        transition: transform 0.2s ease;
    }
    
    .custom-select:focus ~ .custom-select-arrow {
        transform: translateY(-50%) rotate(180deg);
    }
    
    /* Avatar de usuario */
    .avatar-sm {
        width: 35px;
        height: 35px;
        font-weight: bold;
    }
    
    /* Paginación redondeada */
    .pagination-rounded .page-link {
        border-radius: 50% !important;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 3px;
        transition: all 0.2s ease;
    }
    
    .pagination-rounded .page-item.active .page-link {
        background-color: var(--azul-marino);
        border-color: var(--azul-marino);
    }
    
    .pagination-rounded .page-link:hover {
        background-color: rgba(26, 54, 93, 0.1);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card-header h5, .alert {
            font-size: 1.2rem;
        }
        
        .pagination-rounded .page-link {
            width: 35px;
            height: 35px;
        }
        
        .custom-select {
            font-size: 1.2rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        filterPayments("{{ request('estado', 'pendiente') }}");
    });

    function handleStatusChange(select, id) {
        const commentArea = document.getElementById(`comment-area-${id}`);
        if (select.value == 6) {
            commentArea.style.display = 'block';
        } else {
            document.getElementById(`form-${id}`).submit();
        }
    }

    function filterPayments(tipo) {
        document.querySelectorAll('.payment-row').forEach(row => {
            row.style.display = row.classList.contains(tipo) ? '' : 'none';
        });
        
        document.getElementById('th-accion').style.display = tipo === 'pendiente' ? '' : 'none';
        document.getElementById('th-comentario').style.display = tipo === 'rechazado' ? '' : 'none';
    }

    function filtrarPagosEnVivo() {
        const input = document.getElementById("search-live");
        const searchTerm = input.value.toLowerCase();
        const estadoActual = "{{ request('estado', 'pendiente') }}";
        const rows = document.querySelectorAll(`#payment-table-body tr.${estadoActual}`);
        
        rows.forEach(row => {
            const textoFila = row.textContent.toLowerCase();
            row.style.display = textoFila.includes(searchTerm) ? "" : "none";
        });
    }
</script>
@endsection