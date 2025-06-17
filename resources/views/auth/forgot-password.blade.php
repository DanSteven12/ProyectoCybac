@extends('layouts.app-master')

@section('content')
<div class="container">
    <h2>Recuperar Contraseña</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" required autofocus>
            @error('email') <div>{{ $message }}</div> @enderror
        </div>
        <button type="submit">Enviar enlace</button>
    </form>
</div>
@endsection
