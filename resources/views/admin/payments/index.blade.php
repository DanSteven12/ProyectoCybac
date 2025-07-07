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
            <label for="estado" class="form-label fw-semibold text-primary-dark" style="font-size: 1.4rem">Filtrar por estado:</label>
            <select name="estado" id="estado" class="form-select border-primary" style="font-size: 1.3rem" onchange="this.form.submit()">
                <option value="pendiente" {{ request('estado', 'pendiente') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                <option value="vencido" {{ request('estado') == 'vencido' ? 'selected' : '' }}>Vencido</option>
            </select>
        </div>
    </form>

    <!-- Resumen de totales -->
    @if(request('estado') == 'aprobado')
    <div class="alert bg-primary-dark text-white mb-4" style="font-size: 1.4rem">
        <div class="d-flex justify-content-between">
            <span>Total de ventas: <strong>${{ number_format($payments->sum('price'), 2) }}</strong></span>
            <span>Total de membresías: <strong>{{ $payments->count() }}</strong></span>
        </div>
    </div>
    @endif

   <form action="{{ route('admin.payments.report') }}" method="GET" class="mb-4 card shadow-sm border-0" id="report-form">
    <div class="card-body">
        <input type="hidden" name="estado" value="{{ request('estado', 'pendiente') }}">
        <input type="hidden" name="format" value="pdf">
        <input type="hidden" name="view" value="0" id="view-input">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="mes" class="form-label fw-semibold text-primary-dark" style="font-size: 1.4rem">Mes:</label>
                <select name="mes" id="mes" class="form-select border-primary" style="font-size: 1.3rem" required>
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
                <label for="anio" class="form-label fw-semibold text-primary-dark" style="font-size: 1.4rem">Año:</label>
                <select name="anio" id="anio" class="form-select border-primary" required style="font-size: 1.3rem">
                    @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                        <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-danger btn-sm w-100" style="font-size: 1.3rem; background-color: #FF6B35; border-color: #FF6B35;"
                    onclick="document.getElementById('view-input').value=0">
                    <i class="fas fa-file-download me-1"></i> Descargar PDF
                </button>

                <button type="submit" class="btn btn-outline btn-sm w-100" style="font-size: 1.3rem; color: #FF6B35; border-color: #FF6B35;"
                    onclick="document.getElementById('view-input').value=1; this.form.target='_blank';">
                    <i class="fas fa-eye me-1"></i> Ver PDF
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Barra de búsqueda compacta con animaciones completas -->
<div class="mb-4">
    <form onsubmit="event.preventDefault();" class="d-flex align-items-center" style="gap: 1.3rem;">
        <div class="input-container">
            <input 
                id="search-live"
                class="input-search-compact" 
                type="text" 
                placeholder="Buscar..." 
                autocomplete="off"
                onkeyup="filtrarPagosEnVivo()"/>
        </div>
    </form>
</div>

    <!-- Paginación superior -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="mb-0 text-primary-dark" style="font-size: 1.4rem">
            Mostrando: <strong>{{ ucfirst(request('estado', 'pendiente')) }}</strong>
            @if(request('estado') == 'aprobado')
                (Total: ${{ number_format($payments->sum('price'), 2) }})
            @endif
        </p>
        
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link border-primary text-primary-dark" href="{{ $payments->previousPageUrl() }}" style="font-size: 1.3rem">&laquo;</a>
                </li>
                
                @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                    <li class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link border-primary {{ $payments->currentPage() == $page ? 'bg-primary-dark' : 'text-primary-dark' }}" 
                        href="{{ $url }}" style="font-size: 1.3rem">{{ $page }}</a>
                    </li>
                @endforeach
                
                <li class="page-item {{ $payments->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link border-primary text-primary-dark" href="{{ $payments->nextPageUrl() }}" style="font-size: 1.3rem">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Tabla de pagos -->
<div class="card border-primary shadow-sm mb-5">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="mb-0" style="font-size: 1.4rem">Registros de pagos</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size: 1.3rem">
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
                        <td>{{ $payment->user->names }} {{ $payment->user->last_name }}</td>
                        <td>{{ $payment->membership->name }} ({{ $payment->membership->duration }} días)</td>
                        <td>${{ number_format($payment->price, 2) }}</td>
                        <td>
                            <span class="badge status-badge" style="font-size: 1.3rem">{{ $payment->status->name }}</span>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($payment->date)->translatedFormat('d \d\e F \d\e Y') }}
                            @if($statusClass === 'vencido' && $payment->expiration_date)
                            <br>
                            <small class="text-danger" style="font-size: 1.1rem">
                                Expiró: {{ \Carbon\Carbon::parse($payment->expiration_date)->translatedFormat('d \d\e F \d\e Y') }}
                            </small>
                            @endif
                        </td>
                        <td>
                            <a href="{{ Storage::url($payment->receipt_url) }}" target="_blank" 
                               class="btn btn-sm btn-outline-azul" style="font-size: 1.5rem #FF6B35; border-color: #FF6B35;">
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
                                            class="form-select form-select-sm border-primary" style="font-size: 1.3rem">
                                        <option value="4" selected>Pendiente</option>
                                        <option value="5">Aprobar</option>
                                        <option value="6">Rechazar</option>
                                    </select>
                                    <div id="comment-area-{{ $payment->id }}" class="flex-grow-1" style="display: none;">
                                        <div class="input-group">
                                            <input type="text" name="comment" class="form-control form-control-sm" 
                                                placeholder="Motivo" required style="font-size: 1.3rem">
                                            <button type="submit" class="btn btn-sm btn-danger" style="font-size: 1.3rem">
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

    /* Estilo compacto con animaciones completas */
    .input-search-compact {
    width: 100%;
    max-width: 200px;
    height: 42px;
    padding: 8px 12px;
    font-size: 1.3rem;
    font-family: "Courier New", monospace;
    color: #1A365D;
    background-color: #2EC4B6;
    border: 3px solid #1A365D;
    border-radius: 0;
    outline: none;
    transition: all 0.3s ease;
    box-shadow: 5px 5px 0 #FF6B35;
}

.input-search-compact::placeholder {
    color: rgba(26, 54, 93, 0.6);
    font-size: 1.2rem;
    transition: color 0.3s ease;
}

.input-search-compact:hover {
    transform: translate(-3px, -3px);
    box-shadow: 8px 8px 0 #FF6B35;
}

.input-search-compact:focus {
    background-color: #1A365D;
    color: #fff;
    border-color: #FF6B35;
    box-shadow: 6px 6px 0 #FF6B35;
}

.input-search-compact:focus::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

/* Opcional: si quieres mantener algún efecto visual al escribir */
.input-search-compact:not(:placeholder-shown) {
    font-weight: bold;
    letter-spacing: 0.5px;
    background-color: #1A365D;
    color: #fff;
}

    /* Animaciones completas */
    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-4px) rotate(-3deg); }
        50% { transform: translateX(4px) rotate(3deg); }
        75% { transform: translateX(-4px) rotate(-3deg); }
        100% { transform: translateX(0); }
    }

    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }

    @keyframes glitch {
        0%, 10%, 27%, 35%, 52%, 80%, 100% { transform: none; opacity: 1; }
        7% { transform: skew(-0.8deg, -0.8deg); opacity: 0.8; }
        30% { transform: skew(0.5deg, -0.5deg); opacity: 0.8; }
        55% { transform: skew(-0.8deg, 0.8deg); opacity: 0.8; }
        75% { transform: skew(0.5deg, 0.5deg); opacity: 0.8; }
    }

    @keyframes blink {
        50% { opacity: 0; }
    }

    .pagination .page-link {
        font-size: 1.3rem;
    }

    @media (max-width: 768px) {
        .d-md-flex { flex-direction: column; gap: 1rem; }
        .col-md-4 { margin-bottom: 1rem; }
        
        .input-search-compact {
            max-width: 100%;
            font-size: 1.2rem;
        }
    }
    .btn-outline-azul {
    color: #1A365D;
    border: 5px solid #1A365D;
    background-color: transparent;
    transition: all 0.3s ease;
}

.btn-outline-azul:hover {
    background-color: #1A365D;
    color: #fff;
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
        
        // Usar requestAnimationFrame para animaciones más suaves
        requestAnimationFrame(() => {
            rows.forEach(row => {
                const textoFila = row.textContent.toLowerCase();
                row.style.display = textoFila.includes(searchTerm) ? "" : "none";
            });
        });
    }
</script>
@endsection