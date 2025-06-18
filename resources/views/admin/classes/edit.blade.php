@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-2" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <h2 class="mb-0" style="font-weight: 700; font-size: 1.8rem;">
                        <i class="fas fa-calendar-alt me-2"></i> EDITAR CLASE
                    </h2>
                </div>

                <div class="card-body p-3">
                    <form method="POST" action="{{ route('admin.classes.update', $class->id) }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">
                                <!-- Servicio -->
                                <div class="mb-2">
                                    <label class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Servicio</label>
                                    <select name="service_id" class="form-select @error('service_id') is-invalid @enderror" 
                                            style="border: 2px solid #1A365D; border-radius: 6px; padding: 8px 12px; font-size: 1.3rem;" required>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ $class->service_id == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <div class="invalid-feedback" style="font-size: 0.9rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Instructor -->
                                <div class="mb-2">
                                    <label class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Instructor</label>
                                    <select name="instructor_id" class="form-select @error('instructor_id') is-invalid @enderror" 
                                            style="border: 2px solid #1A365D; border-radius: 6px; padding: 8px 12px; font-size: 1.3rem;" required>
                                        @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}" {{ $class->instructor_id == $instructor->id ? 'selected' : '' }}>
                                                {{ $instructor->names }} {{ $instructor->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('instructor_id')
                                        <div class="invalid-feedback" style="font-size: 0.9rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Hora -->
                                <div class="mb-2">
                                    <label class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Hora</label>
                                    <input type="time" name="time" class="form-control @error('time') is-invalid @enderror" 
                                           value="{{ \Carbon\Carbon::parse($class->time)->format('H:i') }}" 
                                           style="border: 2px solid #1A365D; border-radius: 6px; padding: 8px 12px; font-size: 1.3rem;" required>
                                    @error('time')
                                        <div class="invalid-feedback" style="font-size: 0.9rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="col-md-6">
                                <!-- Estado -->
                                <div class="mb-2">
                                    <label class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Estado</label>
                                    <select name="status_id" class="form-select @error('status_id') is-invalid @enderror" 
                                            style="border: 2px solid #1A365D; border-radius: 6px; padding: 8px 12px; font-size: 1.3rem;" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $class->status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <div class="invalid-feedback" style="font-size: 0.9rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Fecha -->
                                <div class="mb-2">
                                    <label class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Fecha</label>
                                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" 
                                           value="{{ $class->date->format('Y-m-d') }}" 
                                           style="border: 2px solid #1A365D; border-radius: 6px; padding: 8px 12px; font-size: 1.3rem;" required>
                                    @error('date')
                                        <div class="invalid-feedback" style="font-size: 0.9rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Capacidad Máxima -->
                                <div class="mb-2">
                                    <label class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Capacidad Máxima</label>
                                    <input type="number" name="max_capacity" class="form-control @error('max_capacity') is-invalid @enderror" 
                                           value="{{ $class->max_capacity }}" min="1" max="30" 
                                           style="border: 2px solid #1A365D; border-radius: 6px; padding: 8px 12px; font-size: 1.3rem;" required>
                                    @error('max_capacity')
                                        <div class="invalid-feedback" style="font-size: 0.9rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Campos de ancho completo -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Sala -->
                                <div class="mb-2">
                                    <label class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Sala</label>
                                    <input type="text" name="room" class="form-control @error('room') is-invalid @enderror" 
                                           value="{{ $class->room }}" 
                                           style="border: 2px solid #1A365D; border-radius: 6px; padding: 8px 12px; font-size: 1.3rem;" required>
                                    @error('room')
                                        <div class="invalid-feedback" style="font-size: 0.9rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-2">
                            <label class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Descripción</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      style="border: 2px solid #1A365D; border-radius: 6px; padding: 8px 12px; font-size: 1.3rem; height: 80px;" 
                                      required>{{ $class->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback" style="font-size: 0.9rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('admin.classes.index') }}" class="btn py-1 px-3 me-2" 
                               style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 1.3rem; border: 2px solid #1A365D;">
                                <i class="fas fa-times-circle me-1"></i> CANCELAR
                            </a>
                            <button type="submit" class="btn py-1 px-3" 
                                    style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-save me-1"></i> ACTUALIZAR CLASE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 8px;
        overflow: hidden;
        margin-top: 5px;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #FF6B35;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    }
    
    .invalid-feedback {
        display: block;
        margin-top: 3px;
        padding: 3px 6px;
        background-color: rgba(255, 107, 53, 0.1);
        border-radius: 4px;
        border-left: 3px solid #FF6B35;
        font-size: 0.85rem;
    }
    
    .btn {
        transition: all 0.2s ease;
        border-radius: 5px;
        padding: 6px 12px;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    
    /* Estilos para el alert de validación */
    .swal2-popup.custom-alert {
        border: 3px solid #1A365D;
        font-size: 1.4rem;
        border-radius: 12px;
        padding: 1.5rem;
    }

    .swal2-title {
        font-size: 1.6rem !important;
        color: #1A365D !important;
    }

    .swal2-html-container {
        font-size: 1.4rem !important;
        color: #1A365D !important;
    }

    .swal2-confirm {
        font-size: 1.3rem !important;
        padding: 0.6rem 1.4rem !important;
        background-color: #1A365D !important;
    }

    .swal2-icon.swal2-warning {
        color: #FF6B35 !important;
        border-color: #FF6B35 !important;
    }
    
    /* Ajustes para móviles */
    @media (max-width: 768px) {
        .card-header h2 {
            font-size: 1.3rem !important;
        }
        
        .form-label {
            font-size: 1.0rem !important;
        }
        
        .form-control, .form-select, textarea {
            font-size: 0.9rem !important;
            padding: 6px 10px !important;
        }
        
        .btn {
            font-size: 1.0rem !important;
            padding: 5px 10px !important;
        }
        
        .invalid-feedback {
            font-size: 0.8rem !important;
            padding: 2px 4px !important;
        }
        
        /* Ajustes para el alert en móviles */
        .swal2-popup.custom-alert {
            font-size: 1.2rem !important;
            padding: 1rem !important;
        }
        
        .swal2-title {
            font-size: 1.4rem !important;
        }
        
        .swal2-html-container {
            font-size: 1.2rem !important;
        }
        
        .swal2-confirm {
            font-size: 1.1rem !important;
            padding: 0.5rem 1.2rem !important;
        }
    }
</style>

@section('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Campos incompletos',
                        text: 'Por favor completa todos los campos obligatorios antes de continuar.',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#1A365D',
                        background: '#FFFFFF',
                        iconColor: '#FF6B35',
                        color: '#1A365D',
                        customClass: {
                            popup: 'custom-alert'
                        }
                    });
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection