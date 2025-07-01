@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-8">
            <!-- Card Principal -->
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <!-- Header con título -->
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                        <i class="fas fa-edit me-3"></i>EDITAR SLIDE
                    </h2>
                </div>

                <!-- Cuerpo del Card -->
                <div class="card-body p-4">
                    <!-- Mensajes de éxito/error -->
                    @if (session('success'))
                        <div class="alert alert-dismissible fade show mb-4 auto-dismiss-alert" role="alert" 
                            style="background-color: #2EC4B6; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.3rem;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-3 fs-4"></i>
                                <strong class="fs-5">{{ session('success') }}</strong>
                                <button type="button" class="btn-close btn-close-white ms-auto fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario de Edición -->
                    <form action="{{ route('admin.carousel.update', $carousel) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="description" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Descripción</label>
                            <input type="text" name="description" id="description" 
                                class="form-control" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;"
                                value="{{ old('description', $carousel->description) }}">
                        </div>

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Imagen actual</label>
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $carousel->image_path) }}" class="rounded shadow" style="max-height: 200px; max-width: 100%; object-fit: contain;">
                            </div>
                            <label for="image" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Cambiar imagen (opcional)</label>
                            <input type="file" name="image" id="image" 
                                class="form-control" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;">
                        </div>

                        <!-- Enlace -->
                        <div class="mb-4">
                            <label for="link_url" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Enlace (opcional)</label>
                            <input type="url" name="link_url" id="link_url" 
                                class="form-control" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;"
                                value="{{ old('link_url', $carousel->link_url) }}">
                        </div>

                        <!-- Orden -->
                        <div class="mb-4">
                            <label for="display_order" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Orden</label>
                            <input type="number" name="display_order" id="display_order" 
                                class="form-control" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;"
                                min="0" value="{{ old('display_order', $carousel->display_order) }}">
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="is_active" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Estado</label>
                            <select name="is_active" id="is_active" 
                                class="form-select" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;">
                                <option value="1" @if ($carousel->is_active) selected @endif>Activo</option>
                                <option value="0" @if (!$carousel->is_active) selected @endif>Inactivo</option>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-end mt-5">
                            <a href="{{ route('admin.carousel.index') }}" class="btn py-2 px-4 me-3" 
                                style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 1.2rem;">
                                <i class="fas fa-times me-2"></i> CANCELAR
                            </a>
                            <button type="submit" class="btn py-2 px-4" 
                                    style="background-color: #2EC4B6; color: #FFFFFF; font-weight: 600; font-size: 1.2rem;">
                                <i class="fas fa-save me-2"></i> ACTUALIZAR
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
    
    .alert {
        border-radius: 6px;
    }

    .form-label {
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control, .form-select {
        width: 100%;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #FF6B35;
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.25);
    }

    /* Ajustes para móviles */
    @media (max-width: 992px) {
        .card-header h2 {
            font-size: 1.4rem !important;
        }
        
        .btn {
            padding: 0.5rem 1rem !important;
            font-size: 1.1rem !important;
        }
        
        .form-label {
            font-size: 1.2rem !important;
        }
        
        .form-control, .form-select {
            font-size: 1.1rem !important;
            padding: 0.6rem !important;
        }
    }

    /* Estilo del alert de confirmación */
    .swal2-actions {
        gap: 1.5rem !important;
        margin-top: 1.5rem !important;
    }
    
    .swal2-confirm, .swal2-cancel {
        padding: 0.6rem 1.5rem !important;
        margin: 0 !important;
    }

    .swal2-popup { 
        border-radius: 10px !important;
        border: 2px solid #1A365D !important;
        font-size: 1.3rem !important;
    }
    
    .swal2-title {
        color: #1A365D !important;
        font-size: 1.7rem !important;
        font-weight: 700 !important;
    }

    .swal2-icon.swal2-warning {
        color: #FF6B35 !important;
        border-color: #FF6B35 !important;
    }

    .swal2-confirm {
        background-color: #FF6B35 !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
    }

    .swal2-cancel {
        background-color: #2EC4B6 !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
    }
</style>

@section('scripts')
<script>
    // Auto-dismiss alerts after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.auto-dismiss-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 3000);
        });
    });
</script>
@endsection
@endsection