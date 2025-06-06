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
            padding-top: 100px; /* Altura del navbar */
        }

        /* Header Principal */
        .main-header {
            position: fixed;
            top: 0;
            width: 100%;
            height: 90px;
            background: #2c3e50;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }

        /* Contenedor Logo */
        .logo-container {
            position: absolute;
            left: 20px;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #3498db;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-left: 100px;
        }

        .brand-name {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin-left: 30px;
        }

        /* Controles Derecha */
        .header-controls {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-left: auto;
        }

        /* Botón Logout */
        .logout-button {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .logout-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-header {
                padding: 0 1rem;
                height: 60px;
            }

            .logo {
                width: 40px;
                height: 40px;
                left: 10px;
            }

            .brand-name {
                font-size: 1.5rem;
                margin-left: 50px;
            }

            .header-controls {
                gap: 1rem;
            }

            .logout-button {
                padding: 6px 12px;
                font-size: 1.2rem;
            }

            .hamburger-btn {
                padding: 0.6rem;
            }

            .hamburger-bar {
                width: 22px;
            }

            .menu-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
                gap: 1rem;
            }

            .menu-card {
                min-height: 100px;
                padding: 1rem;
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
            
    </header>

</body>
</html>