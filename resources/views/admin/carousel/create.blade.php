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
                        <i class="fas fa-plus-circle me-3"></i>AGREGAR NUEVO SLIDE
                    </h2>
                </div>

                <!-- Cuerpo del Card -->
                <div class="card-body p-4">
                    <!-- Mensajes de error -->
                    @if($errors->any())
                        <div class="alert alert-dismissible fade show mb-4" role="alert" 
                            style="background-color: #FF6B35; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.3rem;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                                <div>
                                    <strong class="fs-5">Error en el formulario:</strong>
                                    <ul class="mb-0 ps-4">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close btn-close-white ms-auto fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <!-- Formulario de Creación -->
                    <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="description" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Descripción</label>
                            <input type="text" name="description" id="description" 
                                class="form-control" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;"
                                value="{{ old('description') }}">
                        </div>

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label for="image" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Imagen <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" required
                                class="form-control" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;">
                            <small class="text-muted" style="font-size: 1.1rem;">Formatos recomendados: JPG, PNG. Tamaño máximo: 5MB</small>
                        </div>

                        <!-- Enlace -->
                        <div class="mb-4">
                            <label for="link_url" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Enlace (opcional)</label>
                            <input type="url" name="link_url" id="link_url" 
                                class="form-control" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;"
                                value="{{ old('link_url') }}" placeholder="https://ejemplo.com">
                        </div>

                        <!-- Orden -->
                        <div class="mb-4">
                            <label for="display_order" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Orden <span class="text-danger">*</span></label>
                            <input type="number" name="display_order" id="display_order" min="0" required
                                class="form-control" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;"
                                value="{{ old('display_order') }}">
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="is_active" class="form-label" style="font-size: 1.4rem; font-weight: 600; color: #1A365D;">Estado</label>
                            <select name="is_active" id="is_active" 
                                class="form-select" style="font-size: 1.3rem; padding: 0.8rem; border: 2px solid #1A365D;">
                                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactivo</option>
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

    .text-danger {
        color: #FF6B35;
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
</style>

@section('scripts')
<script>
    // Validación de imagen antes de subir
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validar tamaño máximo (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('El archivo es demasiado grande. El tamaño máximo permitido es 5MB.');
                e.target.value = '';
            }
            
            // Validar tipo de archivo
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Formato de archivo no válido. Solo se permiten imágenes JPG, PNG o GIF.');
                e.target.value = '';
            }
        }
    });
</script>
@endsection
@endsection