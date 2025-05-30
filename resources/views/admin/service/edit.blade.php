@extends('layouts.admi-app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow" style="border: 2px solid #1A365D; border-radius: 10px;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <h3 class="mb-0" style="font-weight: 600;">
                        <i class="fas fa-edit me-2"></i>EDITAR SERVICIO
                    </h3>
                </div>

                <div class="card-body p-4" style="background-color: #F4F4F4;">
                    <form method="POST" action="{{ route('admin.services.update', $service->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right fw-bold" style="color: #1A365D; font-size: 1.1rem;">
                                {{ __('Nombre') }} <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control py-2 @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name', $service->name) }}" required 
                                       style="border: 1px solid #1A365D; font-size: 1.1rem;">

                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert" style="font-size: 1rem;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="description" class="col-md-4 col-form-label text-md-right fw-bold" style="color: #1A365D; font-size: 1.1rem;">
                                {{ __('Descripción') }}
                            </label>

                            <div class="col-md-7">
                                <textarea id="description" class="form-control py-2 @error('description') is-invalid @enderror" 
                                          name="description" rows="4"
                                          style="border: 1px solid #1A365D; font-size: 1.1rem;">{{ old('description', $service->description) }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback d-block" role="alert" style="font-size: 1rem;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-4 d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.services.index') }}" class="btn py-2 px-4" 
                                   style="background-color: #FFFFFF; color: #1A365D; border: 2px solid #1A365D; font-weight: 600; font-size: 1.1rem;">
                                    <i class="fas fa-times me-2"></i> CANCELAR
                                </a>
                                <button type="submit" class="btn py-2 px-4" 
                                        style="background-color: #2EC4B6; color: #FFFFFF; font-weight: 600; font-size: 1.1rem;">
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
    .form-control:focus {
        border-color: #FF6B35;
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.25);
    }
    
    .card {
        overflow: hidden;
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection