@extends('layouts.app-master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Detalles de Membresía</h2>

    <div class="card shadow-sm p-4">
        <h4>{{ $membership->name }}</h4>
        <p><strong>Duración:</strong> {{ $membership->duration }} días</p>
        <p><strong>Precio actual:</strong> ${{ number_format($membership->price, 2) }}</p>
        <p><strong>Descripción:</strong> {{ $membership->description }}</p>

        <hr>

        <h5>Instrucciones para Transferencia:</h5>
        <ul>
            <li><strong>Banco:</strong>BBVA</li>
            <li><strong>CLABE:</strong> 012345678901234567</li>
            <li><strong>Referencia:</strong> Tu nombre completo</li>
        </ul>

        <a href="{{ route('user.payments.upload', $membership->id) }}" class="btn btn-primary mt-3">
            Subir Comprobante
        </a>
    </div>
</div>
@endsection
