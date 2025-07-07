@extends('layouts.app-master')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="container-fluid py-4">
    <!-- Welcome Message -->
    <div class="mb-4 text-center p-4 rounded-3">
        <i class="fas fa-wallet fa-5x mb-3" style="color: #1A365D;"></i>
        <h2 class="fw-bold" style="font-size: 1.8rem; color: #1A365D; margin-bottom: 0.5rem;">
            ¡Bienvenido a tu Historial de Pagos!
        </h2>
        <p style="font-size: 1.6rem; color: #1A365D; opacity: 0.8; margin-bottom: 1.8rem;">
            Revisa el estado de tus transacciones y membresías
        </p>
    </div>

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold" style="font-size: 1.6rem; color: #1A365D; margin-bottom: 0.5rem;">
            <i class="fas fa-history me-2"></i>Mis Pagos
        </h2>
    </div>

    <!-- Filters -->
    <div class="mb-4 filter-buttons">
        <button type="button" class="btn filter-btn pending" id="btn-pending" style="font-size: 1.3rem;">
            <i class="far fa-clock me-2"></i>Pendientes
        </button>
        <button type="button" class="btn filter-btn approved" id="btn-approved" style="font-size: 1.3rem;">
            <i class="fas fa-check-circle me-2"></i>Aprobados
        </button>
        <button type="button" class="btn filter-btn rejected" id="btn-rejected" style="font-size: 1.3rem;">
            <i class="fas fa-times-circle me-2"></i>Rechazados
        </button>
        <button type="button" class="btn filter-btn expired" id="btn-expired" style="font-size: 1.3rem;">
            <i class="fas fa-calendar-times me-2"></i>Vencidos
        </button>
    </div>

    <!-- Tables -->
    <div class="card mb-5 payment-card">
        <!-- Pending Table -->
        <div id="table-pending">
            <div class="card-header payment-card-header">
                <h5 class="mb-0" style="font-size: 1.5rem;"><i class="far fa-clock me-2"></i>Pagos Pendientes</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 payment-table">
                        <thead>
                            <tr>
                                <th style="font-size: 1.3rem;">Membresía</th>
                                <th style="font-size: 1.3rem;">Fecha de Pago</th>
                                <th style="font-size: 1.3rem;">Monto</th>
                                <th style="font-size: 1.3rem;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentsPending as $payment)
                            <tr>
                                <td style="font-size: 1.3rem;">{{ $payment->membership->name ?? 'No disponible' }}</td>
                                <td style="font-size: 1.3rem;">{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                                <td style="font-size: 1.3rem;">${{ number_format($payment->price, 2) }}</td>
                                <td style="font-size: 1.3rem;">
                                    <span class="status-badge pendiente">Pendiente de revisión</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center" style="font-size: 1.3rem;">No hay pagos pendientes.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Approved Table -->
        <div id="table-approved" style="display: none;">
            <div class="card-header payment-card-header">
                <h5 class="mb-0" style="font-size: 1.5rem;"><i class="fas fa-check-circle me-2"></i>Pagos Aprobados</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 payment-table">
                        <thead>
                            <tr>
                                <th style="font-size: 1.3rem;">Membresía</th>
                                <th style="font-size: 1.3rem;">Fecha de Pago</th>
                                <th style="font-size: 1.3rem;">Monto</th>
                                <th style="font-size: 1.3rem;">Fecha de Aprobación</th>
                                <th style="font-size: 1.3rem;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentsApproved as $payment)
                            <tr>
                                <td style="font-size: 1.3rem;">{{ $payment->membership->name ?? 'No disponible' }}</td>
                                <td style="font-size: 1.3rem;">{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                                <td style="font-size: 1.3rem;">${{ number_format($payment->price, 2) }}</td>
                                <td style="font-size: 1.3rem;">{{ $payment->updated_at->format('d/m/Y') }}</td>
                                <td style="font-size: 1.3rem;">
                                    <span class="status-badge aprobado">Aprobado</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center" style="font-size: 1.3rem;">No hay pagos aprobados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Rejected Table -->
        <div id="table-rejected" style="display: none;">
            <div class="card-header payment-card-header">
                <h5 class="mb-0" style="font-size: 1.5rem;"><i class="fas fa-times-circle me-2"></i>Pagos Rechazados</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 payment-table">
                        <thead>
                            <tr>
                                <th style="font-size: 1.3rem;">Membresía</th>
                                <th style="font-size: 1.3rem;">Fecha de Pago</th>
                                <th style="font-size: 1.3rem;">Monto</th>
                                <th style="font-size: 1.3rem;">Motivo de Rechazo</th>
                                <th style="font-size: 1.3rem;">Fecha de Rechazo</th>
                                <th style="font-size: 1.3rem;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentsRejected as $payment)
                            <tr>
                                <td style="font-size: 1.3rem;">{{ $payment->membership->name ?? 'No disponible' }}</td>
                                <td style="font-size: 1.3rem;">{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                                <td style="font-size: 1.3rem;">${{ number_format($payment->price, 2) }}</td>
                                <td style="font-size: 1.3rem; white-space: pre-wrap; max-width: 200px;">{{ $payment->comment ?? 'No especificado' }}</td>
                                <td style="font-size: 1.3rem;">{{ $payment->updated_at->format('d/m/Y') }}</td>
                                <td style="font-size: 1.3rem;">
                                    <span class="status-badge rechazado">Rechazado</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center" style="font-size: 1.3rem;">No hay pagos rechazados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Expired Table -->
        <div id="table-expired" style="display: none;">
            <div class="card-header payment-card-header">
                <h5 class="mb-0" style="font-size: 1.5rem;"><i class="fas fa-calendar-times me-2"></i>Pagos Vencidos</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 payment-table">
                        <thead>
                            <tr>
                                <th style="font-size: 1.3rem;">Membresía</th>
                                <th style="font-size: 1.3rem;">Fecha de Pago</th>
                                <th style="font-size: 1.3rem;">Monto</th>
                                <th style="font-size: 1.3rem;">Fecha de Vencimiento</th>
                                <th style="font-size: 1.3rem;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentsExpired as $payment)
                            <tr>
                                <td style="font-size: 1.3rem;">{{ $payment->membership->name ?? 'No disponible' }}</td>
                                <td style="font-size: 1.3rem;">{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                                <td style="font-size: 1.3rem;">${{ number_format($payment->price, 2) }}</td>
                                <td style="font-size: 1.3rem;">{{ \Carbon\Carbon::parse($payment->expiration_date)->format('d/m/Y') }}</td>
                                <td style="font-size: 1.3rem;">
                                    <span class="status-badge vencido">Vencido</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center" style="font-size: 1.3rem;">No hay pagos vencidos.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btns = {
        pending: document.getElementById('btn-pending'),
        approved: document.getElementById('btn-approved'),
        rejected: document.getElementById('btn-rejected'),
        expired: document.getElementById('btn-expired')
    };

    const tables = {
        pending: document.getElementById('table-pending'),
        approved: document.getElementById('table-approved'),
        rejected: document.getElementById('table-rejected'),
        expired: document.getElementById('table-expired')
    };

    function clearActive() {
        Object.values(btns).forEach(btn => {
            btn.classList.remove('active');
            if(btn.classList.contains('pending')) btn.style.backgroundColor = '#FFD166';
            if(btn.classList.contains('approved')) btn.style.backgroundColor = '#2EC4B6';
            if(btn.classList.contains('rejected')) btn.style.backgroundColor = '#FF6B35';
            if(btn.classList.contains('expired')) btn.style.backgroundColor = '#1A365D';
        });
    }

    function setActive(btn) {
        btn.classList.add('active');
    }

    function hideAllTables() {
        Object.values(tables).forEach(tbl => tbl.style.display = 'none');
    }

    // Event listeners
    btns.pending.addEventListener('click', () => {
        clearActive();
        setActive(btns.pending);
        hideAllTables();
        tables.pending.style.display = '';
    });

    btns.approved.addEventListener('click', () => {
        clearActive();
        setActive(btns.approved);
        hideAllTables();
        tables.approved.style.display = '';
    });

    btns.rejected.addEventListener('click', () => {
        clearActive();
        setActive(btns.rejected);
        hideAllTables();
        tables.rejected.style.display = '';
    });

    btns.expired.addEventListener('click', () => {
        clearActive();
        setActive(btns.expired);
        hideAllTables();
        tables.expired.style.display = '';
    });

    // Mostrar tabla pendiente por defecto
    setActive(btns.pending);
    tables.pending.style.display = '';
});
</script>

<style>
    /* Estilos base */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .filter-btn {
        font-weight: 600;
        padding: 0.6rem 1rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        flex: 0 0 auto;
        width: auto;
        min-width: 150px;
        text-align: center;
        border: 2px solid transparent;
        font-size: 1.3rem;
        cursor: pointer;
    }
    
    .filter-btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .filter-btn.active {
        border-color: #fff;
        box-shadow: 0 0 0 2px rgba(0,0,0,0.2);
    }
    
    .pending {
        background-color: #FFD166;
        color: #1A365D;
    }
    
    .approved {
        background-color: #2EC4B6;
        color: #FFFFFF;
    }
    
    .rejected {
        background-color: #FF6B35;
        color: #FFFFFF;
    }
    
    .expired {
        background-color: #1A365D;
        color: #FFFFFF;
    }
    
    .payment-card {
        border: 2px solid #1A365D;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .payment-card-header {
        background-color: #1A365D;
        color: #FFFFFF;
        border-bottom: 3px solid #FF6B35;
        padding: 1rem 1.5rem;
    }
    
    .payment-card-header h5 {
        margin: 0;
        display: flex;
        align-items: center;
        font-size: 1.5rem;
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 1.1rem;
    }
    
    .pendiente {
        background-color: #FFD166;
        color: #1A365D;
    }
    
    .aprobado {
        background-color: #2EC4B6;
        color: white;
    }
    
    .rechazado {
        background-color: #FF6B35;
        color: white;
    }
    
    .vencido {
        background-color: #d82c0d;
        color: white;
    }

    /* Estilos para tablas */
    .payment-table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #000;
    }
    
    .payment-table th,
    .payment-table td {
        border: 1px solid #000;
        padding: 12px 15px;
        text-align: left;
    }
    
    .payment-table th {
        background-color: #1A365D;
        color: white;
        font-weight: 600;
        font-size: 1.3rem;
    }
    
    .payment-table td {
        font-size: 1.3rem;
    }
    
    .payment-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    .payment-table tbody tr:hover {
        background-color: #e9ecef;
    }
    
    /* Responsividad */
    @media (max-width: 768px) {
        .filter-buttons {
            flex-direction: column;
        }
        
        .filter-btn {
            width: 100%;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }
        
        .payment-table {
            display: block;
            overflow-x: auto;
        }
        
        .payment-table th,
        .payment-table td {
            padding: 8px 10px;
            font-size: 1.1rem;
        }
        
        .payment-card-header h5 {
            font-size: 1.3rem;
        }
        
        .status-badge {
            font-size: 1rem;
        }
    }
</style>
@endsection