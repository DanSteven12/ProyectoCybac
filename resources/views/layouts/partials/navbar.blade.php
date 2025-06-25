<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Usuario - FITNFLOW</title>
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
            min-height: 100vh;
            padding-top: 100px;
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

        /* Botón Hamburguesa */
        .hamburger-btn {
            cursor: pointer;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            flex-shrink: 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }

        .hamburger-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .hamburger-bar {
            width: 25px;
            height: 3px;
            background: var(--blanco);
            margin: 4px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .active .hamburger-bar:first-child {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .active .hamburger-bar:nth-child(2) {
            opacity: 0;
        }

        .active .hamburger-bar:last-child {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* Menú Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(26, 54, 93, 0.98);
            transform: translateX(-100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1001;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }

        .overlay-active {
            transform: translateX(0) !important;
        }

        /* Efecto de partículas en el overlay */
        .particles-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle-overlay {
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

        /* Tarjetas del Menú */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            width: 100%;
            max-width: 800px;
            padding: 2rem;
            position: relative;
            z-index: 2;
        }

        .menu-card {
            background: var(--verde-esmeralda);
            border-radius: 12px;
            padding: 2rem;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            cursor: pointer;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            border: 3px solid var(--azul-marino);
        }

        .menu-card::before {
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
            filter: blur(15px);
        }

        .menu-card:hover {
            transform: translateY(-8px) rotateX(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .menu-card i {
            color: var(--blanco);
            font-size: 3.5rem;
            margin-bottom: 15px;
            text-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);
        }

        .menu-card span {
            color: var(--blanco);
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);
        }

        .menu-card:nth-child(1) { background: var(--azul-marino); }
        .menu-card:nth-child(2) { background: var(--naranja-brillante); }
        .menu-card:nth-child(3) { background: var(--verde-esmeralda); }
        .menu-card:nth-child(4) { background: #1c5c9e; }
        .menu-card:nth-child(5) { background: #e05a2c; }
        .menu-card:nth-child(6) { background: #26d8cf; }


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
            
            .brand-name {
                font-size: 1.8rem;
            }
            
            .hamburger-btn {
                width: 45px;
                height: 45px;
                padding: 8px;
            }
            
            .hamburger-bar {
                width: 22px;
                height: 3px;
            }
            
            .menu-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
            }
            
            .menu-card {
                min-height: 130px;
                padding: 1.5rem;
            }
            
            .menu-card span {
                font-size: 1.6rem;
            }
            
            .welcome-message {
                font-size: 2.8rem;
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
            
            .menu-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1.2rem;
            }
            
            .menu-card {
                min-height: 110px;
                padding: 1.2rem;
            }
            
            .menu-card span {
                font-size: 1.4rem;
            }
            
            .welcome-message {
                font-size: 2.2rem;
            }
            
            .welcome-subtitle {
                font-size: 1.5rem;
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
            
            .menu-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .stat-card {
                padding: 20px;
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
            
            .hamburger-btn {
                width: 40px;
                height: 40px;
                padding: 6px;
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
            <img src="/images/logo.png" alt="FITNFLOW" class="logo">
            <span class="brand-name">FITNFLOW</span>
        </div>
        
        <div class="header-controls">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
            
            <div class="hamburger-btn" id="hamburgerBtn">
                <div class="hamburger-bar"></div>
                <div class="hamburger-bar"></div>
                <div class="hamburger-bar"></div>
            </div>
        </div>
    </header>

    <!-- Menú Overlay -->
    <div class="overlay" id="menuOverlay">
        <!-- Contenedor de partículas para el overlay -->
        <div class="particles-overlay" id="particlesOverlay"></div>
        
        <div class="menu-grid">
            <a href="{{ route('user.dashboard') }}" class="menu-card">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('user.memberships.index') }}" class="menu-card">
                <i class="fas fa-id-card"></i>
                <span>Membresías</span>
            </a>
            <a href="{{ route('user.payments.index') }}" class="menu-card">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Historial de Pagos</span>
            </a>
            @if ($hasApprovedMembership)
            <a href="{{ route('user.classes.index') }}" class="menu-card">
                <i class="fas fa-calendar-check"></i>
                <span>Reserva tus Clases</span>
            </a>
            <a href="{{ route('user.classes.history') }}" class="menu-card">
                <i class="fas fa-history"></i>
                <span>Historial de Clases</span>
            </a>
            @endif
        </div>
    </div>
    

    
    <script>
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const menuOverlay = document.getElementById('menuOverlay');
        const particlesOverlay = document.getElementById('particlesOverlay');
        const particlesNav = document.getElementById('particlesNav');

        function toggleMenu() {
            hamburgerBtn.classList.toggle('active');
            menuOverlay.classList.toggle('overlay-active');
            document.body.style.overflow = menuOverlay.classList.contains('overlay-active') ? 'hidden' : 'auto';
            
            // Si se abre el menú, generamos las partículas para el overlay
            if (menuOverlay.classList.contains('overlay-active')) {
                createOverlayParticles();
            }
        }

        // Event listeners
        hamburgerBtn.addEventListener('click', toggleMenu);
        
        document.querySelectorAll('.menu-card').forEach(card => {
            card.addEventListener('click', toggleMenu);
        });

        menuOverlay.addEventListener('click', (e) => {
            if(e.target === menuOverlay) toggleMenu();
        });

        document.addEventListener('keydown', (e) => {
            if(e.key === 'Escape' && menuOverlay.classList.contains('overlay-active')) {
                toggleMenu();
            }
        });

        // Crear efecto de partículas en el navbar
        function createNavbarParticles() {
            const particleCount = 10; // Cantidad reducida para navbar
            
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

        // Crear efecto de partículas en el overlay
        function createOverlayParticles() {
            // Limpiamos partículas existentes
            particlesOverlay.innerHTML = '';
            
            const particleCount = 25; // Cantidad adecuada para overlay
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle-overlay');
                
                // Tamaño aleatorio entre 1px y 3px
                const size = Math.random() * 2 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Posición aleatoria en el overlay
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Duración de animación aleatoria
                const duration = Math.random() * 15 + 15;
                particle.style.animationDuration = `${duration}s`;
                
                // Retraso inicial aleatorio
                particle.style.animationDelay = `${Math.random() * 5}s`;
                
                particlesOverlay.appendChild(particle);
            }
        }

        // Inicializar partículas
        document.addEventListener('DOMContentLoaded', function() {
            createNavbarParticles();
        });

        // Ajustar altura del overlay al cambiar tamaño de pantalla
        function adjustOverlayHeight() {
            if (menuOverlay.classList.contains('overlay-active')) {
                document.body.style.overflow = 'hidden';
            }
        }

        window.addEventListener('resize', adjustOverlayHeight);
    </script>
</body>
</html>