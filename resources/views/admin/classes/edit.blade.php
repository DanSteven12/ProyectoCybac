@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Editar Clase</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.classes.update', $class->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Servicio</label>
                                <select name="service_id" class="form-select" required>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" 
                                            {{ $class->service_id == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Estado</label>
                                <select name="status_id" class="form-select" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" 
                                            {{ $class->status_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Instructor</label>
                                <select name="instructor_id" class="form-select" required>
                                    @foreach($instructors as $instructor)
                                         <option value="{{ $instructor->id }}">{{ $instructor->names }} {{ $instructor->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fecha</label>
                                <input type="date" name="date" class="form-control" 
                                       value="{{ $class->date->format('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Hora</label>
                                <input type="time" name="time" 
                                value="{{ \Carbon\Carbon::parse($class->time)->format('H:i') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Capacidad Máxima</label>
                                <input type="number" name="max_capacity" class="form-control" 
                                       value="{{ $class->max_capacity }}" min="1" max="30" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Sala</label>
                                <input type="text" name="room" class="form-control" 
                                       value="{{ $class->room }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" rows="3" required>{{ $class->description }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary me-2">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Actualizar Clase
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection