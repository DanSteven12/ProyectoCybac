@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
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
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" 
                                        readonly required> <!-- readonly para no dejar editar el email-->
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
                                    <input type="text" class="form-control" 
                                        value="{{ $user->role->name_rol ?? 'No asignado' }}" 
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem; background-color: #f8f9fa;" 
                                        readonly>
                                    <input type="hidden" name="rol_id" value="{{ $user->rol_id }}">
                                </div>


                                <!-- Estado -->
                                <div class="mb-3">
                                    <label for="status_id" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Estado</label>
                                    <select class="form-select @error('status_id') is-invalid @enderror" id="status_id" name="status_id" 
                                            style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                        <option value="">Seleccione estado</option>
                                        @foreach ($statuses as $status)
                                            @if(in_array($status->name, ['Activo', 'Inactivo', 'Pendiente']))
                                                <option value="{{ $status->id }}" {{ $user->status_id == $status->id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <div class="invalid-feedback" style="font-size: 1.2rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Fecha de Nacimiento modificada -->
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Fecha de Nacimiento</label>
                                    <input type="text" class="form-control @error('birth_date') is-invalid @enderror" 
                                        id="birth_date" name="birth_date" 
                                        placeholder="Selecciona tu fecha" readonly
                                        value="{{ old('birth_date', $user->birth_date) }}"
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem; background-color: #FFFFFF; cursor: pointer;">
                                    @error('birth_date')
                                        <div class="invalid-feedback" style="font-size: 1.3rem;">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <small class="text-muted" style="font-size: 1.3rem; color: #1A365D !important;">Debe tener 18 años cumplidos</small>
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

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
    
    /* ESTILOS DEL ALERT - TAMAÑOS AUMENTADOS */
    .alert-error {
        background-color: #FF6B35;
        color: #FFFFFF;
        border-left: 5px solid #1A365D;
        font-size: 1.6rem;
        margin-bottom: 1.5rem;
        padding: 1.5rem 2rem;
        border-radius: 8px;
    }

    .alert-error .alert-icon {
        font-size: 2.5rem;
        margin-right: 1.2rem;
    }

    .alert-error .alert-message strong {
        font-size: 1.8rem;
        display: block;
        margin-bottom: 0.8rem;
    }

    .alert-error ul {
        margin-bottom: 0;
        padding-left: 2.2rem;
    }

    .alert-error li {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .btn-close-white {
        filter: invert(1);
        opacity: 0.8;
        font-size: 2rem;
    }

    /* ESTILOS SWEETALERT2 - TAMAÑOS AUMENTADOS */
    .swal2-popup {
        width: 450px !important;
        border-radius: 10px !important;
        padding: 2rem !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border: 2px solid #1A365D !important;
        background: #FFFFFF !important;
    }
        
    .swal2-title {
        font-size: 1.8rem !important;
        color: #1A365D !important;
        font-weight: 700 !important;
        margin-bottom: 1.2rem !important;
    }
        
    .swal2-content {
        font-size: 1.5rem !important;
        color: #1A365D !important;
        line-height: 1.6;
    }
        
    .swal2-confirm {
        background-color: #1A365D !important;
        color: white !important;
        border: none !important;
        font-size: 1.3rem !important;
        padding: 0.8rem 2.5rem !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
        margin-top: 1rem;
    }
        
    .swal2-icon.swal2-warning {
        color: #FF6B35 !important;
        border-color: #FF6B35 !important;
        transform: scale(1.2);
        margin: 1.2rem auto 0.8rem;
    }
    
    /* ESTILOS PARA EL CALENDARIO */
    .flatpickr-calendar {
        width: 320px !important;
        font-family: 'Poppins', sans-serif !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
        border: 2px solid #1A365D !important;
        border-radius: 8px !important;
    }
    
    .flatpickr-day.selected, 
    .flatpickr-day.selected:hover {
        background: #FF6B35 !important;
        border-color: #FF6B35 !important;
    }
    
    .flatpickr-day.today {
        border-color: #2EC4B6 !important;
    }
    
    .flatpickr-day.today:hover {
        background: #2EC4B6 !important;
        color: white !important;
    }
    
    .flatpickr-months .flatpickr-month {
        background: #1A365D !important;
        color: white !important;
        fill: white !important;
        border-radius: 6px 6px 0 0 !important;
    }
    
    .flatpickr-weekdays {
        background: #1A365D !important;
    }
    
    .flatpickr-weekday {
        color: white !important;
    }
    
    .flatpickr-current-month .flatpickr-monthDropdown-months {
        background: #1A365D !important;
        color: white !important;
    }
    
    .flatpickr-current-month input.cur-year {
        color: white !important;
        font-weight: 600 !important;
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
        
        /* ESTILOS DEL ALERT EN MÓVIL - TAMAÑOS AUMENTADOS */
        .alert-error {
            font-size: 1.8rem;
            padding: 1.8rem 2rem;
        }

        .alert-error .alert-icon {
            font-size: 3rem;
        }

        .alert-error .alert-message strong {
            font-size: 2rem;
        }

        .alert-error li {
            font-size: 1.7rem;
        }

        .btn-close-white {
            font-size: 2.5rem;
        }
        
        .swal2-popup {
            width: 350px !important;
            padding: 1.5rem !important;
        }
        
        .swal2-title {
            font-size: 1.8rem !important;
        }
        
        .swal2-content {
            font-size: 1.5rem !important;
        }
        
        .swal2-confirm {
            font-size: 1.4rem !important;
            padding: 0.8rem 1.8rem !important;
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
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación del formulario
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

                        // Mostrar alerta de campos incompletos
                        Swal.fire({
                            icon: 'warning',
                            title: '<span style="font-size: 1.8rem; color: #1A365D; font-weight: 700;">Campos incompletos</span>',
                            html: '<span style="font-size: 1.5rem; color: #1A365D;">Por favor completa todos los campos obligatorios antes de continuar.</span>',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#1A365D',
                            background: '#FFFFFF',
                            iconColor: '#FF6B35',
                            customClass: {
                                container: 'swal2-container-custom',
                                popup: 'swal2-popup-custom'
                            }
                        });
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Calculamos la fecha exacta de hace 18 años
        const today = new Date();
        const maxDate = new Date(
            today.getFullYear() - 18,
            today.getMonth(),
            today.getDate()
        );

        // Configuración del datepicker modificada
        const birthDatePicker = flatpickr("#birth_date", {
            dateFormat: "Y-m-d",
            locale: "es",
            disableMobile: true,
            maxDate: maxDate,
            minDate: new Date().fp_incr(-100 * 365), // Máximo 100 años
            allowInput: false,
            clickOpens: true,
            defaultDate: "{{ old('birth_date', $user->birth_date) }}", // Usar fecha existente
            onChange: function(selectedDates, dateStr, instance) {
                // Validar edad mínima
                const minAgeDate = new Date();
                minAgeDate.setFullYear(minAgeDate.getFullYear() - 18);
                
                if (selectedDates[0] > minAgeDate) {
                    const errorElement = document.querySelector('#birth_date').nextElementSibling;
                    if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                        errorElement.style.display = 'block';
                        errorElement.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Debes tener al menos 18 años cumplidos';
                    }
                    instance.clear();
                } else {
                    const errorElement = document.querySelector('#birth_date').nextElementSibling;
                    if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                        errorElement.style.display = 'none';
                    }
                }
            },
            onOpen: function(selectedDates, dateStr, instance) {
                // Enfocar el año para facilitar selección
                setTimeout(() => {
                    const yearInput = instance.calendarContainer.querySelector('.numInput.cur-year');
                    if (yearInput) yearInput.focus();
                }, 100);
            }
        });

        // Validación adicional para asegurar 18 años cumplidos
        document.querySelector('form').addEventListener('submit', function(e) {
            const birthDateInput = document.getElementById('birth_date');
            const errorElement = birthDateInput.nextElementSibling;
            
            if (!birthDateInput.value) {
                e.preventDefault();
                if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                    errorElement.style.display = 'block';
                    errorElement.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Por favor selecciona tu fecha de nacimiento';
                }
                return;
            }
            
            const birthDate = new Date(birthDateInput.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            if (age < 18) {
                e.preventDefault();
                if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                    errorElement.style.display = 'block';
                    errorElement.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Debes tener al menos 18 años cumplidos';
                }
                birthDatePicker.open();
            }
        });
        
        // Enable tooltips
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