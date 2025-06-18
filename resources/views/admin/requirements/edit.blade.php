@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-xxl-6">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                            <i class="fas fa-edit me-3"></i>EDITAR REQUISITO
                        </h2>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-dismissible fade show mb-4" role="alert" 
                             style="background-color: #FF6B35; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.3rem;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-3 fs-4"></i>
                                <div>
                                    <strong class="fs-5">Error en el formulario:</strong>
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close btn-close-white ms-auto fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('admin.requirements.update', $requirement->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="service_id" class="form-label fw-bold" style="color: #1A365D; font-size: 1.3rem;">Servicio</label>
                            <select class="form-select py-2 px-3 @error('service_id') is-invalid @enderror" 
                                    id="service_id" name="service_id" required
                                    style="border: 2px solid #1A365D; border-radius: 6px; font-size: 1.3rem;">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" 
                                        {{ $service->id == $requirement->service_id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <div class="invalid-feedback" style="font-size: 1.2rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold" style="color: #1A365D; font-size: 1.3rem;">Nombre del Requisito</label>
                            <input type="text" class="form-control py-2 px-3 @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $requirement->name) }}" 
                                   maxlength="50" required
                                   style="border: 2px solid #1A365D; border-radius: 6px; font-size: 1.3rem;">
                            @error('name')
                                <div class="invalid-feedback" style="font-size: 1.2rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-end gap-3 mt-5">
                            <a href="{{ route('admin.requirements.index') }}" class="btn py-2 px-4" 
                               style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-times-circle me-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn py-2 px-4" 
                                    style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-save me-2"></i> Actualizar
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
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #FF6B35;
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.25);
    }
    
    .btn {
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    /* Estilo personalizado para el alert */
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
            font-size: 1.6rem !important;
        }
        
        .btn {
            padding: 0.6rem 1rem !important;
            font-size: 1.1rem !important;
        }
        
        .form-control, .form-select {
            font-size: 1.1rem !important;
            padding: 0.5rem 0.8rem !important;
        }
        
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

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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