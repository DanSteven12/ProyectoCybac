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
            border-radius: 6px;
            overflow: hidden;
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
        
        .form-control, .form-control:focus {
            border: 1.5px solid #1A365D;
            font-size: 0.88rem;
            padding: 0.42rem 0.7rem;
            height: auto;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.1rem rgba(255, 107, 53, 0.25);
            border-color: #FF6B35;
        }
        
        .btn {
            font-weight: 600;
            transition: all 0.2s ease;
            padding: 0.42rem 0.95rem;
            border-radius: 4px;
            font-size: 0.88rem;
        }
        
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
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
            margin-top: 5px;
            padding: 5px 8px;
            background-color: rgba(255, 107, 53, 0.1);
            border-radius: 4px;
            border-left: 3px solid #FF6B35;
            font-size: 0.78rem;
        }
        
        .form-control.is-invalid {
            border-color: #e74c3c;
        }
        
        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 0.1rem rgba(231, 76, 60, 0.25);
            border-color: #e74c3c;
        }
        
        /* Estilo para el contenedor principal */
        .container-fluid {
            padding: 0 15px;
        }
        
        /* Ajustes para móviles */
        @media (max-width: 768px) {
            .card-header h2 {
                font-size: 0.95rem !important;
            }
            
            .d-flex {
                flex-direction: column;
                gap: 10px;
            }
            
            .d-flex .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid px-4 mt-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mb-0 card-title">
                                <i class="fas fa-user-tag icon-header"></i>EDITAR ROL: ADMINISTRADOR
                            </h2>
                        </div>
                    </div>

                    <div class="card-body p-3">
                        <form id="roleForm" action="/roles/1" method="POST" class="needs-validation" novalidate>
                            <!-- Simulación de tokens CSRF y método PUT para Laravel -->
                            <input type="hidden" name="_token" value="simulated_csrf_token">
                            <input type="hidden" name="_method" value="PUT">
                            
                            <!-- Nombre del Rol -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre del Rol <span class="required-star">*</span></label>
                                <input type="text" class="form-control" 
                                       id="name" name="name" value="Administrador"
                                       placeholder="Ingrese el nombre del rol" required>
                                       
                                <!-- Mensaje de error para validación del lado del cliente -->
                                <div class="error-feedback" id="nameError">
                                    <i class="fas fa-exclamation-circle me-1"></i>El nombre del rol es obligatorio
                                </div>
                                
                                <!-- Mensaje de error para validación del lado del servidor -->
                                <div class="invalid-feedback server-error" style="display: none;">
                                    <i class="fas fa-exclamation-circle me-1"></i>El nombre del rol es requerido
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="/roles" class="btn btn-cancel"> 
                                    <i class="fas fa-times me-1"></i> CANCELAR
                                </a>
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-save me-1"></i> ACTUALIZAR ROL
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
    
    <script>
        // Validación de formulario
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('roleForm');
            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('nameError');
            
            // Función para mostrar error
            function showError(input, errorElement, message) {
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
                errorElement.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;
            }
            
            // Función para ocultar error
            function hideError(input, errorElement) {
                input.classList.remove('is-invalid');
                errorElement.style.display = 'none';
            }
            
            // Validar campo al perder foco
            nameInput.addEventListener('blur', function() {
                if (!nameInput.value.trim()) {
                    showError(nameInput, nameError, 'El nombre del rol es obligatorio');
                } else {
                    hideError(nameInput, nameError);
                }
            });
            
            // Validar al enviar formulario
            form.addEventListener('submit', function(event) {
                let isValid = true;
                
                // Validar nombre
                if (!nameInput.value.trim()) {
                    showError(nameInput, nameError, 'El nombre del rol es obligatorio');
                    isValid = false;
                }
                
                if (!isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    // Simular envío exitoso
                    event.preventDefault();
                    
                    // Mostrar mensaje de éxito con estilo
                    const successDiv = document.createElement('div');
                    successDiv.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i> Rol actualizado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                    
                    // Insertar después del formulario
                    form.parentNode.insertBefore(successDiv, form.nextSibling);
                    
                    // Ocultar después de 3 segundos
                    setTimeout(() => {
                        successDiv.querySelector('.alert').classList.add('fade');
                        setTimeout(() => {
                            successDiv.style.display = 'none';
                        }, 500);
                    }, 3000);
                }
            });
        });
    </script>
</body>
</html>