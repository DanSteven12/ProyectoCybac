@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="fw-bold" style="font-size: 1.8rem; color: #1A365D; margin-bottom: 0.5rem;">
            Lista de Pagos
        </h2>
        <p style="font-size: 1.5rem; color: #1A365D; opacity: 0.8; margin-bottom: 1.8rem;">
            Gestión de pagos de membresías
        </p>
    </div>

    {{-- Filtros --}}
    <div class="mb-4 filter-buttons">
        <button class="btn filter-btn pending" onclick="filterPayments('pendiente')" style="font-size: 1.3rem;">
            Pendientes
        </button>
        <button class="btn filter-btn approved" onclick="filterPayments('aprobado')" style="font-size: 1.3rem;">
            Aprobados
        </button>
        <button class="btn filter-btn rejected" onclick="filterPayments('rechazado')" style="font-size: 1.3rem;">
            Rechazados
        </button>
        <button class="btn filter-btn expired" onclick="filterPayments('vencido')" style="font-size: 1.3rem;">
            Vencidos
        </button>
    </div>

    <div class="card mb-5 payment-card">
        <div class="card-header payment-card-header">
            <h5 class="mb-0" style="font-size: 1.5rem;">Registros de pagos</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 payment-table" style="border-collapse: collapse; border: 2px solid #000;">
                    <thead>
                        <tr>
                            <th style="background-color: #1A365D; color: white; padding: 12px 10px; border: 1px solid #000; font-size: 1.4rem;">Usuario</th>
                            <th style="background-color: #1A365D; color: white; padding: 12px 10px; border: 1px solid #000; font-size: 1.4rem;">Membresía</th>
                            <th style="background-color: #1A365D; color: white; padding: 12px 10px; border: 1px solid #000; font-size: 1.4rem;">Monto</th>
                            <th style="background-color: #1A365D; color: white; padding: 12px 10px; border: 1px solid #000; font-size: 1.4rem;">Estado</th>
                            <th style="background-color: #1A365D; color: white; padding: 12px 10px; border: 1px solid #000; font-size: 1.4rem;">Fecha</th>
                            <th style="background-color: #1A365D; color: white; padding: 10px 10px; border: 1px solid #000; font-size: 1.4rem;">Comprobante</th>
                            <th id="th-comentario" style="background-color: #1A365D; color: white; padding: 12px 10px; border: 1px solid #000; font-size: 1.4rem; display: none;">Comentario</th>
                            <th id="th-accion" style="background-color: #1A365D; color: white; padding: 12px 10px; border: 1px solid #000; font-size: 1.4rem; display: none;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        @php
                            $statusName = $payment->status->name;
                            $statusClass = '';
                            if($statusName === 'Pendiente de revisión') $statusClass = 'pendiente';
                            else if($statusName === 'Aprobado') $statusClass = 'aprobado';
                            else if($statusName === 'Rechazado') $statusClass = 'rechazado';
                            else if($statusName === 'Vencido') $statusClass = 'vencido';

                            $isPendiente = $statusName === 'Pendiente de revisión';
                            $isRechazado = $statusName === 'Rechazado';
                        @endphp
                        <tr class="payment-row {{ $statusClass }}">
                            <td style="padding: 12px 10px; border: 1px solid #000; font-size: 1.3rem;">{{ $payment->user->names }} {{ $payment->user->last_name }}</td>
                            <td style="padding: 12px 10px; border: 1px solid #000; font-size: 1.3rem;">{{ $payment->membership->name }} ({{ $payment->membership->duration }} días)</td>
                            <td style="padding: 12px 10px; border: 1px solid #000; font-size: 1.3rem;">${{ number_format($payment->price, 2) }}</td>
                            <td style="padding: 12px 10px; border: 1px solid #000; font-size: 1.3rem;">
                                <span class="status-badge">{{ $statusName }}</span>
                            </td>
                            <td style="padding: 12px 10px; border: 1px solid #000; font-size: 1.3rem;">
                                {{ \Carbon\Carbon::parse($payment->date)->translatedFormat('d \d\e F \d\e Y') }}
                                @if($statusName === 'Vencido' && $payment->expiration_date)
                                <br>
                                    <small style="color: #dc3545; font-size: 1.1rem;">
                                                Expiró: {{ \Carbon\Carbon::parse($payment->expiration_date)->translatedFormat('d \d\e F \d\e Y') }}
                                        </small>
                                    @endif
                            </td>

                            <td style="padding: 12px 10px; border: 1px solid #000; font-size: 1.3rem;">
                                <a href="{{ Storage::url($payment->receipt_url) }}" target="_blank" class="btn btn-sm receipt-btn" style="font-size: 1.3rem;">
                                    Ver archivo
                                </a>
                            </td>

                            {{-- Comentario solo en rechazados --}}
                            <td class="comentario-col" style="padding: 12px 10px; border: 1px solid #000; font-size: 1.3rem; {{ $isRechazado ? '' : 'display:none' }};">
                                {{ $isRechazado ? $payment->comment : '' }}
                            </td>

                            {{-- Acción solo en pendientes --}}
                            <td class="accion-col" style="padding: 12px 10px; border: 1px solid #000; font-size: 1.3rem; {{ $isPendiente ? '' : 'display:none' }};">
                                @if($isPendiente)
                                <form id="form-{{ $payment->id }}" action="{{ route('admin.payments.update', $payment) }}" method="POST" onsubmit="return validateComment({{ $payment->id }})">
                                    @csrf
                                    @method('PUT')
                                    <select name="status_id" onchange="handleStatusChange(this, {{ $payment->id }})" class="form-select status-select" style="font-size: 1.3rem;">
                                        <option value="4" {{ $payment->status_id == 4 ? 'selected' : '' }}>Pendiente de revisión</option>
                                        <option value="5" {{ $payment->status_id == 5 ? 'selected' : '' }}>Aprobado</option>
                                        <option value="6" {{ $payment->status_id == 6 ? 'selected' : '' }}>Rechazado</option>
                                    </select>
                                    <div id="comment-area-{{ $payment->id }}" class="mt-2 comment-area" style="display: none;">
                                        <textarea name="comment" id="comment-{{ $payment->id }}" class="form-control comment-textarea" 
                                                placeholder="Motivo del rechazo (obligatorio)" style="font-size: 1.3rem;"></textarea>
                                        <button type="submit" class="btn btn-sm mt-2 reject-btn" style="font-size: 1.3rem;">
                                            Rechazar
                                        </button>
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
</div>

<script>
    // Por defecto mostrar pendientes
    document.addEventListener('DOMContentLoaded', function() {
        filterPayments('pendiente');
    });

    function handleStatusChange(select, id) {
        const value = select.value;
        const commentArea = document.getElementById('comment-area-' + id);

        if (value == 6) {
            commentArea.style.display = 'block';
        } else {
            commentArea.style.display = 'none';
            select.form.submit();
        }
    }

    function validateComment(id) {
        const select = document.querySelector(`#form-${id} select[name="status_id"]`);
        const comment = document.getElementById(`comment-${id}`);

        if (select.value == 6 && !comment.value.trim()) {
            alert('Por favor, escribe el motivo del rechazo.');
            comment.focus();
            return false;
        }
        return true;
    }

    function filterPayments(tipo) {
        const allRows = document.querySelectorAll('.payment-row');
        const thAccion = document.getElementById('th-accion');
        const thComentario = document.getElementById('th-comentario');

        allRows.forEach(row => {
            row.style.display = row.classList.contains(tipo) ? '' : 'none';
        });

        // Mostrar/ocultar columnas según el filtro
        thAccion.style.display = tipo === 'pendiente' ? '' : 'none';
        thComentario.style.display = tipo === 'rechazado' ? '' : 'none';

        // Mostrar/ocultar celdas específicas
        allRows.forEach(row => {
            const accionCol = row.querySelector('.accion-col');
            const comentarioCol = row.querySelector('.comentario-col');
            
            if (accionCol) accionCol.style.display = tipo === 'pendiente' && row.classList.contains('pendiente') ? '' : 'none';
            if (comentarioCol) comentarioCol.style.display = tipo === 'rechazado' && row.classList.contains('rechazado') ? '' : 'none';
        });
    }
</script>

<style>
    /* Estilos base */
    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .filter-btn {
        font-weight: 600;
        padding: 0.6rem 1rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        /* Cambiamos estas propiedades: */
        flex: 0 0 auto; /* Eliminamos el crecimiento automático */
        width: auto; /* Ancho según contenido */
        min-width: 150px; /* Reducimos el mínimo ancho */
        text-align: center;
        border: 2px solid transparent;
    }
    
    /* Resto de tus estilos permanecen igual */
    .pending {
        background-color: #FFD166;
        color: #1A365D;
    }
    
    .approved {
        background-color: #2EC4B6;
        color: #FFFFFF;
        border-color: #2EC4B6;
    }
    
    .rejected {
        background-color: #FF6B35;
        color: #FFFFFF;
        border-color: #FF6B35;
    }
    
    .expired {
        background-color: #1A365D;
        color: #FFFFFF;
        border-color: #1A365D;
    }
    
    .payment-card {
        border: 2px solid #1A365D;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .payment-card-header {
        background-color: #1A365D;
        color: #FFFFFF;
        border-bottom: 3px solid #FF6B35;
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .pendiente .status-badge {
        background-color: #FFD166;
        color: #1A365D;
    }
    
    .aprobado .status-badge {
        background-color: #2EC4B6;
        color: white;
    }
    
    .rechazado .status-badge {
        background-color: #FF6B35;
        color: white;
    }
    
    .vencido .status-badge {
        background-color: #d82c0d;
        color: white;
    }
    
    .receipt-btn {
        background-color: #1A365D;
        color: #FFFFFF;
        border: 1px solid #1A365D;
        padding: 0.25rem 0.5rem;
    }
    
    .status-select {
        border: 2px solid #1A365D;
        width: 100%;
    }
    
    .comment-textarea {
        border: 2px solid #1A365D;
        width: 100%;
    }
    
    .reject-btn {
        background-color: #FF6B35;
        color: #FFFFFF;
        border: 1px solid #FF6B35;
        padding: 0.25rem 0.5rem;
    }
    
    /* Media queries para responsividad */
    @media (max-width: 768px) {
        .filter-buttons {
            flex-direction: column;
        }
        
        .filter-btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }
</style>
@endsection