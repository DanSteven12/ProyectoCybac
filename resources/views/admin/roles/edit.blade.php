@extends('layouts.admi-app-master')

@section('content')
<div class="container">
    <h1>Editar Rol: {{ $role->nombre_rol }}</h1>
    
    <form action="{{ route('roles.update', $role) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nombre del Rol</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
               id="name" name="name" value="{{ old('name', $role->name) }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Actualizar
    </button>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
        <i class="fas fa-times"></i> Cancelar
    </a>
</form>

</div>
@endsection