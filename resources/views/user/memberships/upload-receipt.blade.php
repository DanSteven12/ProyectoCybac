@extends('layouts.app-master')

@section('content')
<div class="container mt-5">
    <h2>Subir Comprobante de Pago</h2>

    <form action="{{ route('user.payments.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        <input type="hidden" name="membership_id" value="{{ $membership->id }}">
        <input type="hidden" name="price" value="{{ $membership->price }}">

        <div class="mb-3">
            <label for="receipt" class="form-label">Comprobante de pago</label>
            <input type="file" class="form-control" name="receipt" accept=".pdf,.jpg,.jpeg,.png" required>
        </div>

        <button type="submit" class="btn btn-success">Enviar comprobante</button>
    </form>
</div>
@endsection
