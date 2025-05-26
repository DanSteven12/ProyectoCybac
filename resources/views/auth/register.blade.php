@extends('layouts.auth-master')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<div class="min-vh-100 d-flex align-items-center" style="background-color: #F4F4F4; padding: 1.5rem 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-10">
                <div class="d-none d-md-block" style="height: 1rem;"></div>
                
                <form method="POST" action="{{ route('register') }}" class="card shadow-sm" style="border: none; border-radius: 8px; background-color: #FFFFFF; padding: 2rem; margin-top: 0.5rem;">
                    @csrf
<!-- ENCABEZADO CON LOGO -->
<div class="login-header" style="margin-bottom: 2rem; text-align: center; background-color: #1A365D; padding: 2rem; color: white; border-radius: 12px 12px 0 0; overflow: hidden;">
    <div class="logo-container" style="margin-bottom: 1rem;">
        <img src="{{ asset('images/logo.png') }}" alt="Fitnflow" 
             class="circular-logo" 
             style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem; display: block; border: 3px solid #2EC4B6;">
        <div class="brand-name" style="font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 0.5rem;">
            Fitnflow
        </div>
    </div>
    <p class="tagline" style="color: rgba(255, 255, 255, 0.9); font-size: 0.9rem; margin-bottom: 0;">
        Regístrate para empezar tu viaje fitness
    </p>
</div>

                    <!-- CONTENEDOR FLEX HORIZONTAL PARA CAMPOS -->
                    <div class="form-horizontal-container" style="display: flex; flex-wrap: wrap; gap: 1.5rem;">
                        
                        <!-- Columna izquierda -->
                        <div style="flex: 1 1 45%; min-width: 280px;">
                            <!-- 1. Nombre completo -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; color: #111827; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">1. Nombre completo</label>
                                <div style="display: flex; gap: 1rem;">
                                    <input id="names" type="text" name="names" placeholder="Nombres" required
                                           class="@error('names') is-invalid @enderror"
                                           value="{{ old('names') }}"
                                           style="flex: 1; background-color: #F4F4F4; border: 1px solid #E5E7EB; border-radius: 8px; padding: 0.7rem;">
                                    <input id="last_name" type="text" name="last_name" placeholder="Apellidos" required
                                           class="@error('last_name') is-invalid @enderror"
                                           value="{{ old('last_name') }}"
                                           style="flex: 1; background-color: #F4F4F4; border: 1px solid #E5E7EB; border-radius: 8px; padding: 0.7rem;">
                                </div>
                                @error('names')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- 2. Email -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; color: #111827; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">2. Correo electrónico</label>
                                <input id="email" type="email" name="email" placeholder="ejemplo@correo.com" required
                                       class="@error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       style="background-color: #F4F4F4; border: 1px solid #E5E7EB; border-radius: 8px; padding: 0.7rem; width: 100%;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- 3. Fecha de nacimiento -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; color: #111827; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">3. Fecha de nacimiento</label>
                                <input type="text" id="birth_date" name="birth_date" 
                                       placeholder="Haz clic para seleccionar" readonly required
                                       class="@error('birth_date') is-invalid @enderror"
                                       value="{{ old('birth_date') }}"
                                       style="background-color: #F4F4F4; border: 1px solid #E5E7EB; border-radius: 8px; padding: 0.7rem; width: 100%; cursor: pointer;">
                                @error('fecha_nabirth_dateimiento')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Columna derecha -->
                        <div style="flex: 1 1 45%; min-width: 280px;">
                            <!-- 4. Género -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; color: #111827; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">4. Género</label>
                                <select name="gender" required 
                                        class="@error('gender') is-invalid @enderror"
                                        style="background-color: #F4F4F4; border: 1px solid #E5E7EB; border-radius: 8px; padding: 0.7rem; width: 100%;">
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="Masculino" {{ old('gender') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('gender') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- 5. Contraseña -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; color: #111827; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">5. Contraseña</label>
                                <input id="password" type="password" name="password" placeholder="Mínimo 8 caracteres" required minlength="8"
                                       class="@error('password') is-invalid @enderror"
                                       style="background-color: #F4F4F4; border: 1px solid #E5E7EB; border-radius: 8px; padding: 0.7rem; width: 100%;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- 6. Confirmar contraseña -->
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; color: #111827; font-size: 0.9rem; font-weight: 500; margin-bottom: 0.5rem;">6. Confirmar contraseña</label>
                                <input id="password-confirm" type="password" name="password_confirmation" 
                                       placeholder="Repita su contraseña" required
                                       style="background-color: #F4F4F4; border: 1px solid #E5E7EB; border-radius: 8px; padding: 0.7rem; width: 100%;">
                            </div>
                        </div>
                    </div>

                    <!-- Botón de submit a 100% ancho -->
                    <button type="submit" style="width: 100%; background-color: #FF6B35; color: white; border: none; border-radius: 6px; padding: 0.8rem; font-weight: 500; font-size: 0.95rem; margin-top: 0.5rem;">
                        Completar Registro
                    </button>

                    <!-- Enlace login -->
                    <center>
                        <div class="text-center" style="margin-top: 2rem; padding: 1rem 0 0.5rem;">
                            <a href="/login" class="d-inline-block text-decoration-none custom-link">
                                ¿Ya tienes una cuenta? <span style="font-weight: 600; text-decoration: underline;">Inicia sesión</span>
                            </a>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Flatpickr CSS y JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#birth_date", {
            dateFormat: "Y-m-d",
            locale: "es",
            disableMobile: true,
            maxDate: new Date().fp_incr(-18 * 365),
            altInput: true,
            altFormat: "d/m/Y",
            ariaDateFormat: "d/m/Y",
            onChange: function(selectedDates, dateStr, instance) {
                instance.close();
            }
        });
    });
</script>

<style>
    /* Aquí tus estilos existentes, sin cambios excepto flex horizontal agregado */

    /* Para que el formulario sea responsive y la disposición horizontal se convierta en vertical en móviles */
    @media (max-width: 767.98px) {
        .form-horizontal-container {
            flex-direction: column !important;
        }
    }

    /* El resto de estilos los puedes mantener igual */
     /* Estilos generales */
    body {
        background-color: #F4F4F4 !important;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    input, select, button {
        font-family: inherit;
    }
    
    
    /* Estilos para mensajes de error */
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }
    
    .is-invalid {
        border-color: #dc3545 !important;
    }
    
    /* Ajustes específicos para móviles */
    @media (max-width: 576px) {
        .min-vh-100 {
            padding: 1rem 0 !important;
            align-items: flex-start !important;
        }
        
        .card {
            padding: 1.25rem !important;
            margin-top: 0 !important;
            border-radius: 8px !important;
        }
        
        /* Encabezado con más espacio */
        .text-center {
            margin: 1rem auto 1.5rem !important;
        }
        
        .text-center div {
            padding: 0.7rem !important;
        }
        
        /* Campos nombre/apellido en línea */
        div[style*="display: flex"] {
            flex-direction: row !important;
            gap: 0.75rem !important;
        }
    }

    /* Estilos para desktop */
    @media (min-width: 768px) {
        .min-vh-100 {
            align-items: center !important;
            padding: 2rem 0 !important;
        }
        
        .text-center {
            margin: 1rem auto 2rem !important;
        }
    }

    /* Estilos comunes para inputs */
    input, select {
        background-color: #F4F4F4;
        border: 1px solid #E5E7EB;
        color: #111827;
        border-radius: 6px;
        padding: 0.7rem;
        width: 100%;
        box-sizing: border-box;
        font-size: 0.9rem;
    }

    input:focus, select:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.3);
        background-color: #FFFFFF;
        border-color: #FF6B35;
    }

    button[type="submit"] {
        background-color: #FF6B35;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        padding: 0.8rem;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 0.95rem;
    }

    button[type="submit"]:hover {
        background-color: #E55C2B;
    }
       .custom-link {
        color: #FF6B35 !important;
        font-weight: 500;
        transition: color 0.3s ease;
        position: relative;
    }

    .custom-link:hover {
        color: #E55C2B !important;
        text-decoration: none;
    }

    .custom-link::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #FF6B35;
        left: 0;
        bottom: -2px;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .custom-link:hover::after {
        transform: scaleX(1);
    }

    /* Ajustes al formulario rectangular */
    .card {
        border-radius: 8px !important; /* Bordes más cuadrados */
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; /* Sombra más definida */
    }
</style>