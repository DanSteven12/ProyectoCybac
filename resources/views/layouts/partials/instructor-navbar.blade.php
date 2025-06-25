<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Interactivo FITNFLOW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Paleta de colores FITNFLOW */
        :root {
            --azul-marino: #1A365D;
            --naranja-brillante: #FF6B35;
            --verde-esmeralda: #2EC4B6;
            --blanco: #FFFFFF;
            --azul-oscuro: #0f2a4a;
        }

        /* Estilos Base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
        }

        body {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
}


        /* Header Principal */
        .main-header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100px;
            background: var(--azul-marino);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-bottom: 3px solid var(--naranja-brillante);
            overflow: hidden; /* Para contener partículas */
        }

        /* Contenedor de partículas para el navbar */
        .particles-nav {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1; /* Detrás del contenido */
        }

        .particle-nav {
            position: absolute;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            animation: float-nav 20s infinite linear;
        }

        @keyframes float-nav {
            0% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 0.7;
            }
            100% {
                transform: translateY(100px) translateX(100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Contenedor Logo */
        .logo-container {
            display: flex;
            align-items: center;
            height: 100%;
            flex: 1;
            min-width: 0;
            max-width: 70%;
            position: relative;
            z-index: 2; /* Encima de las partículas */
        }

        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--verde-esmeralda);
            box-shadow: 
                0 0 0 3px var(--azul-marino),
                0 5px 15px rgba(0, 0, 0, 0.2),
                inset 0 0 10px rgba(46, 196, 182, 0.3);
            background: var(--azul-marino);
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--verde-esmeralda);
            font-weight: bold;
            font-size: 1.8rem;
        }

        .brand-name {
            color: var(--blanco);
            font-size: 2.2rem;
            font-weight: 700;
            margin-left: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .brand-name::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--verde-esmeralda);
            border-radius: 3px;
        }

        /* Controles Derecha */
        .header-controls {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: auto;
            position: relative;
            z-index: 2;
        }

        /* Botón Logout */
        .logout-button {
            background: var(--naranja-brillante);
            color: var(--blanco);
            border: none;
            padding: 12px 20px;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.4rem;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-button:hover {
            background: #e05a2c;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
        }

        .logout-button::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                45deg,
                rgba(255, 255, 255, 0.2) 0%,
                rgba(255, 255, 255, 0.1) 100%
            );
            z-index: 1;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-header {
                padding: 0 15px;
            }
            
            .brand-name {
                font-size: 2rem;
                margin-left: 15px;
            }
            
            .logout-button {
                padding: 10px 16px;
                font-size: 1.3rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 90px;
            }
            
            .main-header {
                height: 90px;
            }
            
            .logo {
                width: 70px;
                height: 70px;
            }
            
        }

        @media (max-width: 576px) {
            .main-header {
                height: 85px;
                padding: 0 10px;
            }
            
            .logo {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .brand-name {
                font-size: 1.5rem;
                margin-left: 10px;
                max-width: 150px;
            }
            
            .logout-button {
                padding: 8px 12px;
                font-size: 1.2rem;
            }
            
            .header-controls {
                gap: 10px;
            }
            
        }

        @media (max-width: 480px) {
            .brand-name {
                font-size: 1.3rem;
                max-width: 120px;
            }
            
            .logo-container {
                max-width: 60%;
            }
            
            .logout-button {
                padding: 7px 10px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 360px) {
            .brand-name {
                display: none;
            }
            
            .logo {
                margin-left: 0;
            }
            
            .logout-button {
                padding: 6px 9px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Superior -->
    <header class="main-header">
        <!-- Contenedor de partículas para el navbar -->
        <div class="particles-nav" id="particlesNav"></div>
        
        <div class="logo-container">
            <div class="logo">FIT</div>
            <span class="brand-name">FITNFLOW</span>
        </div>
        
        <div class="header-controls">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </header>
    
    <script>
        // Crear efecto de partículas en el navbar
        function createNavbarParticles() {
            const particlesNav = document.getElementById('particlesNav');
            const particleCount = 12; // Cantidad reducida para navbar
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle-nav');
                
                // Tamaño más pequeño (1-2px)
                const size = Math.random() * 1 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Posición aleatoria en el navbar
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Duración de animación aleatoria
                const duration = Math.random() * 15 + 15;
                particle.style.animationDuration = `${duration}s`;
                
                // Retraso inicial aleatorio
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                particlesNav.appendChild(particle);
            }
        }

        // Inicializar partículas
        document.addEventListener('DOMContentLoaded', function() {
            createNavbarParticles();
        });
    </script>
</body>
</html>