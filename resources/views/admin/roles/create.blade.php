@extends('layouts.admi-app-master')

@section('content')
<div class="container">
    <h1>Crear Nuevo Rol</h1>
    
    <form action="{{ route('admin.roles.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nombre del Rol</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
               id="name" name="name" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Guardar
    </button>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
        <i class="fas fa-times"></i> Cancelar
    </a>
</form>

</div>
@endsection