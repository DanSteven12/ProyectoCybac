@extends('layouts.app-master')

@section('content')

@php
    // Definimos las variables necesarias con valores por defecto
    $style = $settings->style ?? 'ring';
    $duration = $settings->duration ?? 20;
    $radius = $settings->radius ?? 300;
    $brightness = $settings->brightness_animation ?? false;
@endphp

<style>
    /* Filtro SVG para el efecto de resplandor */
    svg.svg-filters {
        position: absolute;
        width: 0;
        height: 0;
        overflow: hidden;
    }

    /* Paleta de colores */
    :root {
        --azul-marino: #1A365D;
        --naranja-brillante: #FF6B35;
        --verde-esmeralda: #2EC4B6;
        --blanco: #FFFFFF;
        --azul-oscuro: #0f2a4a;
    }

    /* Fondo general para eliminar espacios blancos */
    body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    /* Espacio superior ajustado */
    .header-spacer {
        height: 60px;
        background: linear-gradient(135deg, var(--azul-marino), var(--azul-oscuro));
    }

    /* Contenedor del carrusel con bordes ampliados */
    .carousel-container-3d {
        position: relative;
        perspective: 1200px;
        margin: 40px auto;
        height: 450px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(
            135deg,
            var(--azul-marino) 40%,
            var(--azul-oscuro) 60%,
            var(--naranja-brillante) 90%
        );
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        padding: 20px;
        overflow: hidden;
        z-index: 1;
    }

    /* Efecto de borde animado con SVG */
    .carousel-container-3d::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(
            45deg,
            var(--verde-esmeralda),
            var(--naranja-brillante),
            var(--azul-marino),
            var(--verde-esmeralda)
        );
        background-size: 300% 300%;
        border-radius: 25px;
        z-index: -1;
        animation: borderGlow 8s linear infinite;
        filter: url('#glow');
        opacity: 0.9;
    }

    /* Animación para el gradiente del borde */
    @keyframes borderGlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 300% 50%; }
    }

    /* Contenedor 3D */
    .card-3d {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        @if($style === 'ring')
            animation: autoRotate {{ $duration }}s linear infinite;
        @elseif($style === 'flat')
            animation: slideFlat {{ $duration }}s linear infinite;
        @endif
    }

    /* Tarjetas */
    .slide-card {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 220px;
        height: 320px;
        transform-origin: center center;
        border-radius: 12px;
        overflow: hidden;
        background-color: var(--blanco);
        border: 2px solid var(--verde-esmeralda);
        box-shadow: 0 5px 20px rgba(0,0,0,0.25);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        opacity: 1;
    }

    .slide-card:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 25px rgba(0,0,0,0.3);
    }

    .slide-card img {
        width: 100%;
        height: 260px;
        object-fit: contain;
        background-color: #fff;
        @if($brightness)
            animation: pulseBrightness 4s ease-in-out infinite;
        @endif
    }

    /* MODIFICACIÓN ÚNICA: Ajuste de posición del texto */
    .slide-description {
        background: var(--naranja-brillante);
        color: var(--blanco);
        text-align: left; /* Alineación izquierda */
        font-size: 0.95rem;
        padding: 8px 8px 8px 5px; /* Reducción del padding izquierdo */
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: flex-start; /* Contenido pegado a la izquierda */
        font-weight: 600;
    }

    /* Animaciones */
    @keyframes autoRotate {
        from { transform: rotateY(0deg); }
        to { transform: rotateY(360deg); }
    }

    @keyframes slideFlat {
        0% { transform: translateX(0); }
        50% { transform: translateX(-50%); }
        100% { transform: translateX(0); }
    }

    @keyframes pulseBrightness {
        0%, 100% { filter: brightness(1); }
        50% { filter: brightness(1.4); }
    }

    /* Estilos apilados */
    .slide-card.stacked-current {
        transform: translate(-50%, -50%) scale(1);
        z-index: 5;
        opacity: 1;
    }
    .slide-card.stacked-left {
        transform: translate(-150%, -50%) scale(0.85);
        z-index: 3;
        opacity: 0.8;
    }
    .slide-card.stacked-right {
        transform: translate(50%, -50%) scale(0.85);
        z-index: 2;
        opacity: 0.8;
    }
    .slide-card.stacked-hidden {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.7);
        z-index: 0;
    }

    /* Estilos para el resto del contenido */
    @media (max-width: 769px) {
        .content-wrapper {
            gap: 15px;
        }

        .map-container {
            height: 300px;
        }

        .activity-content {
            flex-direction: column !important;
            align-items: flex-start;
        }

        .activity img,
        .description {
            width: 100% !important;
        }

        .three-column-services {
            flex-direction: column;
        }
        
        .carousel-container-3d {
            height: 380px;
            margin: 20px auto 10px auto;
        }
        
        .slide-card {
            width: 180px;
            height: 280px;
        }
        
        .slide-card img {
            height: 220px;
        }
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .content-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .map-section {
        flex: 2;
        min-width: 0; /* Añadido para prevenir problemas de desbordamiento */
    }

    .map-header {
        margin-bottom: 25px;
    }

    .map-container {
        width: 100%;
        height: 400px;
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }

    .map-iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .directions-button {
        display: inline-block;
        background-color: var(--verde-esmeralda);
        color: white;
        padding: 12px 20px;
        font-size: 1rem;
        border-radius: 8px;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s ease;
        width: 100%; /* Hacer el botón más ancho en móviles */
        max-width: 300px; /* Limitar el ancho máximo */
        margin: 0 auto; /* Centrar el botón */
    }

    .directions-button:hover {
        background-color: #26a99f;
    }

    .info-section {
        flex: 1;
        background-color: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        min-width: 0; /* Añadido para prevenir problemas de desbordamiento */
    }

    .info-section h2 {
        color: var(--azul-marino);
        font-size: 1.5rem;
        border-bottom: 2px solid #eaeaea;
        padding-bottom: 10px;
    }

    .info-card {
        background-color: #F4F4F4;
        padding: 15px;
        border-radius: 8px;
        border-left: 40px solid var(--naranja-brillante);
        margin-bottom: 15px;
    }

    .info-card h3 {
        margin-top: 0;
        color: var(--naranja-brillante);
    }

    .info-card a {
        text-decoration: none;
        color: #333;
        display: block;
        padding: 6px 0;
    }

    .info-card a:hover {
        color: var(--naranja-brillante);
    }

    .services-buttons {
        margin-top: 60px;
    }

    .services-buttons h3 {
        color: var(--azul-marino);
        font-size: 1.75rem;
        margin-bottom: 20px;
    }

    .service-button {
        display: block;
        padding: 10px 14px;
        background-color: #ffffff;
        color: #333;
        text-decoration: none;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 12px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .service-button:hover {
        background-color: var(--naranja-brillante);
        color: white;
    }

    .three-column-services {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }

    .activities-section {
        margin-top: 50px;
    }

    .activity {
        margin-bottom: 50px;
    }

    .activity-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        flex-wrap: wrap;
    }

    .activity-content.left {
        flex-direction: row;
    }

    .activity-content.right {
        flex-direction: row-reverse;
    }

    .activity img {
        width: 50%;
        max-width: 600px;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .description {
        width: 45%;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        border-left: 5px solid var(--azul-marino);
        transition: transform 0.3s ease;
        word-wrap: break-word;
    }

    .description:hover {
        transform: translateY(-5px);
    }

    .description h3 {
        color: var(--azul-marino);
        font-size: 2rem;
        margin-bottom: 12px;
    }

    .description p {
        font-size: 1.15rem;
        color: #444;
        line-height: 1.8;
    }

    /* Media queries adicionales para mejor responsividad */
    @media (max-width: 992px) {
        .content-wrapper {
            flex-direction: column;
        }
        
        .map-section, 
        .info-section {
            flex: none;
            width: 100%;
        }
        
        .map-container {
            height: 350px;
        }
    }

    @media (max-width: 576px) {
        .map-container {
            height: 250px;
        }
        
        .directions-button {
            padding: 10px 15px;
            font-size: 0.9rem;
        }
        
        .info-section {
            padding: 15px;
        }
        
        .info-card {
            padding: 10px;
            border-left-width: 30px;
        }
    }
</style>

<!-- Filtros SVG para el efecto de resplandor -->
<svg class="svg-filters">
    <defs>
        <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
            <feGaussianBlur stdDeviation="5" result="blur" />
            <feComposite in="SourceGraphic" in2="blur" operator="over" />
        </filter>
    </defs>
</svg>

{{-- DEBUG TEMPORAL --}}
<pre>
Slides: {{ $slides->count() }}
Settings: {{ $settings ? 'OK' : 'NO SETTINGS' }}
</pre>

@if(isset($slides) && $slides->count())
    @php
        $count = $slides->count();
        $angle = 360 / $count;
    @endphp

    <div class="header-spacer"></div>

    <div class="carousel-container-3d">
        <div class="card-3d">
            @foreach($slides as $index => $slide)
                @php
                    $rotation = $angle * $index;
                    $transform = match($style) {
                        'ring' => "rotateY({$rotation}deg) translateZ({$radius}px)",
                        'flat' => "translateX(" . ($index * 240) . "px)",
                        default => ''
                    };
                    $zIndex = $style === 'stacked' ? $count - $index : 1;
                @endphp
                <div class="slide-card {{ $style === 'stacked' ? '' : '' }}"
                     style="transform: {{ $style !== 'stacked' ? 'translate(-50%, -50%) ' . $transform : '' }};
                            z-index: {{ $zIndex }};">
                    <a href="{{ $slide->link_url ?? '#' }}" target="_blank">
                        <img src="{{ asset('storage/' . $slide->image_path) }}" alt="Slide Image">
                    </a>
                    @if($slide->description)
                        <div class="slide-description">{{ $slide->description }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    @if($style === 'stacked')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cards = Array.from(document.querySelectorAll('.slide-card'));
            let currentIndex = 0;

            function updateStacked() {
                cards.forEach((card, index) => {
                    card.classList.remove('stacked-current', 'stacked-left', 'stacked-right', 'stacked-hidden');
                    const offset = (index - currentIndex + cards.length) % cards.length;
                    if (offset === 0) {
                        card.classList.add('stacked-current');
                    } else if (offset === 1) {
                        card.classList.add('stacked-right');
                    } else if (offset === cards.length - 1) {
                        card.classList.add('stacked-left');
                    } else {
                        card.classList.add('stacked-hidden');
                    }
                });
            }

            updateStacked();
            setInterval(() => {
                currentIndex = (currentIndex + 1) % cards.length;
                updateStacked();
            }, {{ $duration * 1000 }});
        });
    </script>
    @endif
@endif

<!-- Resto del contenido existente -->
<div class="content-wrapper">
    <!-- MAPA -->
    <div class="map-section">
        <div class="map-header">
            <center><h2>Nuestra ubicación</h2></center>
        </div>
        <div class="map-container">
            <iframe
                class="map-iframe"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.346830757997!2d-93.17619122508016!3d16.759411484024596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ecd9ec7cc2372d%3A0xaa879f1e51acb17a!2sPlaza%20la%20gloria!5e0!3m2!1ses!2smx!4v1749506336739!5m2!1ses!2smx"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
        <center>
            <button id="getDirectionsBtn" class="directions-button">Cómo llegar desde tu ubicación</button>
        </center>
    </div>

    <!-- INFORMACIÓN DEL CENTRO -->
    <section class="info-section">
        <center><h2>Información del Centro</h2></center>

        @if($centerInfo)
            <div class="info-card">
                <h3>Horarios</h3>
                <ul class="ps-3">
                    @foreach(explode("\n", $centerInfo->schedule ?? '') as $line)
                    @if(trim($line) !== '')
                    <p>{{ $line }}</p>
                    @endif
                    @endforeach
                </ul>
            </div>

            <div class="info-card">
                <h3>Contacto</h3>
                <h4><strong>Teléfono:</strong> {{ $centerInfo->phone }}</h4>
                <h4><strong>Email:</strong> {{ $centerInfo->email }}</h4>
                <h4><strong>Dirección:</strong> {{ $centerInfo->address }}</h4>
            </div>
        @else
            <div class="info-card">
                <p>No hay información disponible del centro.</p>
            </div>
        @endif

        <!-- SERVICIOS COMO VIÑETAS EN TRES COLUMNAS -->
        @if(isset($services) && $services->count() > 0)
            <div class="info-card">
                <h3>Nuestros Servicios</h3>
                <div class="three-column-services">
                    @php
                        $chunks = $services->take(12)->chunk(4);
                    @endphp
                    @foreach($chunks as $column)
                        <ul style="flex: 1; list-style-type: disc; padding-left: 20px;">
                            @foreach($column as $service)
                                <li>
                               <a href="#service-{{ $service->id }}" style="text-decoration: none; color: inherit;">
                                        {{ $service->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        @else
            <div class="info-card">
                <p>No hay servicios registrados.</p>
            </div>
        @endif
    </section>
</div>

<!-- DETALLES DE SERVICIOS -->
@if(isset($services) && $services->count() > 0)
    <div class="activities-section">
        @foreach($services as $index => $service)
            <div class="activity" id="service-{{ $service->id }}">
                <div class="activity-content {{ $index % 2 == 0 ? 'left' : 'right' }}">
                    @if($service->image_url)
                        <img src="{{ asset('storage/' . str_replace('public/', '', $service->image_url)) }}" alt="{{ $service->name }}">
                    @endif
                    <div class="description">
                        <h3>{{ $service->name }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center text-gray-500 mt-8">No hay servicios para mostrar.</p>
@endif

{{-- Scripts --}}
<script>
    // DIRECCIONES
    document.getElementById('getDirectionsBtn').addEventListener('click', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const destination = encodeURIComponent('Plaza La Gloria, Tuxtla Gutiérrez, Chiapas');
                    const mapsUrl = `https://www.google.com/maps/dir/?api=1&origin=${lat},${lng}&destination=${destination}&travelmode=driving`;
                    window.open(mapsUrl, '_blank');
                },
                function () {
                    alert('No se pudo obtener tu ubicación. Activa la geolocalización en tu navegador.');
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        } else {
            alert('Tu navegador no soporta geolocalización.');
        }
    });

    // SCROLL SUAVE
    document.querySelectorAll('a[href^="#service-"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // CARRUSEL
    let currentSlide = 0;
    const slides = document.querySelectorAll('#mainCarousel .carousel-slide');

    function showSlide(index) {
        slides.forEach(slide => slide.style.display = 'none');
        currentSlide = (index + slides.length) % slides.length;
        slides[currentSlide].style.display = 'block';
    }

    function moveSlide(step) {
        showSlide(currentSlide + step);
    }

    setInterval(() => moveSlide(1), 6000); // Auto-slide cada 6 segundos
</script>
@endsection