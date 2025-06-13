@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-2" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <h2 class="mb-0" style="font-weight: 700; font-size: 1.8rem;">
                        <i class="fas fa-id-card-alt me-2"></i> CREAR MEMBRESÍA
                    </h2>
                </div>

                <div class="card-body p-3">
                    <form action="{{ route('admin.memberships.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Nombre</label>
                            <input type="text" name="name" id="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                            @error('name')
                                <div class="invalid-feedback" style="font-size: 1.0rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Descripción</label>
                            <textarea name="description" id="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback" style="font-size: 1.0rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row g-2">
                            <!-- Precio -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Precio ($)</label>
                                    <input type="number" step="0.01" min="0" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}"
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                    @error('price')
                                        <div class="invalid-feedback" style="font-size: 1.0rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Duración -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="duration" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Duración (días)</label>
                                    <input type="number" name="duration" id="duration" min="1"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        value="{{ old('duration', 30) }}"
                                        style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                    @error('duration')
                                        <div class="invalid-feedback" style="font-size: 1.0rem;">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="status_id" class="form-label fw-bold" style="color: #1A365D; font-size: 1.4rem;">Estado</label>
                            <select name="status_id" id="status_id" 
                                class="form-select @error('status_id') is-invalid @enderror"
                                style="border: 2px solid #1A365D; border-radius: 6px; padding: 10px 14px; font-size: 1.3rem;" required>
                                <option value="">Selecciona un estado</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="invalid-feedback" style="font-size: 1.0rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('admin.memberships.index') }}" class="btn py-1 px-3" 
                                style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 1.3rem; border: 2px solid #1A365D;">
                                <i class="fas fa-times-circle me-1"></i> CANCELAR
                            </a>
                            <button type="submit" class="btn py-1 px-3" 
                                    style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-save me-1"></i> CREAR
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
        margin-top: 10px;
    }
    
    .container-fluid {
        padding-top: 0.5rem !important;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #FF6B35;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    }
    
    .invalid-feedback {
        display: block;
        margin-top: 5px;
        padding: 5px 8px;
        background-color: rgba(255, 107, 53, 0.1);
        border-radius: 5px;
        border-left: 3px solid #FF6B35;
        font-size: 1.0rem;
    }
    
    .btn {
        transition: all 0.2s ease;
        border-radius: 5px;
        padding: 7px 14px;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    /* Ajustes para móviles */
    @media (max-width: 768px) {
        .card-header h2 {
            font-size: 1.3rem !important;
        }
        
        .container-fluid {
            padding-top: 0 !important;
        }
        
        .form-label {
            font-size: 1.1rem !important;
        }
        
        .form-control, .form-select {
            font-size: 1.0rem !important;
            padding: 7px 9px !important;
        }
        
        .btn {
            font-size: 1.0rem !important;
            padding: 6px 12px !important;
        }
        
        .invalid-feedback {
            font-size: 0.95rem !important;
            padding: 4px 6px !important;
        }
    }
    
    /* Espaciado general */
    .mb-3 {
        margin-bottom: 0.9rem !important;
    }
    
    .card-body {
        padding: 1.2rem !important;
    }
</style>

@section('scripts')
<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection