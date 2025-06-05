@extends('layouts.admi-app-master')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<style>
    .pendiente { background-color: #fff3cd; } /* Amarillo claro */
    .aprobado { background-color: #d4edda; }  /* Verde claro */
    .rechazado { background-color: #f8d7da; } /* Rojo claro */
    .vencido { background-color: #e2e3e5; color: #6c757d; } /* Gris claro */
</style>

<div class="container mt-4">
    <h2 class="mb-4">Lista de Pagos</h2>

    {{-- Filtros --}}
    <div class="mb-3">
        <button class="btn btn-outline-secondary me-2" onclick="filterPayments('pendiente')">Pendientes</button>
        <button class="btn btn-outline-success me-2" onclick="filterPayments('aprobado')">Aprobados</button>
        <button class="btn btn-outline-danger me-2" onclick="filterPayments('rechazado')">Rechazados</button>
        <button class="btn btn-outline-dark" onclick="filterPayments('vencido')">Vencidos</button>
    </div>

    <table class="table table-bordered table-hover" id="payments-table">
        <thead class="table-dark">
            <tr>
                <th>Usuario</th>
                <th>Membresía</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Comprobante</th>
                <th id="th-comentario">Comentario</th> {{-- Solo se muestra en rechazados --}}
                <th id="th-accion">Acción</th> {{-- Solo se muestra en pendientes --}}
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
                <td>{{ $payment->user->names }} {{ $payment->user->last_name }}</td>
                <td>{{ $payment->membership->name }} ({{ $payment->membership->duration }} días)</td>
                <td>${{ number_format($payment->price, 2) }}</td>
                <td>{{ $statusName }}</td>
                <td>
                    {{ $payment->date }}
                    @if($statusName === 'Vencido' && $payment->expiration_date)
                        <br><small class="text-danger">Expiró: {{ \Carbon\Carbon::parse($payment->expiration_date)->format('d/m/Y') }}</small>
                    @endif
                </td>
                <td>
                    <a href="{{ Storage::url($payment->receipt_url) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        Ver archivo
                    </a>
                </td>

                {{-- Comentario solo en rechazados --}}
                @if($isRechazado)
                <td class="comentario-col">{{ $payment->comment }}</td>
                @else
                <td class="comentario-col" style="display:none;">{{ $payment->comment }}</td> {{-- Mantener celda para tabla pero oculta --}}
                @endif

                {{-- Acción solo en pendientes --}}
                @if($isPendiente)
                <td class="accion-col">
                    <form id="form-{{ $payment->id }}" action="{{ route('admin.payments.update', $payment) }}" method="POST" onsubmit="return validateComment({{ $payment->id }})">
                        @csrf
                        @method('PUT')
                        <select name="status_id" onchange="handleStatusChange(this, {{ $payment->id }})" class="form-select">
                            <option value="4" {{ $payment->status_id == 4 ? 'selected' : '' }}>Pendiente de revisión</option>
                            <option value="5" {{ $payment->status_id == 5 ? 'selected' : '' }}>Aprobado</option>
                            <option value="6" {{ $payment->status_id == 6 ? 'selected' : '' }}>Rechazado</option>
                        </select>
                        <div id="comment-area-{{ $payment->id }}" class="mt-2" style="display: none;">
                            <textarea name="comment" id="comment-{{ $payment->id }}" class="form-control" placeholder="Motivo del rechazo (obligatorio)"></textarea>
                            <button type="submit" class="btn btn-sm btn-danger mt-2">Rechazar</button>
                        </div>
                    </form>
                </td>
                @else
                <td class="accion-col" style="display:none;"></td> {{-- Oculto para mantener estructura --}}
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Por defecto mostrar pendientes
    window.onload = function() {
        filterPayments('pendiente');
    }

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

        if (select.value == 6) { // Rechazado
            if (!comment.value.trim()) {
                alert('Por favor, escribe el motivo del rechazo.');
                comment.focus();
                return false;
            }
        }
        return true;
    }

    function filterPayments(tipo) {
        const allRows = document.querySelectorAll('.payment-row');
        const thAccion = document.getElementById('th-accion');
        const thComentario = document.getElementById('th-comentario');

        allRows.forEach(row => {
            if(row.classList.contains(tipo)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Mostrar u ocultar columna acción (solo pendiente)
        if(tipo === 'pendiente') {
            thAccion.style.display = '';
            allRows.forEach(row => {
                if(row.classList.contains('pendiente')) {
                    let tdAccion = row.querySelector('.accion-col');
                    if(tdAccion) tdAccion.style.display = '';
                }
            });
        } else {
            thAccion.style.display = 'none';
            allRows.forEach(row => {
                let tdAccion = row.querySelector('.accion-col');
                if(tdAccion) tdAccion.style.display = 'none';
            });
        }

        // Mostrar u ocultar columna comentario (solo rechazado)
        if(tipo === 'rechazado') {
            thComentario.style.display = '';
            allRows.forEach(row => {
                if(row.classList.contains('rechazado')) {
                    let tdComentario = row.querySelector('.comentario-col');
                    if(tdComentario) tdComentario.style.display = '';
                }
            });
        } else {
            thComentario.style.display = 'none';
            allRows.forEach(row => {
                let tdComentario = row.querySelector('.comentario-col');
                if(tdComentario) tdComentario.style.display = 'none';
            });
        }
    }
</script>
@endsection

