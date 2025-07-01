@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-8">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <h2 class="mb-0" style="font-weight: 700; font-size: 1.8rem;">
                        <i class="fas fa-edit me-2"></i>EDITAR INFORMACIÓN DEL CENTRO
                    </h2>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.center-information.update', $centerInformation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="schedule" class="block mb-2" style="font-size: 1.3rem; color: #1A365D; font-weight: 600;">
                                <i class="fas fa-clock me-2"></i>Horario
                            </label>
                            <textarea name="schedule" id="schedule" rows="4" 
                                      class="w-full p-3 border-2 rounded-lg" 
                                      style="border-color: #1A365D; font-size: 1.2rem; color: #1A365D; min-height: 100px;">{{ old('schedule', $centerInformation->schedule) }}</textarea>
                            @error('schedule')
                                <p class="mt-1" style="color: #FF6B35; font-size: 1.1rem;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block mb-2" style="font-size: 1.3rem; color: #1A365D; font-weight: 600;">
                                <i class="fas fa-phone me-2"></i>Teléfono
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $centerInformation->phone) }}" 
                                   class="w-full p-3 border-2 rounded-lg" 
                                   style="border-color: #1A365D; font-size: 1.2rem; color: #1A365D;">
                            @error('phone')
                                <p class="mt-1" style="color: #FF6B35; font-size: 1.1rem;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block mb-2" style="font-size: 1.3rem; color: #1A365D; font-weight: 600;">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $centerInformation->email) }}" 
                                   class="w-full p-3 border-2 rounded-lg" 
                                   style="border-color: #1A365D; font-size: 1.2rem; color: #1A365D;">
                            @error('email')
                                <p class="mt-1" style="color: #FF6B35; font-size: 1.1rem;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block mb-2" style="font-size: 1.3rem; color: #1A365D; font-weight: 600;">
                                <i class="fas fa-map-marker-alt me-2"></i>Dirección
                            </label>
                            <input type="text" name="address" id="address" value="{{ old('address', $centerInformation->address) }}" 
                                   class="w-full p-3 border-2 rounded-lg" 
                                   style="border-color: #1A365D; font-size: 1.2rem; color: #1A365D;">
                            @error('address')
                                <p class="mt-1" style="color: #FF6B35; font-size: 1.1rem;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <a href="{{ route('admin.center-information.index') }}" class="btn py-2 px-4 me-3" 
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
    
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    input, textarea {
        width: 100% !important;
        padding: 0.75rem !important;
        font-size: 1.2rem !important;
    }
    
    textarea {
        min-height: 100px;
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
            padding: 0.6rem !important;
        }
    }
</style>
@endsection