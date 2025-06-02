@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="content">
        <br>
        <!-- Welcome Message -->
        <div id="welcome-message" class="text-center p-5 bg-light rounded-3 shadow-sm mb-4">
            <i class="fas fa-credit-card fa-5x icon-custom-color mb-3"></i>
            <h2 class="h4 text-dark fw-bold">¡Bienvenido a tu Historial de Pagos!</h2>
            <p class="text-muted">Revisa el estado de tus transacciones y membresías.</p>
        </div>

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="h2 text-dark fw-bold"><i class="fas fa-history me-2"></i>Mis Pagos</h1>
        </div>

        <!-- Filters -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <button type="button" class="btn btn-lg btn-outline-custom w-100 rounded-pill shadow-sm active" id="btn-pending">
                    <i class="far fa-clock me-2"></i>Pendientes
                </button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-lg btn-outline-custom w-100 rounded-pill shadow-sm" id="btn-approved">
                    <i class="fas fa-check-circle me-2"></i>Aprobados
                </button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-lg btn-outline-custom w-100 rounded-pill shadow-sm" id="btn-rejected">
                    <i class="fas fa-times-circle me-2"></i>Rechazados
                </button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-lg btn-outline-custom w-100 rounded-pill shadow-sm" id="btn-expired">
                    <i class="fas fa-calendar-times me-2"></i>Vencidos
                </button>
            </div>
        </div>

        <!-- Tables -->
        <div class="card shadow-lg border-0">
            <!-- Pending Table -->
            <div id="table-pending">
                <div class="card-header" style="background-color: #0A2647; color: #FFC107;">
                    <h5 class="mb-0 fw-bold"><i class="far fa-clock me-2"></i>Pagos Pendientes</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Membresía</th>
                                <th>Fecha de Pago</th>
                                <th>Monto</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse($paymentsPending as $payment)
                            <tr>
                                <td>{{ $payment->membership->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                                <td>${{ number_format($payment->price, 2) }}</td>
                                <td>{{ ucfirst($payment->status->name) }}</td>
                            </tr>
                           @empty
                            <tr><td colspan="4" class="text-center">No hay pagos pendientes.</td></tr>
                           @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Approved Table -->
            <div id="table-approved" style="display: none;">
                <div class="card-header" style="background-color: #0A2647; color: #FFC107;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-check-circle me-2"></i>Pagos Aprobados</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Membresía</th>
                                <th>Fecha de Pago</th>
                                <th>Monto</th>
                                <th>Fecha de Aprobación</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentsApproved as $payment)
                            <tr>
                                <td>{{ $payment->membership->name ?? 'No disponible' }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                                <td>${{ number_format($payment->price, 2) }}</td>
                                <td>{{ $payment->updated_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-success text-white rounded-pill py-2 px-3">
                                        {{ ucfirst($payment->status->name) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center">No hay pagos aprobados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Rejected Table -->
            <div id="table-rejected" style="display: none;">
                <div class="card-header" style="background-color: #0A2647; color: #FFC107;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-times-circle me-2"></i>Pagos Rechazados</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Membresía</th>
                                <th>Fecha de Pago</th>
                                <th>Monto</th>
                                <th>Motivo de Rechazo</th>
                                <th>Fecha de Rechazo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentsRejected as $payment)
                            <tr>
                                <td>{{ $payment->membership->name ?? 'No disponible' }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                                <td>${{ number_format($payment->price, 2) }}</td>
                                <td style="white-space: pre-wrap; word-wrap: break-word; max-width: 200px;">
                                    {{ $payment->comment ?? 'No especificado' }}
                                </td>
                                <td>{{ $payment->updated_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-danger text-white rounded-pill py-2 px-3">
                                        {{ ucfirst($payment->status->name) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center">No hay pagos rechazados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Expired Table -->
            <div id="table-expired" style="display: none;">
                <div class="card-header" style="background-color: #0A2647; color: #FFC107;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-calendar-times me-2"></i>Pagos Vencidos</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Membresía</th>
                                <th>Fecha de Pago</th>
                                <th>Monto</th>
                                <th>Fecha de Vencimiento</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentsExpired as $payment)
                            <tr>
                                <td>{{ $payment->membership->name ?? 'No disponible' }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                                <td>${{ number_format($payment->price, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->expiration_date)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-secondary text-white rounded-pill py-2 px-3">
                                        {{ ucfirst($payment->status->name) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center">No hay pagos vencidos.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script para alternar tablas -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnPending = document.getElementById('btn-pending');
    const btnApproved = document.getElementById('btn-approved');
    const btnRejected = document.getElementById('btn-rejected');
    const btnExpired = document.getElementById('btn-expired');

    const tablePending = document.getElementById('table-pending');
    const tableApproved = document.getElementById('table-approved');
    const tableRejected = document.getElementById('table-rejected');
    const tableExpired = document.getElementById('table-expired');

    function clearActive() {
        btnPending.classList.remove('active');
        btnApproved.classList.remove('active');
        btnRejected.classList.remove('active');
        btnExpired.classList.remove('active');
    }

    btnPending.addEventListener('click', () => {
        clearActive();
        btnPending.classList.add('active');
        tablePending.style.display = '';
        tableApproved.style.display = 'none';
        tableRejected.style.display = 'none';
        tableExpired.style.display = 'none';
    });

    btnApproved.addEventListener('click', () => {
        clearActive();
        btnApproved.classList.add('active');
        tablePending.style.display = 'none';
        tableApproved.style.display = '';
        tableRejected.style.display = 'none';
        tableExpired.style.display = 'none';
    });

    btnRejected.addEventListener('click', () => {
        clearActive();
        btnRejected.classList.add('active');
        tablePending.style.display = 'none';
        tableApproved.style.display = 'none';
        tableRejected.style.display = '';
        tableExpired.style.display = 'none';
    });

    btnExpired.addEventListener('click', () => {
        clearActive();
        btnExpired.classList.add('active');
        tablePending.style.display = 'none';
        tableApproved.style.display = 'none';
        tableRejected.style.display = 'none';
        tableExpired.style.display = '';
    });
});
</script>

<style>
    .btn-outline-custom {
        color: #0A2647;
        border-color: #FFC107;
    }
    .btn-outline-custom:hover,
    .btn-outline-custom.active {
        background-color: #FFC107;
        color: #0A2647;
    }
    .icon-custom-color {
        color: #FFC107;
    }
</style>

@endsection
