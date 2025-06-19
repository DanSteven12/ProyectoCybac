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
            background-image: url("{{ asset('images/image.png') }}");
            background-size: cover;
            background-position: center;
            display: none;
            position: relative;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(26, 54, 93, 0.8) 0%, rgba(46, 196, 182, 0.6) 100%);
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
            background: linear-gradient(135deg, var(--azul-marino) 0%, #0f2a4a 100%);
            color: var(--blanco);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid var(--naranja-brillante);
            box-shadow: 0 10px 30px rgba(26, 54, 93, 0.3);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .login-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--naranja-brillante), var(--verde-esmeralda));
            transform: translateZ(20px);
        }

        .login-header::after {
            content: "";
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 30px;
            height: 30px;
            background: var(--naranja-brillante);
            z-index: 1;
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
            transform: translateZ(30px);
        }
        
        .circular-logo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--verde-esmeralda);
            box-shadow: 
                0 0 0 4px var(--azul-marino),
                0 10px 25px rgba(0, 0, 0, 0.3),
                inset 0 0 15px rgba(46, 196, 182, 0.4);
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
            background: var(--azul-marino);
            position: relative;
            overflow: hidden;
        }

        .circular-logo::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.3) 0%,
                rgba(255, 255, 255, 0) 60%
            );
            transform: rotate(30deg);
        }
        
        .brand-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--blanco);
            margin-top: 0.5rem;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
            position: relative;
        }

        .brand-name::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--verde-esmeralda);
            border-radius: 3px;
        }

        .tagline {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0;
            margin-top: 1rem;
            position: relative;
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) translateX(500px) rotate(720deg);
                opacity: 0;
            }
        }

        .login-body {
            padding: 2rem;
        }

        .input__container {
            position: relative;
            background: var(--verde-esmeralda);
            padding: 15px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            border: 4px solid var(--azul-marino);
            max-width: 100%;
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
            transform: rotateX(10deg) rotateY(-10deg);
            perspective: 1000px;
            box-shadow: 10px 10px 0 #000;
            margin-bottom: 1.5rem;
        }

        .input__container:hover {
            transform: rotateX(5deg) rotateY(1deg) scale(1.05);
            box-shadow: 25px 25px 0 -5px var(--naranja-brillante), 25px 25px 0 0 #000;
        }

        .shadow__input {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            bottom: 0;
            z-index: -1;
            transform: translateZ(-50px);
            background: linear-gradient(
                45deg,
                rgba(255, 107, 53, 0.4) 0%,
                rgba(255, 107, 53, 0.1) 100%
            );
            filter: blur(20px);
        }

        .input__button__shadow {
            cursor: pointer;
            border: 2px solid var(--azul-marino);
            background: var(--naranja-brillante);
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 6px;
            transform: translateZ(20px);
            position: relative;
            z-index: 3;
            font-weight: bold;
            text-transform: uppercase;
            color: var(--blanco);
        }

        .input__button__shadow:hover {
            background: var(--naranja-brillante);
            transform: translateZ(10px) translateX(-5px) translateY(-5px);
            box-shadow: 5px 5px 0 0 var(--azul-marino);
        }

        .input__button__shadow svg {
            fill: var(--blanco);
            width: 20px;
            height: 20px;
        }

        .input__search {
            width: 100%;
            outline: none;
            border: 2px solid var(--azul-marino);
            padding: 10px;
            font-size: 14px;
            background: var(--blanco);
            color: var(--azul-marino);
            transform: translateZ(10px);
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            z-index: 3;
            font-family: "Poppins", sans-serif;
            border-radius: 5px;
        }

        .input__search::placeholder {
            color: var(--naranja-brillante);
            font-weight: bold;
            text-transform: uppercase;
        }

        .input__search:hover,
        .input__search:focus {
            background: var(--verde-esmeralda);
            color: var(--blanco);
            transform: translateZ(20px) translateX(-5px) translateY(-5px);
            box-shadow: 5px 5px 0 0 var(--azul-marino);
            border-color: var(--naranja-brillante);
        }

        .input__container.correo::before,
        .input__container.password::before {
            position: absolute;
            top: -15px;
            left: 20px;
            background: var(--naranja-brillante);
            color: var(--blanco);
            font-weight: bold;
            padding: 3px 8px;
            font-size: 12px;
            transform: translateZ(50px);
            z-index: 4;
            border: 2px solid var(--azul-marino);
        }

        .input__container.correo::before {
            content: "CORREO";
        }

        .input__container.password::before {
            content: "CONTRASEÑA";
        }

        .btn__container {
            position: relative;
            background: var(--naranja-brillante);
            padding: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border: 4px solid var(--azul-marino);
            max-width: 100%;
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
            transform: rotateX(10deg) rotateY(-10deg);
            perspective: 1000px;
            box-shadow: 10px 10px 0 #000;
            margin: 2rem 0;
            cursor: pointer;
        }

        .btn__container:hover {
            transform: rotateX(5deg) rotateY(1deg) scale(1.05);
            box-shadow: 25px 25px 0 -5px var(--verde-esmeralda), 25px 25px 0 0 #000;
        }

        .btn__container::before {
            content: "ACCESO";
            position: absolute;
            top: -15px;
            left: 20px;
            background: var(--verde-esmeralda);
            color: var(--blanco);
            font-weight: bold;
            padding: 3px 8px;
            font-size: 12px;
            transform: translateZ(50px);
            z-index: 4;
            border: 2px solid var(--azul-marino);
        }

        .btn__shadow {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            bottom: 0;
            z-index: -1;
            transform: translateZ(-50px);
            background: linear-gradient(
                45deg,
                rgba(46, 196, 182, 0.4) 0%,
                rgba(46, 196, 182, 0.1) 100%
            );
            filter: blur(20px);
        }

        .btn__content {
            width: 100%;
            outline: none;
            border: 2px solid var(--azul-marino);
            padding: 10px;
            font-size: 14px;
            background: var(--naranja-brillante);
            color: var(--blanco);
            transform: translateZ(10px);
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            z-index: 3;
            font-family: "Poppins", sans-serif;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn__container:hover .btn__content {
            background: var(--verde-esmeralda);
            transform: translateZ(20px) translateX(-5px) translateY(-5px);
            box-shadow: 5px 5px 0 0 var(--azul-marino);
            border-color: var(--verde-esmeralda);
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .invalid-feedback i {
            margin-right: 0.25rem;
        }

        /* Estilo para el contenedor de opciones */
        .options__container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
            transform-style: preserve-3d;
            perspective: 500px;
        }

        /* Estilo para cada item de opción */
        .option__item {
            position: relative;
            transform: translateZ(15px);
        }

        .option__checkbox {
            position: absolute;
            opacity: 0;
        }

        .option__label {
            display: flex;
            align-items: center;
            cursor: pointer;
            position: relative;
            padding-left: 28px;
            color: var(--azul-marino);
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .option__label:hover {
            color: var(--naranja-brillante);
            transform: translateX(5px);
        }

        .option__icon {
            position: absolute;
            left: 0;
            width: 20px;
            height: 20px;
            border: 2px solid var(--verde-esmeralda);
            background: var(--blanco);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            transform: translateZ(10px);
        }

        .option__checkbox:checked + .option__label .option__icon {
            background: var(--verde-esmeralda);
            border-color: var(--azul-marino);
        }

        .option__checkbox:checked + .option__label .option__icon svg path {
            fill: var(--blanco);
        }

        .option__icon svg path {
            fill: transparent;
            transition: fill 0.3s ease;
        }

        .option__checkbox:checked + .option__label .option__text {
            font-weight: 600;
        }

        /* Estilo para el enlace de recuperación */
        .option__link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--naranja-brillante);
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            transform: translateZ(15px);
        }

        .option__link:hover {
            color: var(--azul-marino);
            transform: translateZ(15px) translateX(-3px);
        }

        .option__link .option__icon {
            position: relative;
            left: auto;
            background: var(--naranja-brillante);
            border-color: var(--azul-marino);
        }

        .option__link .option__icon svg path {
            fill: var(--blanco);
        }

        /* Estilo para el contenedor de registro */
        .register__container {
            margin-top: 2rem;
            position: relative;
            z-index: 2;
            transform-style: preserve-3d;
        }

        .register__divider {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            transform: translateZ(20px);
        }

        .register__line {
            flex: 1;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--verde-esmeralda), transparent);
            opacity: 0.5;
        }

        .register__text {
            padding: 0 12px;
            color: var(--azul-marino);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .register__link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--azul-marino);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(46, 196, 182, 0.3);
            transform: translateZ(25px);
        }

        .register__link:hover {
            background: var(--verde-esmeralda);
            color: var(--blanco);
            transform: translateZ(25px) translateY(-3px);
            box-shadow: 0 5px 15px rgba(46, 196, 182, 0.3);
        }

        .register__link strong {
            font-weight: 700;
            color: var(--naranja-brillante);
        }

        .register__link:hover strong {
            color: var(--blanco);
        }

        .register__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: var(--naranja-brillante);
            border-radius: 50%;
            padding: 3px;
        }

        .register__icon svg path {
            fill: var(--blanco);
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
                        <!-- Efecto de partículas -->
                        <div class="particles" id="particles-js"></div>
                        
                        <div class="logo-container">
                            <img src="{{ asset('images/logo.png') }}" alt="Fitnflow" class="circular-logo">
                            <div class="brand-name">Fitnflow</div>
                            <p class="tagline">Accede a tu cuenta para reservar clases</p>
                        </div>
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
                            
                            <!-- Correo electrónico -->
                            <div class="mb-4">
                                <div class="input__container correo">
                                    <div class="shadow__input"></div>
                                    <button class="input__button__shadow" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" width="20px" height="20px">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                        </svg>
                                    </button>
                                    <input type="email" name="email" id="email"
                                           class="input__search @error('email') is-invalid @enderror"
                                           placeholder="ejemplo@correo.com" required autofocus />
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block mt-1">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-4">
                                <div class="input__container password">
                                    <div class="shadow__input"></div>
                                    <button class="input__button__shadow" type="button" onclick="togglePassword()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" width="20px" height="20px">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>
                                        </svg>
                                    </button>
                                    <input type="password" name="password" id="password"
                                           class="input__search @error('password') is-invalid @enderror"
                                           placeholder="********" required />
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block mt-1">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="options__container mb-4">
                                <div class="option__item remember">
                                    <input type="checkbox" 
                                           class="option__checkbox" 
                                           name="remember" 
                                           id="remember">
                                    <label class="option__label" for="remember">
                                        <span class="option__icon">
                                            <svg viewBox="0 0 24 24" width="16" height="16">
                                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
                                            </svg>
                                        </span>
                                        <span class="option__text">Recordar sesión</span>
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" class="option__link">
                                    <span class="option__icon">
                                        <svg viewBox="0 0 24 24" width="16" height="16">
                                            <path d="M12 15c1.66 0 3-1.34 3-3V6c0-1.66-1.34-3-3-3S9 4.34 9 6v6c0 1.66 1.34 3 3 3zm5.91-3c-.49 0-.9.36-.98.85C16.52 14.2 14.47 16 12 16s-4.52-1.8-4.93-4.15c-.08-.49-.49-.85-.98-.85-.61 0-1.09.54-1 1.14.49 3 2.89 5.35 5.91 5.78V21c0 .55.45 1 1 1s1-.45 1-1v-2.08c3.02-.43 5.42-2.78 5.91-5.78.1-.6-.39-1.14-1-1.14z"></path>
                                        </svg>
                                    </span>
                                    <span class="option__text">¿Olvidaste tu contraseña?</span>
                                </a>
                            </div>
                            
                            <center>
                                <button type="submit" class="btn__container">
                                    <div class="btn__shadow"></div>
                                    <div class="btn__content">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        INICIAR SESIÓN
                                    </div>
                                </button>
                            </center>

                            <div class="register__container">
                                <div class="register__divider">
                                    <span class="register__line"></span>
                                    <span class="register__text">O</span>
                                    <span class="register__line"></span>
                                </div>
                                @if(Route::has('register'))
                                <a href="{{ route('register') }}" class="register__link">
                                    <span class="register__icon">
                                        <svg viewBox="0 0 24 24" width="18" height="18">
                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                        </svg>
                                    </span>
                                    <span>¿No tienes una cuenta? <strong>Regístrate</strong></span>
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna de la imagen -->
        <div class="login-image-container">
            <div class="image-overlay"></div>
        </div>
    </div>
  <script>
    // Esperar a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar todas las alertas
        const alerts = document.querySelectorAll('.alert');
        
        // Configurar el tiempo de desaparición (3000ms = 3 segundos)
        const fadeTime = 3000;
        
        // Aplicar a cada alerta
        alerts.forEach(alert => {
            setTimeout(() => {
                // Agregar clase para animación de desvanecimiento
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                
                // Eliminar el elemento después de la animación
                setTimeout(() => {
                    alert.remove();
                }, 500); // 0.5s para coincidir con la duración de la transición
            }, fadeTime);
        });
    });
</script>
    <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.querySelector('.input__container.password .input__button__shadow svg');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.innerHTML = '<path d="M0 0h24v24H0z" fill="none"></path><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>';
            } else {
                password.type = 'password';
                icon.innerHTML = '<path d="M0 0h24v24H0z" fill="none"></path><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>';
            }
        }

        // Limpiar campos al cargar (opcional)
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            
            // Crear efecto de partículas
            const particlesContainer = document.getElementById('particles-js');
            if (particlesContainer) {
                const particleCount = 20;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    
                    // Tamaño aleatorio entre 1px y 3px
                    const size = Math.random() * 2 + 1;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    
                    // Posición inicial aleatoria
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;
                    
                    // Animación con duración aleatoria
                    const duration = Math.random() * 10 + 10;
                    particle.style.animationDuration = `${duration}s`;
                    
                    // Retraso inicial aleatorio
                    particle.style.animationDelay = `${Math.random() * 5}s`;
                    
                    particlesContainer.appendChild(particle);
                }
            }
        });
    </script>
</body>
</html>