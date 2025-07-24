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
            padding: 30px 0 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: space-between;
        }

        .footer-section {
            flex: 1 1 250px;
            min-width: 220px;
            margin-bottom: 20px;
        }

        .footer-logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .footer-logo-icon {
            font-size: 28px;
            color: #ff6b35;
        }

        .footer-logo-text {
            font-size: 24px;
            font-weight: bold;
        }

        .footer-logo-highlight {
            color: #ff6b35;
        }

        .footer-description {
            font-size: 14px;
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            gap: 16px;
            margin-top: 20px;
        }

        .social-link {
            color: #cbd5e1;
            font-size: 18px;
            transition: color 0.3s;
        }

        .social-link:hover {
            color: #ff6b35;
        }

        .footer-title {
            font-size: 18px;
            margin-bottom: 16px;
            font-weight: bold;
            color: #ff6b35;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 14px;
            line-height: 1.6;
        }

        .contact-icon {
            color: #ff6b35;
            margin-top: 3px;
        }

        .services-columns {
            display: flex;
            gap: 20px;
        }

        .services-column {
            flex: 1;
        }

        .services-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .service-item {
            margin-bottom: 10px;
        }

        .service-link {
            text-decoration: none;
            color: #cbd5e1;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .service-icon {
            color: #ff6b35;
            margin-right: 6px;
            font-size: 10px;
        }

        .schedule-container {
            background-color: #143a66;
            border-radius: 8px;
            padding: 15px;
            color: #e2e8f0;
            font-size: 14px;
        }

        .schedule-item {
            margin-bottom: 8px;
        }

        .schedule-label {
            font-weight: bold;
        }

        .footer-copyright {
            border-top: 1px solid #1e2f43;
            margin-top: 30px;
            padding-top: 15px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .professional-footer {
                padding: 25px 0 10px;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 25px;
            }
            
            .footer-section {
                flex: 1 1 100%;
                min-width: 100%;
                margin-bottom: 15px;
            }
            
            .services-columns {
                flex-direction: column;
                gap: 0;
            }
            
            .footer-copyright {
                margin-top: 20px;
                padding-top: 15px;
            }
            
            .footer-description,
            .contact-item,
            .service-link {
                font-size: 13px;
            }
            
            .footer-title {
                font-size: 16px;
                margin-bottom: 12px;
            }
        }

        @media (max-width: 480px) {
            .professional-footer {
                padding: 20px 0 5px;
            }
            
            .footer-container {
                padding: 0 10px;
            }
            
            .footer-content {
                gap: 20px;
            }
            
            .footer-logo-container {
                margin-bottom: 12px;
            }
            
            .footer-logo-icon {
                font-size: 24px;
            }
            
            .footer-logo-text {
                font-size: 20px;
            }
            
            .social-links {
                gap: 12px;
                margin-top: 15px;
            }
            
            .social-link {
                font-size: 16px;
            }
            
            .footer-copyright {
                font-size: 12px;
                margin-top: 15px;
                padding-top: 10px;
            }
        }
    </style>
</head>
<body>
<footer class="professional-footer">
    <div class="footer-container">
        <div class="footer-content">
            <!-- Logo y descripción -->
            <div class="footer-section">
                <div class="footer-logo-container">
                    <i class="fas fa-dumbbell footer-logo-icon"></i>
                    <span class="footer-logo-text">Fit & <span class="footer-logo-highlight">Flow</span></span>
                </div>
                <p class="footer-description">
                    Transformamos vidas a través del fitness, ofreciendo instalaciones de primera clase y programas personalizados para alcanzar tus metas.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Contacto -->
            <div class="footer-section">
                <h3 class="footer-title">Contacto</h3>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt contact-icon"></i>
                    <span>{{ $centerInfo->address ?? 'No disponible' }}</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone-alt contact-icon"></i>
                    <span>{{ $centerInfo->phone ?? 'No disponible' }}</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope contact-icon"></i>
                    <span>{{ $centerInfo->email ?? 'No disponible' }}</span>
                </div>
            </div>

            <!-- Servicios -->
            <div class="footer-section">
                <h3 class="footer-title">Servicios</h3>
                <div class="services-columns">
                    <div class="services-column">
                        <ul class="services-list">
                            @php
                                $servicesCount = count($services);
                                $half = ceil($servicesCount / 2);
                                $firstColumn = array_slice($services->toArray(), 0, $half);
                            @endphp
                            
                            @foreach($firstColumn as $service)
                                <li class="service-item">
                                    <a href="#service-{{ $service['id'] }}" class="service-link">
                                        <i class="fas fa-chevron-right service-icon"></i>
                                        {{ $service['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="services-column">
                        <ul class="services-list">
                            @php
                                $secondColumn = array_slice($services->toArray(), $half);
                            @endphp
                            
                            @foreach($secondColumn as $service)
                                <li class="service-item">
                                    <a href="#service-{{ $service['id'] }}" class="service-link">
                                        <i class="fas fa-chevron-right service-icon"></i>
                                        {{ $service['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Horario -->
            <div class="footer-section">
                <h3 class="footer-title">
                    <i class="fas fa-clock contact-icon"></i>
                    Horario de Atención
                </h3>
                <div class="schedule-container">
                    @if (!empty($centerInfo))
                        @if (!empty($centerInfo->opening_time) || !empty($centerInfo->closing_time))
                            <div class="schedule-item">
                                @if ($centerInfo->opening_time)
                                    <p style="margin: 4px 0;">
                                        <span class="schedule-label">Apertura:</span>
                                        {{ \Carbon\Carbon::parse($centerInfo->opening_time)->format('h:i A') }}
                                    </p>
                                @endif
                                @if ($centerInfo->closing_time)
                                    <p style="margin: 4px 0;">
                                        <span class="schedule-label">Cierre:</span>
                                        {{ \Carbon\Carbon::parse($centerInfo->closing_time)->format('h:i A') }}
                                    </p>
                                @endif
                            </div>
                        @else
                            <p style="color: #94a3b8;">Horario no disponible.</p>
                        @endif

                        @if (!empty($centerInfo->days))
                            <div class="schedule-item">
                                <span class="schedule-label">Días laborales:</span>
                                <span>{{ $centerInfo->days }}</span>
                            </div>
                        @endif
                    @else
                        <p style="color: #94a3b8;">Información del centro no disponible.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-copyright">
            © 2025 Fit & Flow. Todos los derechos reservados.
        </div>
    </div>
</footer>
</body>
</html>