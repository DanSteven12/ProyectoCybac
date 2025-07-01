@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                            <i class="fas fa-plus-circle me-3"></i>CREAR NUEVO SERVICIO
                        </h2>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.services_home.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block mb-2" style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">
                                <i class="fas fa-tag me-2"></i>Nombre del Servicio
                            </label>
                            <input type="text" name="name" id="name" 
                                   class="w-full p-3 border-2 rounded-lg" 
                                   style="border-color: #1A365D; font-size: 1.3rem; color: #1A365D; width: 100%;"
                                   required>
                            @error('name')
                                <p class="mt-1" style="color: #FF6B35; font-size: 1.2rem;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block mb-2" style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">
                                <i class="fas fa-align-left me-2"></i>Descripción
                            </label>
                            <textarea name="description" id="description" rows="5"
                                      class="w-full p-3 border-2 rounded-lg" 
                                      style="border-color: #1A365D; font-size: 1.3rem; color: #1A365D; width: 100%; min-height: 150px; resize: vertical;"
                                      required></textarea>
                            @error('description')
                                <p class="mt-1" style="color: #FF6B35; font-size: 1.2rem;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image_url" class="block mb-2" style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">
                                <i class="fas fa-image me-2"></i>Imagen del Servicio
                            </label>
                            <input type="file" name="image_url" id="image_url" 
                                   class="w-full p-3 border-2 rounded-lg" 
                                   style="border-color: #1A365D; font-size: 1.3rem;"
                                   required>
                            @error('image_url')
                                <p class="mt-1" style="color: #FF6B35; font-size: 1.2rem;">{{ $message }}</p>
                            @enderror
                            <p class="mt-2" style="font-size: 1.2rem; color: #1A365D;">
                                <i class="fas fa-info-circle me-2"></i>Formatos aceptados: JPEG, PNG, JPG. Tamaño máximo: 2MB
                            </p>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <a href="{{ route('admin.services_home.index') }}" class="btn py-2 px-4 me-3" 
                               style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-times me-2"></i> CANCELAR
                            </a>
                            <button type="submit" class="btn py-2 px-4" 
                                    style="background-color: #2EC4B6; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-save me-2"></i> CREAR SERVICIO
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
    
    .btn {
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        
        label {
            font-size: 1.2rem !important;
        }
        
        input, textarea {
            font-size: 1.1rem !important;
            padding: 0.8rem !important;
        }
    }
</style>
@endsection