@extends('layouts.admi-app-master')

@section('content')
    <h1>Crear Membresía</h1>

    <form action="{{ route('admin.memberships.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" 
                      class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">Duración (días)</label>
            <input type="number" name="duration" id="duration" 
                   class="form-control @error('duration') is-invalid @enderror" 
                   value="{{ old('duration', 30) }}" required min="1">
            @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="status_id" class="form-label">Estado</label>
            <select name="status_id" id="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                <option value="">Selecciona un estado</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
            @error('status_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-success">Crear</button>
        <a href="{{ route('admin.memberships.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
