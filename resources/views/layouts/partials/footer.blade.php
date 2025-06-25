<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit & Flow - Pie de página profesional</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .professional-footer {
            background: linear-gradient(to right, #0f2a4a, #1A365D);
            color: white;
            padding: 40px 0 20px; /* Reducido de 60px 0 30px */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            margin-top: auto;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px; /* Reducido de 30px */
            margin-bottom: 25px; /* Reducido de 40px */
        }

        .footer-brand {
            display: flex;
            flex-direction: column;
        }

        .footer-logo {
            font-size: 24px; /* Reducido de 28px */
            font-weight: 700;
            margin-bottom: 15px; /* Reducido de 20px */
            color: white;
            display: flex;
            align-items: center;
        }

        .footer-logo .highlight {
            color: #FF6B35;
        }

        .logo-icon-footer {
            font-size: 28px; /* Reducido de 32px */
            margin-right: 8px; /* Reducido de 10px */
            color: #FF6B35;
        }

        .footer-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6; /* Reducido de 1.7 */
            margin-bottom: 20px; /* Reducido de 25px */
            max-width: 300px;
            font-size: 0.9em; /* Reducción de tamaño de fuente */
        }

        .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Reducido de 12px */
            margin-bottom: 20px; /* Reducido de 25px */
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px; /* Reducido de 12px */
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9em; /* Reducción de tamaño de fuente */
        }

        .contact-icon {
            color: #FF6B35;
            font-size: 16px; /* Reducido de 18px */
            min-width: 20px; /* Reducido de 24px */
            margin-top: 3px;
        }

        .social-links {
            display: flex;
            gap: 12px; /* Reducido de 15px */
            margin-top: 12px; /* Reducido de 15px */
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px; /* Reducido de 40px */
            height: 36px; /* Reducido de 40px */
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            font-size: 16px; /* Reducido de 18px */
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #FF6B35;
            transform: translateY(-3px);
        }

        .footer-section h3 {
            font-size: 16px; /* Reducido de 18px */
            margin-bottom: 15px; /* Reducido de 20px */
            padding-bottom: 8px; /* Reducido de 10px */
            border-bottom: 2px solid #FF6B35;
            display: inline-block;
            color: #FF6B35;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px; /* Reducido de 12px */
            padding: 0;
            margin: 0;
        }

        .footer-links li a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px; /* Reducido de 8px */
            transition: all 0.3s ease;
            font-size: 0.9em; /* Reducción de tamaño de fuente */
        }

        .footer-links li a:hover {
            color: #FF6B35;
            transform: translateX(5px);
        }

        .footer-links li a i {
            font-size: 10px; /* Reducido de 12px */
            color: #FF6B35;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
        }

        .schedule-table td {
            padding: 6px 0; /* Reducido de 8px 0 */
            color: rgba(255, 255, 255, 0.85);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9em; /* Reducción de tamaño de fuente */
        }

        .schedule-table tr:last-child td {
            border-bottom: none;
        }

        .schedule-table tr td:first-child {
            font-weight: 500;
        }

        .schedule-table tr td:last-child {
            text-align: right;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px; /* Reducido de 20px */
            padding-top: 20px; /* Reducido de 30px */
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .copyright {
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px; /* Reducido de 15px */
        }

        .legal-links {
            display: flex;
            gap: 15px; /* Reducido de 20px */
        }

        .legal-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            font-size: 13px; /* Reducido de 15px */
        }

        .legal-links a:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #FF6B35;
            transition: all 0.3s ease;
        }

        .legal-links a:hover {
            color: white;
        }

        .legal-links a:hover:after {
            width: 100%;
        }

        .newsletter-form {
            display: flex;
            margin-top: 12px; /* Reducido de 15px */
        }

        .newsletter-input {
            flex: 1;
            padding: 10px 12px; /* Reducido de 12px 15px */
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 13px; /* Reducido de 14px */
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px; /* Reducido de 14px */
        }

        .newsletter-btn {
            background: #FF6B35;
            color: white;
            border: none;
            padding: 0 18px; /* Reducido de 0 20px */
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 13px; /* Reducido de 14px */
        }

        .newsletter-btn:hover {
            background: #FF9D71;
        }

        .newsletter-title {
            margin-top: 20px; /* Reducido de 25px */
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px; /* Reducido de 40px */
            }
            
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
            
            .legal-links {
                justify-content: center;
            }
            
            .footer-logo {
                justify-content: center;
            }
            
            .footer-description {
                max-width: 100%;
                text-align: center;
            }
            
            .social-links {
                justify-content: center;
            }
            
            .schedule-table tr td:last-child {
                text-align: left;
            }
        }
    </style>
</head>
<body>
<footer class="professional-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">
                    <i class="fas fa-dumbbell logo-icon-footer"></i>
                    <span>Fit & <span class="highlight">Flow</span></span>
                </div>
                <p class="footer-description">
                    Transformamos vidas a través del fitness, ofreciendo instalaciones de primera clase y programas personalizados para alcanzar tus metas.
                </p>
                
                <div class="footer-contact">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <span>Plaza La Gloria, Tuxtla Gutiérrez</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone-alt contact-icon"></i>
                        <span>(961) 270 3210</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope contact-icon"></i>
                        <span>fitnflow@gmail.com</span>
                    </div>
                </div>
                
                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Enlaces Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Inicio</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Clases</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Horarios</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Entrenadores</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Membresías</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Blog</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Actividades</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Baile</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Natación</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Yoga</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Horario de Atención</h3>
                <table class="schedule-table">
                    <tr>
                        <td>Lunes - Viernes</td>
                        <td>6:00 AM - 10:00 PM</td>
                    </tr>
                    <tr>
                        <td>Sábados</td>
                        <td>8:00 AM - 8:00 PM</td>
                    </tr>
                    <tr>
                        <td>Domingos</td>
                        <td>8:00 AM - 2:00 PM</td>
                    </tr>
                    <tr>
                        <td>Festivos</td>
                        <td>Cerrado</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="copyright">
                © 2025 Fit & Flow. Todos los derechos reservados.
            </div>
            <div class="legal-links">
                <a href="#">Aviso de Privacidad</a>
                <a href="#">Términos de Servicio</a>
                <a href="#">Política de Cookies</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>