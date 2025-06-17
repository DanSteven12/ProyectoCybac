<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - Fitnflow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --azul-marino: #1A365D;
            --naranja-brillante: #FF6B35;
            --verde-esmeralda: #2EC4B6;
            --blanco: #FFFFFF;
            --gris-claro: #F4F4F4;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: var(--gris-claro);
        }

        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .login-form-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: var(--blanco);
        }

        .login-image-container {
            flex: 1;
            background-image: url('/images/image.png');
            background-size: cover;
            background-position: center;
            display: none;
            position: relative;
        } 
        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: var(--blanco);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .login-header {
            background: var(--azul-marino);
            color: var(--blanco);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--naranja-brillante), var(--verde-esmeralda));
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .circular-logo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--verde-esmeralda);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }
        
        .brand-name {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--blanco);
            margin-top: 0.5rem;
        }

        .tagline {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .login-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--azul-marino);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .input-group-icon {
            position: relative;
        }

        .form-control {
            height: 3rem;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding-left: 3rem;
            transition: all 0.3s;
            background-color: var(--gris-claro);
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--verde-esmeralda);
            box-shadow: 0 0 0 0.2rem rgba(46, 196, 182, 0.15);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--azul-marino);
            z-index: 5;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
        }

        .btn-login {
            background: var(--naranja-brillante);
            border: none;
            color: var(--blanco);
            height: 3rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            background: linear-gradient(to right, var(--naranja-brillante), #FF8C5A);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--azul-marino);
            cursor: pointer;
            z-index: 5;
            opacity: 0.7;
        }

        .password-toggle:hover {
            opacity: 1;
            color: var(--verde-esmeralda);
        }

        .form-check-input:checked {
            background-color: var(--verde-esmeralda);
            border-color: var(--verde-esmeralda);
        }

        .btn-recovery {
            background: transparent;
            border: none;
            color: var(--naranja-brillante);
            font-weight: 500;
            padding: 0;
            font-size: 0.85rem;
            text-decoration: underline;
        }

        .btn-recovery:hover {
            color: var(--azul-marino);
        }

        .login-footer {
            text-align: center;
            padding: 0 2rem 1.5rem;
        }

        .login-footer a {
            color: var(--verde-esmeralda);
            text-decoration: none;
            font-weight: 500;
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(transparent, rgba(26, 54, 93, 0.8));
            color: var(--blanco);
        }

        .image-text {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border-radius: 8px;
        }

        @media (min-width: 992px) {
            .login-image-container {
                display: block;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-container {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Columna del formulario -->
        <div class="login-form-container">
            <div class="login-container">
                <div class="login-card">
                    <div class="login-header">
                        <div class="logo-container">
                            <img src="{{ asset('images/logo.png') }}" alt="Fitnflow" class="circular-logo">
                            <div class="brand-name">Fitnflow</div>
                        </div>
                        <p class="tagline">Accede a tu cuenta para reservar clases</p>
                    </div>
                    
                    <div class="login-body">
                        @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <div class="input-group-icon">
                                    <i class="bi bi-envelope input-icon"></i>
                                    <input type="email" 
                                           name="email" 
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror" 
                                           required 
                                           autofocus
                                           placeholder="ejemplo@correo.com">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group-icon">
                                    <i class="bi bi-lock input-icon"></i>
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           required>
                                    <button type="button" 
                                            class="password-toggle" 
                                            onclick="togglePassword()">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="checkbox" 
                                        class="form-check-input" 
                                        name="remember" 
                                        id="remember">
                                    <label class="form-check-label" for="remember">Recordar sesión</label>
                                </div>
                                    <a href="{{ route('password.request') }}" class="btn-recovery">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </div>

                            <button type="submit" class="btn btn-login mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión
                            </button>

                            <div class="text-center mt-3">
                                @if(Route::has('register'))
                                    <p>¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-decoration-none">Regístrate</a></p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna de la imagen -->
        <div class="login-image-container">
            <div class="image-overlay">
                <div class="image-text">Transforma tu rutina</div>
                <p>Reserva clases de yoga, natación o zumba.</p>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        // Limpiar campos al cargar (opcional)
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
        });
    </script>
</body>
</html>