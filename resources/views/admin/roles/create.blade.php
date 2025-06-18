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

        /* Estilo para el alert de errores */
        .alert-error {
            background-color: #FF6B35;
            color: #FFFFFF;
            border-left: 5px solid #1A365D;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 4px;
        }

        .alert-error .alert-icon {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        .alert-error .alert-content {
            display: flex;
            align-items: center;
        }

        .alert-error .alert-message strong {
            font-size: 0.95rem;
            display: block;
            margin-bottom: 0.25rem;
        }

        .alert-error ul {
            margin-bottom: 0;
            padding-left: 1.5rem;
        }

        .alert-error li {
            font-size: 0.85rem;
        }

        .btn-close-white {
            filter: invert(1);
            opacity: 0.8;
        }

        /* Estilo para SweetAlert2 */
        .swal2-popup.custom-alert {
            border: 3px solid #1A365D;
            font-size: 0.9rem;
            border-radius: 6px;
            padding: 1rem;
        }

        .swal2-title {
            font-size: 1.1rem !important;
            color: #1A365D !important;
        }

        .swal2-html-container {
            font-size: 0.9rem !important;
            color: #1A365D !important;
        }

        .swal2-confirm {
            font-size: 0.85rem !important;
            padding: 0.5rem 1rem !important;
            background-color: #1A365D !important;
        }

        .swal2-icon.swal2-warning {
            color: #FF6B35 !important;
            border-color: #FF6B35 !important;
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

            .alert-error {
                font-size: 0.8rem;
                padding: 0.6rem 0.8rem;
            }

            .alert-error .alert-icon {
                font-size: 1rem;
            }

            .alert-error .alert-message strong {
                font-size: 0.85rem;
            }

            .swal2-popup.custom-alert {
                font-size: 0.8rem !important;
                padding: 0.8rem !important;
            }
            
            .swal2-title {
                font-size: 1rem !important;
            }
            
            .swal2-html-container {
                font-size: 0.8rem !important;
            }
            
            .swal2-confirm {
                font-size: 0.8rem !important;
                padding: 0.4rem 0.8rem !important;
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
                        @if($errors->any())
                            <div class="alert alert-dismissible fade show alert-error" role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2 alert-icon"></i>
                                    <div class="alert-message">
                                        <strong>Error en el formulario:</strong>
                                        <ul class="mb-0 ps-3">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

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
                        <div class="d-flex justify-content-end gap-3 mt-5">
                            <a href="{{ route('admin.roles.index') }}" class="btn py-1 px-3" style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 0.9rem;">
                                <i class="fas fa-times-circle me-1"></i> Cancelar</a>
                                    <button type="submit" class="btn py-1 px-3" style="background-color: #2EC4B6; color: #FFFFFF; font-weight: 600; font-size: 0.9rem;">
                                <i class="fas fa-save me-1"></i> Guardar
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
                        
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>