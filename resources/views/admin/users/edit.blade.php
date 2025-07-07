@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-2" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0" style="font-weight: 700; font-size: 1.8rem;">
                            <i class="fas fa-user-edit me-2"></i>EDITAR USUARIO
                        </h2>
                    </div>
                </div>

                <div class="card-body p-3">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">
                                <!-- Nombres -->
                                <div class="mb-3">
                                    <label for="names" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Nombres</label>
                                    <input type="text" class="form-control @error('names') is-invalid @enderror" 
                                        id="names" name="names" value="{{ old('names', $user->names) }}" 
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                    @error('names')
                                        <div class="invalid-feedback" style="font-size: 1.2rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Apellidos -->
                                <div class="mb-3">
                                    <label for="last_name" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Apellidos</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                        id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" 
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                    @error('last_name')
                                        <div class="invalid-feedback" style="font-size: 1.2rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        id="email" name="email" value="{{ old('email', $user->email) }}" 
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                    @error('email')
                                        <div class="invalid-feedback" style="font-size: 1.2rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Contraseña (Opcional) -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Contraseña</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        id="password" name="password" 
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;"
                                        placeholder="Dejar en blanco para no cambiar">
                                    @error('password')
                                        <div class="invalid-feedback" style="font-size: 1.2rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Confirmar Contraseña -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" 
                                        id="password_confirmation" name="password_confirmation" 
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;"
                                        placeholder="Confirmar nueva contraseña">
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="col-md-6">
                                <!-- Rol -->
                                <div class="mb-3">
    <label for="rol_id" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Rol</label>
    <select class="form-select @error('rol_id') is-invalid @enderror" id="rol_id" name="rol_id" 
            style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
        <option value="">Seleccione un rol</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ old('rol_id', $user->rol_id) == $role->id ? 'selected' : '' }}>
                {{ $role->name_rol }}
            </option>
        @endforeach
    </select>
    @error('rol_id')
        <div class="invalid-feedback" style="font-size: 1.2rem;">
            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
        </div>
    @enderror
</div>


                                <!-- Estado -->
                                <div class="mb-3">
                                    <label for="status_id" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Estado</label>
                                    <select class="form-select @error('status_id') is-invalid @enderror" id="status_id" name="status_id" 
                                            style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                        <option value="">Seleccione estado</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $user->status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <div class="invalid-feedback" style="font-size: 1.2rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Fecha Nacimiento -->
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Fecha Nacimiento</label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                        id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" 
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                    @error('birth_date')
                                        <div class="invalid-feedback" style="font-size: 1.2rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Género -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold d-block" style="color: #1A365D; font-size: 1.4rem;">Género</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="masculino" 
                                                value="Masculino" {{ $user->gender == 'Masculino' ? 'checked' : '' }} 
                                                style="width: 22px; height: 22px; margin-top: 4px;" required>
                                            <label class="form-check-label fw-bold" for="masculino" style="font-size: 1.3rem; color: #1A365D;">Masculino</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="femenino" 
                                                value="Femenino" {{ $user->gender == 'Femenino' ? 'checked' : '' }} 
                                                style="width: 22px; height: 22px; margin-top: 4px;">
                                            <label class="form-check-label fw-bold" for="femenino" style="font-size: 1.3rem; color: #1A365D;">Femenino</label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="text-danger small mt-2" style="font-size: 1.2rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Sección de Especialidad y Certificación -->
                                <div class="row g-2">
                                    <!-- Especialidad -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="specialty" class="form-label fw-bold mb-1" style="color: #1A365D; font-size: 1.4rem;">
                                                Especialidad
                                            </label>
                                            <input type="text" class="form-control @error('specialty') is-invalid @enderror" 
                                                id="specialty" name="specialty" value="{{ old('specialty', $user->specialty) }}"
                                                style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; 
                                                        font-size: 1.3rem; width: 100%;">
                                            @error('specialty')
                                                <div class="invalid-feedback mt-1" style="font-size: 1.2rem;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Certificación -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="certification" class="form-label fw-bold mb-1" style="color: #1A365D; font-size: 1.4rem;">
                                                Certificación
                                            </label>
                                            <input type="text" class="form-control @error('certification') is-invalid @enderror" 
                                                id="certification" name="certification" value="{{ old('certification', $user->certification) }}"
                                                style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; 
                                                        font-size: 1.3rem; width: 100%;">
                                            @error('certification')
                                                <div class="invalid-feedback mt-1" style="font-size: 1.2rem;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('admin.users.index') }}" class="btn py-1 px-3" 
                            style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 1.3rem; border: 2px solid #1A365D;">
                                <i class="fas fa-times-circle me-1"></i> CANCELAR
                            </a>
                            <button type="submit" class="btn py-1 px-3" 
                                    style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-save me-1"></i> ACTUALIZAR USUARIO
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
        border-radius: 10px;
        overflow: hidden;
        margin-top: 10px;
    }
    
    .container-fluid {
        padding-top: 0.5rem !important;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #FF6B35;
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.25);
    }
    
    .invalid-feedback {
        display: block;
        margin-top: 8px;
        padding: 8px 12px;
        background-color: rgba(255, 107, 53, 0.1);
        border-radius: 6px;
        border-left: 4px solid #FF6B35;
        font-size: 1.2rem;
    }
    
    .btn {
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 0.65rem 1.5rem;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Placeholder más grande */
    ::placeholder {
        font-size: 1.1rem;
        opacity: 0.7;
    }
    
    /* Ajustes para móviles */
    @media (max-width: 768px) {
        .card-header h2 {
            font-size: 1.5rem !important;
        }
        
        .container-fluid {
            padding-top: 0 !important;
        }
        
        .form-label, .form-check-label {
            font-size: 1.3rem !important;
        }
        
        .form-control, .form-select {
            font-size: 1.2rem !important;
            padding: 12px 14px !important;
        }
        
        .btn {
            font-size: 1.2rem !important;
            padding: 0.8rem 1.2rem !important;
        }
        
        .d-flex.gap-3 {
            gap: 1.5rem !important;
        }
        
        .invalid-feedback {
            font-size: 1.1rem !important;
            padding: 10px 12px !important;
        }
        
        .form-check-input {
            width: 20px !important;
            height: 20px !important;
            margin-top: 5px !important;
        }
        
        ::placeholder {
            font-size: 1rem;
        }
    }
    
    /* Reducción general de espacios verticales */
    .row.g-3 {
        row-gap: 0.8rem !important;
    }
    
    .mb-3 {
        margin-bottom: 0.8rem !important;
    }
    
    .card-body {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
</style>

@section('scripts')
<!-- SweetAlert2 para diálogos personalizados -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Include Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    // Validación de formulario
    (function () {
        'use strict'
        
        var forms = document.querySelectorAll('.needs-validation')
        
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                        
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    
    // Enable tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Manejar campos de contraseña
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');
        
        passwordField.addEventListener('input', function() {
            if (passwordField.value === '') {
                confirmPasswordField.required = false;
            } else {
                confirmPasswordField.required = true;
            }
        });
    });
</script>
@endsection