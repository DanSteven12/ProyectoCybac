<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Fitnflow</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        :root {
            --azul-marino: #1A365D;
            --naranja-brillante: #FF6B35;
            --verde-esmeralda: #2EC4B6;
            --blanco: #FFFFFF;
            --gris-claro: #F4F4F4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--azul-marino) 0%, #0f2a4a 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 800px;
        }

        .login-form-container {
            background: var(--blanco);
            border-radius: 12px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            width: 100%;
            aspect-ratio: 1/1;
        }

        .login-header {
            background: linear-gradient(135deg, var(--azul-marino) 0%, #0f2a4a 100%);
            color: var(--blanco);
            padding: 1.2rem;
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
            position: relative;
            z-index: 3;
            transform: translateZ(60px);
        }
        
        .circular-logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--verde-esmeralda);
            box-shadow: 
                0 0 0 3px var(--azul-marino),
                0 5px 15px rgba(0, 0, 0, 0.2),
                inset 0 0 10px rgba(46, 196, 182, 0.3);
            margin-bottom: 0.8rem;
            background: var(--azul-marino);
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--verde-esmeralda);
            font-weight: bold;
            font-size: 1.4rem;
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--blanco);
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
            width: 35px;
            height: 3px;
            background: var(--verde-esmeralda);
            border-radius: 3px;
        }

        .tagline {
            font-size: 0.8rem;
            opacity: 0.9;
            margin-top: 0.6rem;
            position: relative;
            display: inline-block;
            padding: 0.15rem 0.5rem;
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
            padding: 1.2rem;
            overflow-y: auto;
            max-height: 55vh;
        }

        .form-horizontal-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            justify-content: space-between;
        }

        .form-column {
            flex: 1 1 45%;
            min-width: 250px;
        }

        /* Contenedor para nombre y apellido alargados */
        .name-inputs-container {
            display: flex;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }

        .name-inputs-container .input__container {
            flex: 1;
            min-width: 120px;
        }

        /* Inputs reducidos en general */
        .input__container {
            position: relative;
            background: var(--verde-esmeralda);
            padding: 10px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 8px;
            border: 3px solid var(--azul-marino);
            max-width: 100%;
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
            transform: rotateX(10deg) rotateY(-10deg);
            perspective: 1000px;
            box-shadow: 7px 7px 0 #000;
            margin-bottom: 1rem;
        }

        .input__container:hover {
            transform: rotateX(5deg) rotateY(1deg) scale(1.05);
            box-shadow: 17px 17px 0 -4px var(--naranja-brillante), 17px 17px 0 0 #000;
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
            filter: blur(12px);
        }

        .input__button__shadow {
            cursor: pointer;
            border: 2px solid var(--azul-marino);
            background: var(--naranja-brillante);
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px;
            transform: translateZ(20px);
            position: relative;
            z-index: 3;
            font-weight: bold;
            text-transform: uppercase;
            color: var(--blanco);
            min-width: 36px;
            min-height: 36px;
        }

        .input__button__shadow:hover {
            background: var(--naranja-brillante);
            transform: translateZ(10px) translateX(-4px) translateY(-4px);
            box-shadow: 3px 3px 0 0 var(--azul-marino);
        }

        .input__button__shadow svg {
            fill: var(--blanco);
            width: 16px;
            height: 16px;
        }

        .input__search {
            width: 100%;
            outline: none;
            border: 2px solid var(--azul-marino);
            padding: 8px 10px;
            font-size: 13px;
            background: var(--blanco);
            color: var(--azul-marino);
            transform: translateZ(10px);
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            z-index: 3;
            font-family: "Poppins", sans-serif;
            border-radius: 4px;
            height: auto;
        }

        .input__search::placeholder {
            color: var(--naranja-brillante);
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }

        .input__search:hover,
        .input__search:focus {
            background: var(--verde-esmeralda);
            color: var(--blanco);
            transform: translateZ(20px) translateX(-4px) translateY(-4px);
            box-shadow: 3px 3px 0 0 var(--azul-marino);
            border-color: var(--naranja-brillante);
        }

        .input__search select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 12px;
            padding-right: 25px;
        }

        .input__container.name::before,
        .input__container.lastname::before,
        .input__container.correo::before,
        .input__container.birthdate::before,
        .input__container.gender::before,
        .input__container.password::before,
        .input__container.confirm-password::before {
            position: absolute;
            top: -10px;
            left: 12px;
            background: var(--naranja-brillante);
            color: var(--blanco);
            font-weight: bold;
            padding: 2px 6px;
            font-size: 10px;
            transform: translateZ(50px);
            z-index: 4;
            border: 2px solid var(--azul-marino);
        }

        .input__container.name::before {
            content: "NOMBRES";
        }

        .input__container.lastname::before {
            content: "APELLIDOS";
        }

        .input__container.correo::before {
            content: "CORREO";
        }

        .input__container.birthdate::before {
            content: "FECHA NAC.";
        }

        .input__container.gender::before {
            content: "GÉNERO";
        }

        .input__container.password::before {
            content: "CONTRASEÑA";
        }

        .input__container.confirm-password::before {
            content: "CONFIRMAR";
        }

        .btn__container {
            position: relative;
            background: var(--naranja-brillante);
            padding: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border: 3px solid var(--azul-marino);
            max-width: 100%;
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
            transform: rotateX(10deg) rotateY(-10deg);
            perspective: 1000px;
            box-shadow: 7px 7px 0 #000;
            margin: 1.5rem 0;
            cursor: pointer;
            width: 100%;
        }

        .btn__container:hover {
            transform: rotateX(5deg) rotateY(1deg) scale(1.05);
            box-shadow: 17px 17px 0 -4px var(--verde-esmeralda), 17px 17px 0 0 #000;
        }

        .btn__container::before {
            content: "REGISTRO";
            position: absolute;
            top: -10px;
            left: 12px;
            background: var(--verde-esmeralda);
            color: var(--blanco);
            font-weight: bold;
            padding: 2px 6px;
            font-size: 10px;
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
            filter: blur(12px);
        }

        .btn__content {
            width: 100%;
            outline: none;
            border: 2px solid var(--azul-marino);
            padding: 8px;
            font-size: 14px;
            background: var(--naranja-brillante);
            color: var(--blanco);
            transform: translateZ(10px);
            transition: all 400ms cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            z-index: 3;
            font-family: "Poppins", sans-serif;
            border-radius: 4px;
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
        }

        .register__container {
            margin-top: 1rem;
        }

        .register__divider {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .register__line {
            flex: 1;
            height: 1px;
            background: var(--azul-marino);
            opacity: 0.3;
        }

        .register__text {
            padding: 0 0.8rem;
            color: var(--azul-marino);
            font-weight: 500;
            font-size: 12px;
        }

        .register__link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--azul-marino);
            text-decoration: none;
            font-weight: 400;
            transition: all 0.3s ease;
            padding: 0.4rem;
            border-radius: 5px;
            font-size: 12px;
        }

        .register__link:hover {
            background: rgba(26, 54, 93, 0.05);
            transform: translateY(-2px);
        }

        .register__link strong {
            color: var(--naranja-brillante);
            font-weight: 600;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 12px;
            font-size: 12px;
            display: none;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .login-form-container {
                aspect-ratio: auto;
            }
            
            .form-column {
                flex: 1 1 100%;
            }
            
            .login-body {
                max-height: none;
                padding: 1rem;
            }
            
            .login-header {
                padding: 1rem;
            }
            
            .circular-logo {
                width: 60px;
                height: 60px;
                font-size: 1.2rem;
            }
            
            .brand-name {
                font-size: 1.3rem;
            }

            .name-inputs-container {
                flex-direction: column;
                gap: 0.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-form-container">
            <div class="login-header">
                <div class="particles" id="particles-js"></div>
                
                <div class="logo-container">
                    <img src="{{ asset('images/logo.png') }}" alt="Fitnflow" class="circular-logo">
                    <div class="brand-name">Fitnflow</div>
                    <p class="tagline">Regístrate para empezar tu viaje fitness</p>
                </div>
            </div>
            <br>
            <br>


            <div class="login-body">
                <form method="POST" action="#" class="login-card">
                    <div class="alert alert-danger" style="display: none;">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        Error de ejemplo: El correo electrónico ya está en uso
                    </div>

                    <div class="form-horizontal-container">
                        <!-- Columna izquierda -->
                        <div class="form-column">
                            <!-- 1. Nombre completo con campos alargados -->
                            <div>
                                <div class="name-inputs-container">
                                    <div class="input__container name">
                                        <div class="shadow__input"></div>
                                        <button class="input__button__shadow" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                            </svg>
                                        </button>
                                        <input id="names" type="text" name="names" 
                                               class="input__search"
                                               placeholder="Nombres" required>
                                    </div>
                                    
                                    <div class="input__container lastname">
                                        <div class="shadow__input"></div>
                                        <button class="input__button__shadow" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                            </svg>
                                        </button>
                                        <input id="last_name" type="text" name="last_name" 
                                               class="input__search"
                                               placeholder="Apellidos" required>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Email -->
                            <div>
                                <div class="input__container correo">
                                    <div class="shadow__input"></div>
                                    <button class="input__button__shadow" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
                                        </svg>
                                    </button>
                                    <input id="email" type="email" name="email" 
                                           class="input__search"
                                           placeholder="ejemplo@correo.com" required>
                                </div>
                            </div>

                            <!-- 3. Fecha de nacimiento -->
                            <div>
                                <div class="input__container birthdate">
                                    <div class="shadow__input"></div>
                                    <button class="input__button__shadow" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"></path>
                                        </svg>
                                    </button>
                                    <input type="text" id="birth_date" name="birth_date" 
                                           class="input__search"
                                           placeholder="Selecciona tu fecha" readonly required>
                                </div>
                            </div>
                        </div>

                        <!-- Columna derecha -->
                        <div class="form-column">
                            <!-- 4. Género reducido -->
                            <div>
                                <div class="input__container gender">
                                    <div class="shadow__input"></div>
                                    <button class="input__button__shadow" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-12S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                                        </svg>
                                    </button>
                                    <select name="gender" class="input__search" required>
                                        <option value="" disabled selected>Seleccione...</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <!-- 5. Contraseña -->
                            <div>
                                <div class="input__container password">
                                    <div class="shadow__input"></div>
                                    <button class="input__button__shadow" type="button" onclick="togglePassword('password')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>
                                        </svg>
                                    </button>
                                    <input id="password" type="password" name="password" 
                                           class="input__search"
                                           placeholder="Mínimo 8 caracteres" required minlength="8">
                                </div>
                            </div>

                            <!-- 6. Confirmar contraseña -->
                            <div>
                                <div class="input__container confirm-password">
                                    <div class="shadow__input"></div>
                                    <button class="input__button__shadow" type="button" onclick="togglePassword('password-confirm')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>
                                        </svg>
                                    </button>
                                    <input id="password-confirm" type="password" name="password_confirmation" 
                                           class="input__search"
                                           placeholder="Repita su contraseña" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de submit -->
                    <button type="submit" class="btn__container">
                        <div class="btn__shadow"></div>
                        <div class="btn__content">
                            <i class="bi bi-person-plus"></i>
                            COMPLETAR REGISTRO
                        </div>
                    </button>

                    <!-- Enlace login -->
                    <div class="register__container">
                        <div class="register__divider">
                            <span class="register__line"></span>
                            <span class="register__text">O</span>
                            <span class="register__line"></span>
                        </div>
                        <a href="/login" class="register__link">
                            <span class="register__icon">
                                <svg viewBox="0 0 24 24" width="16" height="16">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>
                                </svg>
                            </span>
                            <span>¿Ya tienes una cuenta? <strong>Inicia sesión</strong></span>
                        </a>
                    </div>
                </form>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración del selector de fecha
            flatpickr("#birth_date", {
                dateFormat: "Y-m-d",
                locale: "es",
                disableMobile: true,
                maxDate: new Date().fp_incr(-18 * 365),
                altInput: true,
                altFormat: "d/m/Y",
                ariaDateFormat: "d/m/Y",
                onChange: function(selectedDates, dateStr, instance) {
                    instance.close();
                }
            });

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

        function togglePassword(fieldId) {
            const password = document.getElementById(fieldId);
            const icon = document.querySelector(`.input__container.${fieldId.includes('confirm') ? 'confirm-password' : 'password'} .input__button__shadow svg`);
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.innerHTML = '<path d="M0 0h24v24H0z" fill="none"></path><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>';
            } else {
                password.type = 'password';
                icon.innerHTML = '<path d="M0 0h24v24H0z" fill="none"></path><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"></path>';
            }
        }
    </script>
</body>
</html>