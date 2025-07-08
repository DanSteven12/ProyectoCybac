@extends('layouts.admi-app-master')

@section('content')

<div class="container-fluid py-4">
    <!-- Encabezado (sin cambios en estructura) -->
    <div class="mb-4">
        <h2 class="fw-bold text-primary-dark mb-1" style="font-size: 1.8rem;">
            Lista de Pagos
        </h2>
        <p class="text-primary-dark opacity-80" style="font-size: 1.5rem;">
            Gestión de pagos de membresías
        </p>
    </div>

    <!-- Filtro por estado (mejorado visualmente pero misma funcionalidad) -->
    <form action="{{ route('admin.payments.index') }}" method="GET" class="mb-4 card shadow-sm border-0">
        <div class="card-body">
            <label for="estado" class="form-label fw-semibold text-primary-dark" style="font-size: 1.4rem">Filtrar por estado:</label>
            <div class="custom-select-wrapper">
                <select name="estado" id="estado" class="form-select-enhanced" style="font-size: 1.3rem" onchange="this.form.submit()">
                    <option value="pendiente" {{ request('estado', 'pendiente') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                    <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                    <option value="vencido" {{ request('estado') == 'vencido' ? 'selected' : '' }}>Vencido</option>
                </select>
            </div>
        </div>
    </form>

    <!-- Resumen de totales (sin cambios) -->
    @if(request('estado') == 'aprobado')
    <div class="alert bg-primary-dark text-white mb-4" style="font-size: 1.4rem">
        <div class="d-flex justify-content-between">
            <span>Total de ventas: <strong>${{ number_format($payments->sum('price'), 2) }}</strong></span>
            <span>Total de membresías: <strong>{{ $payments->count() }}</strong></span>
        </div>
    </div>
    @endif

    <!-- Formulario de reportes (mejor visualmente, misma funcionalidad) -->
    <form action="{{ route('admin.payments.report') }}" method="GET" class="mb-4 card shadow-sm border-0" id="report-form">
        <div class="card-body">
            <input type="hidden" name="estado" value="{{ request('estado', 'pendiente') }}">
            <input type="hidden" name="format" value="pdf">
            <input type="hidden" name="view" value="0" id="view-input">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="mes" class="form-label fw-semibold text-primary-dark" style="font-size: 1.4rem">Mes:</label>
                    <div class="custom-select-wrapper">
                        <select name="mes" id="mes" class="form-select-enhanced" style="font-size: 1.3rem" required>
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
                    <label for="anio" class="form-label fw-semibold text-primary-dark" style="font-size: 1.4rem">Año:</label>
                    <div class="custom-select-wrapper">
                        <select name="anio" id="anio" class="form-select-enhanced" required style="font-size: 1.3rem">
                            @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                                <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary-dark btn-sm w-100" style="font-size: 1.3rem;"
                        onclick="document.getElementById('view-input').value=0">
                        <i class="fas fa-file-download me-1"></i> Descargar PDF
                    </button>
                    <button type="submit" class="btn btn-outline-primary-dark btn-sm w-100" style="font-size: 1.3rem;"
                        onclick="document.getElementById('view-input').value=1; this.form.target='_blank';">
                        <i class="fas fa-eye me-1"></i> Ver PDF
                    </button>
                </div>
            </div>
        </div>
    </form>


    <!-- Paginación superior - Diseño compacto -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-primary-dark text-white" style="font-size: 0.9rem;">
                {{ ucfirst(request('estado', 'pendiente')) }}
            </span>
            @if(request('estado') == 'aprobado')
            <span class="text-primary-dark" style="font-size: 0.9rem;">
                <i class="fas fa-dollar-sign me-1"></i>{{ number_format($payments->sum('price'), 2) }}
            </span>
            @endif
        </div>
        
        <nav>
            <ul class="pagination pagination-rounded mb-0">
                <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link border-primary text-primary-dark" href="{{ $payments->previousPageUrl() }}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                
                @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                    <li class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link border-primary {{ $payments->currentPage() == $page ? 'bg-primary-dark text-white' : 'text-primary-dark' }}" 
                           href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                <li class="page-item {{ $payments->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link border-primary text-primary-dark" href="{{ $payments->nextPageUrl() }}">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Tabla de pagos - Diseño profesional -->
    <div class="card border-0 shadow-sm mb-5 overflow-hidden">
        <div class="card-header bg-primary-dark text-white py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="font-size: 1.1rem;">
                    <i class="fas fa-list-alt me-2"></i>Registros de pagos
                </h5>
                <span class="badge bg-white text-primary-dark" style="font-size: 0.8rem;">
                    {{ $payments->total() }} registros
                </span>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-primary-light">
                        <tr>
                            <th class="text-primary-dark py-2">Usuario</th>
                            <th class="text-primary-dark py-2">Membresía</th>
                            <th class="text-primary-dark py-2">Monto</th>
                            <th class="text-primary-dark py-2">Estado</th>
                            <th class="text-primary-dark py-2">Fecha</th>
                            <th class="text-primary-dark py-2">Comprobante</th>
                            <th id="th-comentario" class="text-primary-dark py-2" style="display: none;">Comentario</th>
                            <th id="th-accion" class="text-primary-dark py-2" style="display: none;">Acción</th>
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
                            <td class="py-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary-light text-primary-dark rounded-circle d-flex align-items-center justify-content-center me-2">
                                        {{ substr($payment->user->names, 0, 1) }}{{ substr($payment->user->last_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $payment->user->names }} {{ $payment->user->last_name }}</div>
                                        <small class="text-muted">{{ $payment->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2">
                                <span class="fw-semibold">{{ $payment->membership->name }}</span>
                                <small class="text-muted d-block">({{ $payment->membership->duration }} días)</small>
                            </td>
                            <td class="py-2 fw-semibold">${{ number_format($payment->price, 2) }}</td>
                            <td class="py-2">
                                <span class="badge status-badge">{{ $payment->status->name }}</span>
                            </td>
                            <td class="py-2">
                                <div class="d-flex flex-column">
                                    <span>{{ \Carbon\Carbon::parse($payment->date)->translatedFormat('d M Y') }}</span>
                                    @if($statusClass === 'vencido' && $payment->expiration_date)
                                    <small class="text-danger">
                                        <i class="fas fa-clock me-1"></i>Expiró: {{ \Carbon\Carbon::parse($payment->expiration_date)->translatedFormat('d M Y') }}
                                    </small>
                                    @endif
                                </div>
                            </td>
                            <td class="py-2">
                                <a href="{{ Storage::url($payment->receipt_url) }}" target="_blank" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> Ver
                                </a>
                            </td>
                            <td class="comentario-col py-2" style="{{ $statusClass === 'rechazado' ? '' : 'display:none' }};">
                                <small>{{ $statusClass === 'rechazado' ? ($payment->comment ?? 'Sin comentario') : '' }}</small>
                            </td>
                            <td class="accion-col py-2" style="{{ $statusClass === 'pendiente' ? '' : 'display:none' }};">
                                @if($statusClass === 'pendiente')
                                <form id="form-{{ $payment->id }}" action="{{ route('admin.payments.update', $payment) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex gap-2">
                                        <div class="custom-select-container select-sm">
                                            <select name="status_id" onchange="handleStatusChange(this, {{ $payment->id }})" class="custom-select">
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
                                                    placeholder="Motivo" required>
                                                <button type="submit" class="btn btn-sm btn-danger">
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
                    <a class="page-link border-primary text-primary-dark" href="{{ $payments->previousPageUrl() }}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                
                @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                    <li class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link border-primary {{ $payments->currentPage() == $page ? 'bg-primary-dark text-white' : 'text-primary-dark' }}" 
                        href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                <li class="page-item {{ $payments->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link border-primary text-primary-dark" href="{{ $payments->nextPageUrl() }}">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<style>
    :root {
        --primary-dark: #1A365D;
        --primary-light: #E9F0F7;
        --secondary: #FFC107;
        --danger: #FF6B35;
        --success: #28A745;
    }
    
    .text-primary-dark { color: var(--primary-dark); }
    .bg-primary-dark { background-color: var(--primary-dark); }
    .bg-primary-light { background-color: var(--primary-light); }
    .border-primary { border-color: var(--primary-dark) !important; }
    
    .status-badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
        font-size: 0.8rem;
    }
    
    .pendiente .status-badge { background-color: #FFD166; color: var(--primary-dark); }
    .aprobado .status-badge { background-color: var(--success); color: white; }
    .rechazado .status-badge { background-color: var(--danger); color: white; }
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
        font-size: 1rem;
        color: var(--primary-dark);
        background-color: white;
        border: 1px solid rgba(26, 54, 93, 0.2);
        border-radius: 0.5rem;
        appearance: none;
        transition: all 0.3s ease;
    }
    
    .select-sm .custom-select {
        padding: 0.25rem 1.5rem 0.25rem 0.75rem;
        font-size: 0.9rem;
    }
    
    .custom-select:focus {
        outline: none;
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1);
    }
    
    .custom-select-arrow {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        pointer-events: none;
        color: var(--primary-dark);
        transition: transform 0.2s ease;
    }
    
    .custom-select:focus ~ .custom-select-arrow {
        transform: translateY(-50%) rotate(180deg);
    }
    
    /* Barra de búsqueda profesional */
    .search-container {
        position: relative;
        width: 100%;
        max-width: 300px;
    }
    
    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-dark);
        opacity: 0.7;
        z-index: 10;
    }
    
    .search-input {
        width: 100%;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        font-size: 0.9rem;
        color: var(--primary-dark);
        background-color: white;
        border: 1px solid rgba(26, 54, 93, 0.2);
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1);
    }
    
    .search-border {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--primary-dark);
        transition: width 0.3s ease;
    }
    
    .search-input:focus ~ .search-border {
        width: 100%;
    }
    
    /* Avatar de usuario */
    .avatar-sm {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
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
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }
    
    .pagination-rounded .page-link:hover {
        background-color: rgba(26, 54, 93, 0.1);
    }
    
    /* Botones PDF */
    .btn-primary-dark {
        background-color: var(--primary-dark);
        color: white;
        border: 1px solid var(--primary-dark);
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary-dark {
        color: var(--primary-dark);
        border: 1px solid var(--primary-dark);
        background-color: transparent;
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary-dark:hover {
        background-color: var(--primary-dark);
        color: white;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card-header h5, .alert {
            font-size: 1rem;
        }
        
        .search-container {
            max-width: 100%;
        }
        
        .pagination-rounded .page-link {
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
        }
        
        .custom-select {
            font-size: 0.9rem;
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