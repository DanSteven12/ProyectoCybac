    @extends('layouts.app-master')

    @section('content')
    <div class="container py-4">
        <h2 class="mb-4">Historial de clases</h2>

        @forelse($reservas as $registro)
            @php
                $class = $registro->class;
                $statusName = $class->status?->name ? strtolower($class->status->name) : null;
                $isCanceled = $statusName === 'cancelada';
            @endphp

            <article class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $class->service->name ?? 'Servicio no disponible' }} - {{ $class->description ?? '' }}</h5>
                    
                    <p class="mb-1"><strong>Instructor:</strong> {{ $class->instructor->names ?? 'N/A' }} {{ $class->instructor->last_name ?? '' }}</p>
                    
                    <p class="mb-1">
                        <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($class->date)->format('d/m/Y') }} | 
                        <strong>Hora:</strong> {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}
                    </p>
                    
                    <p class="mb-1">
                        <strong>Estado:</strong>
                        @if($isCanceled)
                            <span class="badge bg-danger">Cancelada</span>
                        @elseif($statusName)
                            <span class="badge bg-success">Asistida</span>
                        @else
                            <span class="text-muted fst-italic">Estado no disponible</span>
                        @endif
                    </p>

                    @if($isCanceled && !empty($class->comment))
                        <p><strong>Motivo de cancelación:</strong> {{ $class->comment }}</p>
                    @endif
                </div>
            </article>
        @empty
            <p class="text-muted fst-italic">No tienes historial de clases aún.</p>
        @endforelse
    </div>
    @endsection
