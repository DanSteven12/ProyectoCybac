<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Servicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1A365D;
            --secondary-color: #2EC4B6;
            --accent-color: #FF6B35;
            --light-bg: #F4F4F4;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.9rem;
        }
        
        .card {
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
            border: 2px solid #1A365D;
        }
        
        .card-header {
            background-color: #1A365D;
            color: #FFFFFF;
            border-bottom: 3px solid #FF6B35;
            padding: 0.65rem 1rem;
        }
        
        .form-control, .form-control:focus {
            border: 1.5px solid #1A365D;
            font-size: 0.9rem;
            padding: 0.45rem 0.75rem;
            height: auto;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.12rem rgba(255, 107, 53, 0.25);
            border-color: #FF6B35;
        }
        
        textarea.form-control {
            min-height: 75px;
        }
        
        .btn {
            font-weight: 600;
            transition: all 0.2s ease;
            padding: 0.45rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
        }
        
        .btn-submit {
            background-color: #2EC4B6;
            color: white;
            border: none;
        }
        
        .btn-cancel {
            background-color: white;
            color: #1A365D;
            border: 2px solid #1A365D;
        }
        
        .form-label {
            font-weight: 600;
            color: #1A365D;
            font-size: 0.94rem;
            margin-bottom: 0.2rem;
        }
        
        .card-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }
        
        .required-star {
            color: #e74c3c;
            font-size: 0.9rem;
            vertical-align: super;
        }
        
        .error-feedback {
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .icon-header {
            font-size: 1.1rem;
            margin-right: 4px;
        }
    </style>
</head>
<body>
    <div class="container-fluid px-4 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 card-title">
                            <i class="fas fa-plus-circle icon-header"></i>CREAR NUEVO SERVICIO
                        </h3>
                    </div>

                    <div class="card-body p-2" style="background-color: #F4F4F4;">
                        <form method="POST" action="{{ route('admin.services.store') }}">
                            @csrf

                            <div class="mb-2">
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

                            <div class="mb-2">
                                <label for="description" class="form-label">
                                    {{ __('Descripción del Servicio') }}
                                </label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" 
                                          name="description" rows="3"
                                          placeholder="Describa el servicio en detalle">{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback d-block error-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <a href="{{ route('admin.services.index') }}" class="btn btn-cancel"> 
                                    <i class="fas fa-times me-1"></i> CANCELAR
                                </a>
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-save me-1"></i> CREAR SERVICIO
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>