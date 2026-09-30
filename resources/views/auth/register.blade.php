<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Fitnflow</title>
    
    <!-- Fuentes y CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <style>
        :root {
            --azul-marino: #1A365D;
            --azul-marino-oscuro: #0F2A4A;
            --naranja-brillante: #FF6B35;
            --naranja-hover: #E55C2B;
            --verde-esmeralda: #2EC4B6;
            --blanco: #FFFFFF;
            --gris-claro: #F8FAFC;
            --gris-borde: #E2E8F0;
            --texto-oscuro: #2D3748;
            --rojo-error: #E53E3E;
            --sombra-card: 0 20px 40px rgba(15, 42, 74, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--azul-marino) 0%, var(--azul-marino-oscuro) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 1rem;
            color: var(--texto-oscuro);
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 820px;
        }

        .login-form-container {
            background: var(--blanco);
            border-radius: 16px;
            box-shadow: var(--sombra-card);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
        }

        /* ENCABEZADO */
        .login-header {
            background: linear-gradient(135deg, var(--azul-marino) 0%, var(--azul-marino-oscuro) 100%);
            color: var(--blanco);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid var(--naranja-brillante);
        }

        .login-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--naranja-brillante), var(--verde-esmeralda));
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .circular-logo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--verde-esmeralda);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 1rem;
            background: var(--azul-marino);
            transition: transform 0.3s ease;
        }

        .circular-logo:hover {
            transform: scale(1.03);
        }

        .tagline {
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 0.8rem;
            display: inline-block;
            padding: 0.4rem 1.2rem;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(4px);
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0) rotate(0deg); opacity: 0.8; }
            100% { transform: translateY(-600px) translateX(300px) rotate(720deg); opacity: 0; }
        }

        /* CUERPO DEL FORMULARIO */
        .login-body {
            padding: 2.5rem 2.5rem 2rem;
        }

        .form-horizontal-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .form-column {
            flex: 1 1 calc(50% - 0.75rem);
            min-width: 280px;
        }

        .input-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .input-group label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--azul-marino);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            color: #A0AEC0;
            font-size: 1.1rem;
            transition: color 0.2s;
            pointer-events: none;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem 0.8rem 0.75rem 2.4rem;
            border: 1px solid var(--gris-borde);
            border-radius: 8px;
            background-color: var(--gris-claro);
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            color: var(--texto-oscuro);
            transition: all 0.25s ease;
        }

        .input-field:focus {
            outline: none;
            background-color: var(--blanco);
            border-color: var(--verde-esmeralda);
            box-shadow: 0 0 0 3px rgba(46, 196, 182, 0.15);
        }

        .input-field:focus + .input-icon,
        .input-wrapper:focus-within .input-icon {
            color: var(--verde-esmeralda);
        }

        .input-field.is-invalid {
            border-color: var(--rojo-error);
            background-color: #FFF5F5;
        }

        .name-inputs-container {
            display: flex;
            gap: 0.75rem;
        }

        .name-inputs-container .input-wrapper {
            flex: 1;
        }

        /* TOGGLE PASSWORD */
        .toggle-password {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #A0AEC0;
            cursor: pointer;
            font-size: 1.1rem;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .toggle-password:hover {
            color: var(--azul-marino);
        }

        /* BOTÓN SUBMIT */
        .submit-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .submit-btn {
            background-color: var(--naranja-brillante);
            color: var(--blanco);
            border: none;
            border-radius: 8px;
            padding: 0.85rem 2.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.25);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .submit-btn:hover {
            background-color: var(--naranja-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(255, 107, 53, 0.35);
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #4A5568;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .register-link strong {
            color: var(--naranja-brillante);
        }

        .register-link:hover {
            color: var(--azul-marino);
        }

        .invalid-feedback {
            color: var(--rojo-error);
            font-size: 0.78rem;
            margin-top: 0.35rem;
            display: block;
            font-weight: 500;
        }

        @media (max-width: 767px) {
            .form-column {
                flex: 1 1 100%;
            }
            .name-inputs-container {
                flex-direction: column;
            }
            .login-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-form-container">
            <!-- ENCABEZADO -->
            <div class="login-header">
                <div class="particles" id="particles-js"></div>
                
                <div class="logo-container">
                    <img src="{{ asset('images/logo.png') }}" alt="Fitnflow" class="circular-logo">
                    <svg viewBox="0 0 800 90" xmlns="http://www.w3.org/2000/svg" class="svg-logo" style="max-width: 280px; height: auto;">
                        <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle"
                            font-family="Poppins, sans-serif" font-size="65" font-weight="700" fill="none"
                            stroke="#2EC4B6" stroke-width="2.5">
                            Fitnflow
                            <animate attributeName="stroke-dasharray" from="0, 1000" to="600, 0" dur="3s" repeatCount="indefinite" />
                            <animate attributeName="stroke-dashoffset" from="0" to="-600" dur="3s" repeatCount="indefinite" />
                        </text>
                    </svg>
                    <p class="tagline"><i class="bi bi-rocket-takeoff-fill"></i> Regístrate para empezar tu viaje fitness</p>
                </div>
            </div>

            <!-- CUERPO DEL FORMULARIO -->
            <div class="login-body">
                <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                    @csrf

                    <div class="form-horizontal-container">
                        <!-- Columna izquierda -->
                        <div class="form-column">
                            <!-- 1. Nombre completo -->
                            <div class="input-group">
                                <label><i class="bi bi-person-vcard"></i> 1. Nombre completo</label>
                                <div class="name-inputs-container">
                                    <div class="input-wrapper">
                                        <input id="names" type="text" name="names" placeholder="Nombres" 
                                               value="{{ old('names') }}" required autofocus
                                               class="input-field @error('names') is-invalid @enderror">
                                        <i class="bi bi-person input-icon"></i>
                                    </div>
                                    <div class="input-wrapper">
                                        <input id="last_name" type="text" name="last_name" placeholder="Apellidos" 
                                               value="{{ old('last_name') }}" required
                                               class="input-field @error('last_name') is-invalid @enderror">
                                        <i class="bi bi-person input-icon"></i>
                                    </div>
                                </div>
                                @error('names')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @error('last_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- 2. Email -->
                            <div class="input-group">
                                <label><i class="bi bi-envelope"></i> 2. Correo electrónico</label>
                                <div class="input-wrapper">
                                    <input id="email" type="email" name="email" placeholder="ejemplo@correo.com" 
                                           value="{{ old('email') }}" required
                                           class="input-field @error('email') is-invalid @enderror">
                                    <i class="bi bi-at input-icon"></i>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- 3. Fecha de nacimiento -->
                            <div class="input-group">
                                <label><i class="bi bi-calendar-date"></i> 3. Fecha de nacimiento</label>
                                <div class="input-wrapper">
                                    <input type="text" id="birth_date" name="birth_date" 
                                           placeholder="Selecciona tu fecha" readonly required
                                           value="{{ old('birth_date') }}"
                                           class="input-field @error('birth_date') is-invalid @enderror">
                                    <i class="bi bi-calendar3 input-icon"></i>
                                </div>
                                @error('birth_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Columna derecha -->
                        <div class="form-column">
                            <!-- 4. Género -->
                            <div class="input-group">
                                <label><i class="bi bi-gender-ambiguous"></i> 4. Género</label>
                                <div class="input-wrapper">
                                    <select name="gender" id="gender" required class="input-field @error('gender') is-invalid @enderror">
                                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Seleccione...</option>
                                        <option value="Masculino" {{ old('gender') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino" {{ old('gender') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ old('gender') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    <i class="bi bi-gender-ambiguous input-icon"></i>
                                </div>
                                @error('gender')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- 5. Contraseña -->
                            <div class="input-group">
                                <label><i class="bi bi-lock"></i> 5. Contraseña</label>
                                <div class="input-wrapper">
                                    <input id="password" type="password" name="password" placeholder="Mínimo 8 caracteres" 
                                           required minlength="8"
                                           class="input-field @error('password') is-invalid @enderror">
                                    <i class="bi bi-key input-icon"></i>
                                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password', 'toggleIcon1')">
                                        <i class="bi bi-eye" id="toggleIcon1"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- 6. Confirmar contraseña -->
                            <div class="input-group">
                                <label><i class="bi bi-shield-lock"></i> 6. Confirmar contraseña</label>
                                <div class="input-wrapper">
                                    <input id="password-confirm" type="password" name="password_confirmation" 
                                           placeholder="Repite tu contraseña" required
                                           class="input-field">
                                    <i class="bi bi-check2-circle input-icon"></i>
                                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password-confirm', 'toggleIcon2')">
                                        <i class="bi bi-eye" id="toggleIcon2"></i>
                                    </button>
                                </div>
                                <span class="invalid-feedback" id="confirm-password-error" style="display:none;">Las contraseñas no coinciden.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botón submit -->
                    <div class="submit-container">
                        <button type="submit" class="submit-btn">
                            <span>Completar Registro</span>
                            <i class="bi bi-arrow-right-short" style="font-size: 1.3rem;"></i>
                        </button>
                    </div>

                    <!-- Enlace login -->
                    <a href="{{ route('login') }}" class="register-link">
                        ¿Ya tienes una cuenta? <strong>Inicia sesión aquí</strong>
                    </a>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Flatpickr para mayores de 18 años
            flatpickr("#birth_date", {
                dateFormat: "Y-m-d",
                locale: "es",
                disableMobile: true,
                maxDate: new Date(new Date().setFullYear(new Date().getFullYear() - 18)),
                altInput: true,
                altFormat: "d/m/Y",
                ariaDateFormat: "d/m/Y"
            });

            // Partículas
            const particlesContainer = document.getElementById('particles-js');
            if (particlesContainer) {
                for (let i = 0; i < 15; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    const size = Math.random() * 3 + 1;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;
                    particle.style.animationDuration = `${Math.random() * 10 + 10}s`;
                    particle.style.animationDelay = `${Math.random() * 5}s`;
                    particlesContainer.appendChild(particle);
                }
            }

            // Validar coincidencia de contraseñas en vivo
            const pass = document.getElementById('password');
            const passConfirm = document.getElementById('password-confirm');
            const confirmError = document.getElementById('confirm-password-error');
            const form = document.getElementById('registerForm');

            function validatePasswords() {
                if (passConfirm.value.length > 0 && pass.value !== passConfirm.value) {
                    passConfirm.classList.add('is-invalid');
                    confirmError.style.display = 'block';
                    return false;
                } else {
                    passConfirm.classList.remove('is-invalid');
                    confirmError.style.display = 'none';
                    return true;
                }
            }

            passConfirm.addEventListener('input', validatePasswords);
            pass.addEventListener('input', validatePasswords);

            form.addEventListener('submit', function(e) {
                if (!validatePasswords()) {
                    e.preventDefault();
                }
            });
        });

        // Alternar visibilidad de contraseña
        function togglePasswordVisibility(fieldId, iconId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>