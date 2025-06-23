@extends('layouts.admi-app-master')

@section('content')

<div class="container-fluid py-4">
    <!-- Encabezado mejorado -->
    <div class="mb-4">
        <h2 class="fw-bold text-primary-dark mb-1" style="font-size: 1.8rem;">
            Lista de Pagos
        </h2>
        <p class="text-primary-dark opacity-80" style="font-size: 1.5rem;">
            Gestión de pagos de membresías
        </p>
    </div>

    <!-- Filtro por estado -->
    <form action="{{ route('admin.payments.index') }}" method="GET" class="mb-4 card shadow-sm border-0">
        <div class="card-body">
            <label for="estado" class="form-label fw-semibold text-primary-dark">Filtrar por estado:</label>
            <select name="estado" id="estado" class="form-select border-primary" onchange="this.form.submit()">
                <option value="pendiente" {{ request('estado', 'pendiente') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                <option value="vencido" {{ request('estado') == 'vencido' ? 'selected' : '' }}>Vencido</option>
            </select>
        </div>
    </form>

    <!-- Resumen de totales -->
    @if(request('estado') == 'aprobado')
    <div class="alert bg-primary-dark text-white mb-4">
        <div class="d-flex justify-content-between">
            <span>Total de ventas: <strong>${{ number_format($payments->sum('price'), 2) }}</strong></span>
            <span>Total de membresías: <strong>{{ $payments->count() }}</strong></span>
        </div>
    </div>
    @endif

   <form action="{{ route('admin.payments.report') }}" method="GET" class="mb-4 card shadow-sm border-0">
    <div class="card-body">
        <input type="hidden" name="estado" value="{{ request('estado', 'pendiente') }}">
        <input type="hidden" name="format" value="pdf">
        <input type="hidden" name="view" value="0" id="view-input">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="mes" class="form-label fw-semibold text-primary-dark">Mes:</label>
                <select name="mes" id="mes" class="form-select border-primary" required>
                    @foreach([
                        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                    ] as $numero => $nombre)
                        <option value="{{ $numero }}" {{ $numero == date('n') ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="anio" class="form-label fw-semibold text-primary-dark">Año:</label>
                <select name="anio" id="anio" class="form-select border-primary" required>
                    @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                        <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-danger btn-sm w-100"
                    onclick="document.getElementById('view-input').value=0">
                    <i class="fas fa-file-download me-1"></i> Descargar PDF
                </button>

                <button type="submit" class="btn btn-outline-primary btn-sm w-100"
                    onclick="document.getElementById('view-input').value=1; this.form.target='_blank';">
                    <i class="fas fa-eye me-1"></i> Ver PDF
                </button>
            </div>
        </div>
    </div>
</form>


    <!-- Barra de búsqueda -->
    <div class="mb-4">
        <label for="search" class="form-label fw-semibold text-primary-dark">Buscar usuario:</label>
        <div class="input-group">
            <span class="input-group-text bg-primary-dark text-white">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" id="search" class="form-control border-primary" 
                   placeholder="Escribe para buscar..." onkeyup="filtrarPagos()">
        </div>
    </div>

    <!-- Paginación superior -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0 text-primary-dark">
            Mostrando: <strong>{{ ucfirst(request('estado', 'pendiente')) }}</strong>
            @if(request('estado') == 'aprobado')
                (Total: ${{ number_format($payments->sum('price'), 2) }})
            @endif
        </p>
        
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link border-primary text-primary-dark" href="{{ $payments->previousPageUrl() }}">&laquo;</a>
                </li>
                
                @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                    <li class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link border-primary {{ $payments->currentPage() == $page ? 'bg-primary-dark' : 'text-primary-dark' }}" 
                           href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                <li class="page-item {{ $payments->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link border-primary text-primary-dark" href="{{ $payments->nextPageUrl() }}">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Tabla de pagos -->
<div class="card border-primary shadow-sm mb-5">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="mb-0">Registros de pagos</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-primary-light">
                    <tr>
                        <th class="text-primary-dark">Usuario</th>
                        <th class="text-primary-dark">Membresía</th>
                        <th class="text-primary-dark">Monto</th>
                        <th class="text-primary-dark">Estado</th>
                        <th class="text-primary-dark">Fecha</th>
                        <th class="text-primary-dark">Comprobante</th>
                        <th id="th-comentario" class="text-primary-dark" style="display: none;">Comentario</th>
                        <th id="th-accion" class="text-primary-dark" style="display: none;">Acción</th>
                    </tr>
                </thead>
                <tbody>
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
                        <td>{{ $payment->user->names }} {{ $payment->user->last_name }}</td>
                        <td>{{ $payment->membership->name }} ({{ $payment->membership->duration }} días)</td>
                        <td>${{ number_format($payment->price, 2) }}</td>
                        <td>
                            <span class="badge status-badge">{{ $payment->status->name }}</span>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($payment->date)->translatedFormat('d \d\e F \d\e Y') }}
                            @if($statusClass === 'vencido' && $payment->expiration_date)
                            <br>
                            <small class="text-danger">
                                Expiró: {{ \Carbon\Carbon::parse($payment->expiration_date)->translatedFormat('d \d\e F \d\e Y') }}
                            </small>
                            @endif
                        </td>
                        <td>
                            <a href="{{ Storage::url($payment->receipt_url) }}" target="_blank" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> Ver
                            </a>
                        </td>
                        <td class="comentario-col" style="{{ $statusClass === 'rechazado' ? '' : 'display:none' }};">
                            {{ $statusClass === 'rechazado' ? ($payment->comment ?? 'Sin comentario') : '' }}
                        </td>
                        <td class="accion-col" style="{{ $statusClass === 'pendiente' ? '' : 'display:none' }};">
                            @if($statusClass === 'pendiente')
                            <form id="form-{{ $payment->id }}" action="{{ route('admin.payments.update', $payment) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="d-flex gap-2">
                                    <select name="status_id" onchange="handleStatusChange(this, {{ $payment->id }})" 
                                            class="form-select form-select-sm border-primary">
                                        <option value="4" selected>Pendiente</option>
                                        <option value="5">Aprobar</option>
                                        <option value="6">Rechazar</option>
                                    </select>
                                    <div id="comment-area-{{ $payment->id }}" class="flex-grow-1" style="display: none;">
                                        <div class="input-group">
                                            <input type="text" name="comment" class="form-control form-control-sm" 
                                                   placeholder="Motivo" required>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-times"></i>
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
        {{ $payments->links() }}
    </div>
</div>

<style>
    :root {
        --primary-dark: #1A365D;
        --primary-light: #E9F0F7;
        --secondary: #FFC107;
        --danger: #DC3545;
        --success: #28A745;
    }
    
    .text-primary-dark { color: var(--primary-dark); }
    .bg-primary-dark { background-color: var(--primary-dark); }
    .bg-primary-light { background-color: var(--primary-light); }
    .border-primary { border-color: var(--primary-dark) !important; }
    
    .status-badge {
        padding: 0.35em 0.65em;
        font-size: 0.875em;
        font-weight: 500;
    }
    
    .pendiente .status-badge { background-color: #FFD166; color: var(--primary-dark); }
    .aprobado .status-badge { background-color: var(--success); color: white; }
    .rechazado .status-badge { background-color: var(--danger); color: white; }
    .vencido .status-badge { background-color: #6C757D; color: white; }
    
    .card {
        border-radius: 0.5rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(26, 54, 93, 0.05);
    }
    
    @media (max-width: 768px) {
        .d-md-flex { flex-direction: column; gap: 1rem; }
        .col-md-4 { margin-bottom: 1rem; }
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

    function filtrarPagos() {
        const filter = document.getElementById("search").value.toLowerCase();
        document.querySelectorAll('.payment-row').forEach(row => {
            const usuario = row.cells[0].textContent.toLowerCase();
            row.style.display = usuario.includes(filter) ? '' : 'none';
        });
    }
</script>
@endsection