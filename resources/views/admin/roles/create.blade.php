<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Rol</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            border: 2px solid var(--primary-color);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: #FFFFFF;
            border-bottom: 3px solid var(--accent-color);
            padding: 0.65rem 1rem;
        }
        
        .card-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }
        
        .icon-header {
            font-size: 1.1rem;
            margin-right: 4px;
        }
        
        .card-body {
            background-color: var(--light-bg);
            padding: 1rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.94rem;
            margin-bottom: 0.2rem;
        }
        
        .form-control {
            border: 1.5px solid var(--primary-color);
            font-size: 0.9rem;
            padding: 0.45rem 0.75rem;
            height: auto;
            border-radius: 4px;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.12rem rgba(255, 107, 53, 0.25);
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
            background-color: var(--accent-color);
            color: white;
            border: none;
        }
        
        .btn-cancel {
            background-color: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }
        
        .invalid-feedback {
            font-size: 0.8rem;
            font-weight: 500;
            display: block;
            margin-top: 4px;
            padding: 4px 8px;
            background-color: rgba(255, 107, 53, 0.1);
            border-radius: 4px;
            border-left: 3px solid var(--accent-color);
        }
        
        .required-star {
            color: #e74c3c;
            font-size: 0.9rem;
            vertical-align: super;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-header {
                padding: 0.5rem;
            }
            
            .card-title {
                font-size: 0.95rem;
            }
            
            .btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }
            
            .form-label {
                font-size: 0.9rem;
            }
            
            .form-control {
                font-size: 0.85rem;
                padding: 0.4rem 0.7rem;
            }
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
                            <i class="fas fa-user-tag icon-header"></i>CREAR NUEVO ROL
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.roles.store') }}" class="needs-validation" novalidate>
                            @csrf

                            <!-- Nombre del Rol -->
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    {{ __('Nombre del Rol') }} <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Ingrese el nombre del rol" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-cancel"> 
                                    <i class="fas fa-times me-1"></i> CANCELAR
                                </a>
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-save me-1"></i> GUARDAR ROL
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Validación de formulario
        (function () {
            'use strict'
            
            var forms = document.querySelectorAll('.needs-validation')
            
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
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
</body>
</html>