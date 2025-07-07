@extends('layouts.admi-app-master')

@section('content')
<style>
    :root {
        --primary-color: #1A365D;
        --secondary-color: #2EC4B6;
        --accent-color: #FF6B35;
        --light-bg: #F4F4F4;
    }
    
    .card {
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
        border: 2px solid #1A365D;
        width: 100%; /* Asegura que ocupe todo el ancho disponible */
        max-width: 900px; /* Hacemos la tarjeta más ancha */
        margin: 0 auto; /* Centramos la tarjeta */
    }
    
    .card-header {
        background-color: #1A365D;
        color: #FFFFFF;
        border-bottom: 3px solid #FF6B35;
        padding: 0.75rem 1.25rem; /* Más padding para más tamaño */
    }
    
    .form-control, .form-control:focus {
        border: 1.5px solid #1A365D;
        font-size: 0.95rem; /* Texto un poco más grande */
        padding: 0.5rem 0.85rem; /* Más padding para más tamaño */
        height: auto;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.12rem rgba(255, 107, 53, 0.25);
        border-color: #FF6B35;
    }
    
    textarea.form-control {
        min-height: 85px; /* Área de texto más grande */
    }
    
    .btn {
        font-weight: 600;
        transition: all 0.2s ease;
        padding: 0.55rem 1.25rem; /* Botones más grandes */
        border-radius: 4px;
        font-size: 0.95rem; /* Texto más grande */
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
    }
    
    .btn-submit {
        background-color: #2EC4B6 !important; /* !important para asegurar el color */
        color: white !important;
        border: none !important;
    }
    
    .btn-submit:hover {
        background-color: #24a89c !important; /* Color más oscuro al hover */
        color: white !important;
    }
    
    .btn-cancel {
        background-color: white !important;
        color: #1A365D !important;
        border: 2px solid #1A365D !important;
    }
    
    .btn-cancel:hover {
        background-color: #f0f0f0 !important; /* Color claro al hover */
        color: #1A365D !important;
    }
    
    .form-label {
        font-weight: 600;
        color: #1A365D;
        font-size: 0.98rem; /* Texto más grande */
        margin-bottom: 0.3rem;
    }
    
    .card-title {
        font-weight: 700;
        font-size: 1.2rem; /* Título más grande */
        margin: 0;
    }
    
    .required-star {
        color: #e74c3c;
        font-size: 0.95rem;
        vertical-align: super;
    }
    
    .error-feedback {
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .icon-header {
        font-size: 1.2rem;
        margin-right: 6px;
    }
    
    /* Estilos del SweetAlert */
    .swal2-popup {
        width: 400px !important;
        border-radius: 8px !important;
        padding: 1.5rem !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border: 2px solid #1A365D !important;
    }
        
    .swal2-title {
        font-size: 1.2rem !important;
        color: #1A365D !important;
        font-weight: 600 !important;
        margin-bottom: 1rem !important;
    }
        
    .swal2-content {
        font-size: 1rem !important;
        color: #1A365D !important;
    }
        
    .swal2-confirm {
        background-color: #1A365D !important;
        color: white !important;
        border: none !important;
        font-size: 0.9rem !important;
        padding: 0.5rem 1.5rem !important;
        border-radius: 4px !important;
        font-weight: 600 !important;
    }
        
    .swal2-icon {
        width: 3rem !important;
        height: 3rem !important;
        margin: 1rem auto 0.5rem !important;
    }
        
    .swal2-icon.swal2-warning {
        color: #FF6B35 !important;
        border-color: #FF6B35 !important;
    }
    
    @media (max-width: 576px) {
        .swal2-popup {
            width: 300px !important;
            padding: 1rem !important;
        }
        
        .swal2-title {
            font-size: 1.1rem !important;
        }
        
        .swal2-content {
            font-size: 0.9rem !important;
        }
    }
</style>

<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8"> <!-- Cambiado a col-lg-8 para hacer más ancha la tabla -->
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 card-title">
                        <i class="fas fa-plus-circle icon-header"></i>CREAR NUEVO SERVICIO
                    </h3>
                </div>

                <div class="card-body p-3" style="background-color: #F4F4F4;"> <!-- Más padding -->
                    <form method="POST" action="{{ route('admin.service.store') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3"> <!-- Más margen inferior -->
                            <label for="name" class="form-label">
                                {{ __('Nombre del Servicio') }} <span class="required-star">*</span>
                            </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autofocus
                                   placeholder="Ingrese el nombre del servicio">

                            @error('name')
                                <span class="invalid-feedback d-block error-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3"> <!-- Más margen inferior -->
                            <label for="description" class="form-label">
                                {{ __('Descripción del Servicio') }}
                            </label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" 
                                    name="description" rows="4"
                                    placeholder="Describa el servicio en detalle">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback d-block error-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                       <div class="d-flex justify-content-end gap-2 mt-3">
                                <a href="{{ route('admin.service.index') }}" class="btn btn-cancel"> 
                                    <i class="fas fa-times me-1"></i> CANCELAR
                                </a>
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-save me-1"></i> CREAR SERVICIO

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    (function () {
        'use strict';
        var form = document.querySelector('.needs-validation');
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
                    color: '#1A365D'
                });
            }
            form.classList.add('was-validated');
        }, false);
    })();
</script>
@endpush