<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Interactivo FITNFLOW</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

        /* Estilos Base */
        * {
            box-sizing: border-box;
            font-family: "Nunito", sans-serif;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
        }

        body {
            padding-top: 100px; /* Ajustado para el navbar más grande */
        }

        /* Header Principal */
        .main-header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100px; /* Aumentado para acomodar logo de 80px */
            background: #2c3e50;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }

        /* Contenedor Logo */
        .logo-container {
            display: flex;
            align-items: center;
            height: 100%;
            flex: 1;
            min-width: 0;
            max-width: 70%; /* Limita el ancho para dejar espacio a los controles */
        }

        .logo {
            width: 80px; /* Tamaño fijo solicitado */
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #3498db;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .brand-name {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-left: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Controles Derecha */
        .header-controls {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: auto;
        }

        /* Botón Logout */
        .logout-button {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.4rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .logout-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        /* Botón Hamburguesa */
        .hamburger-btn {
            cursor: pointer;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            flex-shrink: 0;
        }

        .hamburger-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .hamburger-bar {
            width: 25px;
            height: 3px;
            background: white;
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
            background: rgba(0, 0, 0, 0.96);
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

        /* Tarjetas del Menú */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            width: 100%;
            max-width: 1200px;
            padding: 2rem;
        }

        .menu-card {
            background: #3498db;
            border-radius: 12px;
            padding: 1.5rem;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .menu-card:nth-child(1) { background: #2c3e50; }
        .menu-card:nth-child(2) { background: #e74c3c; }
        .menu-card:nth-child(3) { background: #2ecc71; }
        .menu-card:nth-child(4) { background: #9b59b6; }
        .menu-card:nth-child(5) { background: #6034db; }
        .menu-card:nth-child(6) { background: #26d8cf; }
        .menu-card:nth-child(7) { background: #b41212; }
        .menu-card:nth-child(8) { background: #c7db14; }
        .menu-card:nth-child(9) { background: #0b07da; }


        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .menu-card span {
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            z-index: 2;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-header {
                padding: 0 15px;
            }
            
            .brand-name {
                font-size: 1.6rem;
                margin-left: 15px;
            }
            
            .logout-button {
                padding: 8px 12px;
                font-size: 1.2rem;
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
                font-size: 1.4rem;
            }
            
            .hamburger-btn {
                width: 45px;
                height: 45px;
                padding: 8px;
            }
            
            .hamburger-bar {
                width: 22px;
                height: 2px;
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
            }
            
            .brand-name {
                font-size: 1.2rem;
                margin-left: 10px;
                max-width: 120px;
            }
            
            .logout-button {
                padding: 6px 10px;
                font-size: 1rem;
            }
            
            .header-controls {
                gap: 10px;
            }
        }

        @media (max-width: 400px) {
            .brand-name {
                display: none;
            }
            
            .logo {
                margin-left: 0;
            }
            
            .logout-button {
                padding: 5px 8px;
                font-size: 0.9rem;
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
        <div class="logo-container">
            <img src="/images/logo.png" alt="FITNFLOW" class="logo">
            <span class="brand-name">FITNFLOW</span>
        </div>
        
        <div class="header-controls">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="logout-button">
                    Cerrar Sesión
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
        <div class="menu-grid">
             <a href="{{ route('admin.dashboard') }}" class="menu-card">
                <span>Inicio</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="menu-card">
                <span>Usuarios</span>
            </a>
            <a href="{{ route('admin.roles.index') }}" class="menu-card">
                <span>Roles</span>
            </a>
            <a href="{{ route('admin.memberships.index') }}" class="menu-card">
                <span>Membresias</span>
             <a href="{{ route('admin.services.index') }}" class="menu-card">
                <span>Servicios</span>
            </a>
             <a href="{{ route('admin.requirements.index') }}" class="menu-card">
                <span>Requerimientos</span>
            </a>
            <a href="{{ route('admin.classes.index') }}" class="menu-card">
                <span>Clases</span>
            </a>
            <a href="{{ route('admin.payments.index') }}" class="menu-card">
                <span>Pagos</span>
            </a>
            <a href="/contacto" class="menu-card">
                <span>Contacto</span>
            </a>
        </div>
    </div>

    <script>
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const menuOverlay = document.getElementById('menuOverlay');

        function toggleMenu() {
            hamburgerBtn.classList.toggle('active');
            menuOverlay.classList.toggle('overlay-active');
            document.body.style.overflow = menuOverlay.classList.contains('overlay-active') ? 'hidden' : 'auto';
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