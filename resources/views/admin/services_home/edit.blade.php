@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                            <i class="fas fa-edit me-3"></i>EDITAR SERVICIO
                        </h2>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.services_home.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Columna izquierda - Formulario -->
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <label for="name" class="block mb-2" style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">
                                        <i class="fas fa-tag me-2"></i>Nombre del Servicio
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" 
                                           class="w-full p-3 border-2 rounded-lg" 
                                           style="border-color: #1A365D; font-size: 1.3rem; color: #1A365D; width: 100%;">
                                    @error('name')
                                        <p class="mt-1" style="color: #FF6B35; font-size: 1.2rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="block mb-2" style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">
                                        <i class="fas fa-align-left me-2"></i>Descripción
                                    </label>
                                    <textarea name="description" id="description" rows="8"
                                              class="w-full p-3 border-2 rounded-lg" 
                                              style="border-color: #1A365D; font-size: 1.3rem; color: #1A365D; width: 100%; min-height: 200px; resize: vertical;">{{ old('description', $service->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1" style="color: #FF6B35; font-size: 1.2rem;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="image_url" class="block mb-2" style="font-size: 1.4rem; color: #1A365D; font-weight: 600;">
                                        <i class="fas fa-image me-2"></i>Nueva Imagen
                                    </label>
                                    <input type="file" name="image_url" id="image_url" 
                                           class="w-full p-3 border-2 rounded-lg" 
                                           style="border-color: #1A365D; font-size: 1.3rem; width: 100%;">
                                    @error('image_url')
                                        <p class="mt-1" style="color: #FF6B35; font-size: 1.2rem;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Columna derecha - Visualización de imagen actual -->
<div class="col-md-4">
    @if($service->image_url)
    <div class="sticky-top" style="top: 20px;">
        <div class="card shadow-sm mb-4" style="border: 2px solid #1A365D;">
            <div class="card-header py-2" style="background-color: #1A365D; color: #FFFFFF;">
                <h3 class="mb-0 text-center" style="font-weight: 600; font-size: 1.4rem;">
                    <i class="fas fa-eye me-2"></i>IMAGEN ACTUAL
                </h3>
            </div>
            <div class="card-body text-center p-3">
                @if(Storage::disk('public')->exists($service->image_url))
                <img src="{{ asset('storage/'.$service->image_url) }}" 
                     class="img-fluid rounded-lg shadow" 
                     style="max-height: 300px; width: auto; border: 2px solid #F4F4F4;"
                     onerror="this.onerror=null;this.src='{{ asset('images/default-service.jpg') }}';">
                <div class="mt-3">
                    <a href="{{ asset('storage/'.$service->image_url) }}" target="_blank" 
                       class="btn py-1 px-3" 
                       style="background-color: #2EC4B6; color: #FFFFFF; font-size: 1.2rem;">
                        <i class="fas fa-expand me-1"></i> Ver Completa
                    </a>
                </div>
                @else
                <div class="alert alert-warning" style="font-size: 1.2rem;">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    La imagen no se encuentra en el almacenamiento
                </div>
                <p class="text-muted mt-2" style="font-size: 1.1rem;">
                    Ruta: storage/{{ $service->image_url }}
                </p>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <a href="{{ route('admin.services_home.index') }}" class="btn py-2 px-4 me-3" 
                               style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-times me-2"></i> CANCELAR
                            </a>
                            <button type="submit" class="btn py-2 px-4" 
                                    style="background-color: #2EC4B6; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-save me-2"></i> GUARDAR CAMBIOS
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
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    
    /* Ajustes para móviles */
    @media (max-width: 992px) {
        .card-header h2 {
            font-size: 1.4rem !important;
        }
        
        .btn {
            padding: 0.4rem 0.8rem !important;
            font-size: 1.0rem !important;
            min-width: auto !important;
        }
        
        label {
            font-size: 1.2rem !important;
        }
        
        input, textarea {
            font-size: 1.1rem !important;
            padding: 0.8rem !important;
        }
        
        .col-md-4 {
            margin-top: 2rem;
        }
    }
</style>
@endsection