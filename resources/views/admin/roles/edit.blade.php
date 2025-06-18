<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            font-size: 0.88rem;
            padding-top: 20px;
        }

        .card {
            border-radius: 8px;
            overflow: hidden;
            margin-top: 5px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.05);
            border: 2px solid #1A365D;
            max-width: 800px;
            margin: 0 auto;
        }

        .card-header {
            background-color: #1A365D;
            color: #FFFFFF;
            border-bottom: 3px solid #FF6B35;
            padding: 0.6rem 0.95rem;
        }

        .form-control, .form-control:focus, .form-select, .form-select:focus {
            border: 1.5px solid #1A365D;
            font-size: 0.88rem;
            padding: 0.42rem 0.7rem;
            height: auto;
        }

        .form-control:focus, .form-select:focus {
            border-color: #FF6B35;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        }

        .btn {
            font-weight: 600;
            transition: all 0.2s ease;
            border-radius: 5px;
            padding: 6px 12px;
            font-size: 0.88rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
            background-color: #FF6B35;
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
            font-size: 0.91rem;
            margin-bottom: 0.18rem;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.08rem;
            margin: 0;
        }

        .required-star {
            color: #e74c3c;
            font-size: 0.88rem;
            vertical-align: super;
        }

        .error-feedback {
            font-size: 0.78rem;
            font-weight: 500;
            color: #e74c3c;
            display: none;
            margin-top: 5px;
        }

        .invalid-feedback {
            display: block;
            margin-top: 3px;
            padding: 3px 6px;
            background-color: rgba(255, 107, 53, 0.1);
            border-radius: 4px;
            border-left: 3px solid #FF6B35;
            font-size: 0.85rem;
        }

        .form-control.is-invalid {
            border-color: #e74c3c;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 0.1rem rgba(231, 76, 60, 0.25);
            border-color: #e74c3c;
        }

        /* ESTILOS DEL ALERT COPIADOS DEL CÓDIGO ORIGINAL */
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

        /* ESTILOS SWEETALERT2 DEL CÓDIGO ORIGINAL */
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

        /* Responsive */
        @media (max-width: 768px) {
            .card-header h2 {
                font-size: 1.3rem !important;
            }

            .form-label {
                font-size: 1.0rem !important;
            }

            .form-control, .form-select {
                font-size: 0.9rem !important;
                padding: 6px 10px !important;
            }

            .btn {
                font-size: 1.0rem !important;
                padding: 5px 10px !important;
            }

            .invalid-feedback {
                font-size: 0.8rem !important;
                padding: 2px 4px !important;
            }

            .d-flex {
                flex-direction: column;
                gap: 10px;
            }

            .d-flex .btn {
                width: 100%;
                text-align: center;
            }

            /* Responsive para el alert */
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
                        <h2 class="mb-0 card-title">
                            <i class="fas fa-user-tag icon-header"></i> EDITAR ROL: ADMINISTRADOR
                        </h2>
                    </div>
                    <div class="card-body p-3">
                        <!-- Alert de error con el nuevo estilo -->
                        <div class="alert alert-dismissible fade show alert-error" role="alert" style="display: none;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-2 alert-icon"></i>
                                <div class="alert-message">
                                    <strong>Error en el formulario:</strong>
                                    <ul class="mb-0 ps-3">
                                        <li>Ejemplo de mensaje de error 1</li>
                                        <li>Ejemplo de mensaje de error 2</li>
                                    </ul>
                                </div>
                                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>

                        <form id="roleForm" action="/roles/1" method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="_token" value="simulated_csrf_token">
                            <input type="hidden" name="_method" value="PUT">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre del Rol <span class="required-star">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="Administrador" required>
                                <div class="error-feedback" id="nameError">
                                    <i class="fas fa-exclamation-circle me-1"></i> El nombre del rol es obligatorio
                                </div>
                                <div class="invalid-feedback server-error" style="display: none;">
                                    <i class="fas fa-exclamation-circle me-1"></i> El nombre del rol es requerido
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-5">
                                <a href="{{ route('admin.roles.index') }}" class="btn" style="background-color: #1A365D; color: #FFFFFF;">
                                    <i class="fas fa-times-circle me-1"></i> Cancelar</a>
                                <button type="submit" class="btn" style="background-color: #FF6B35; color: #FFFFFF;">
                                    <i class="fas fa-save me-1"></i> Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        (function () {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();

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
                    form.classList.add('was-validated');
                }, false);
            });

            // Para probar el alert de error (simulación)
            document.addEventListener('DOMContentLoaded', function() {
                const urlParams = new URLSearchParams(window.location.search);
                if(urlParams.has('show_errors')) {
                    const errorAlert = document.querySelector('.alert-error');
                    errorAlert.style.display = 'block';
                }
            });
        })();
    </script>
</body>
</html>