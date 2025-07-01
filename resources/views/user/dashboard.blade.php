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

    /* Paleta de colores profesional */
    :root {
        --azul-marino: #1A365D;
        --naranja-brillante: #FF6B35;
        --verde-esmeralda: #2EC4B6;
        --blanco: #FFFFFF;
        --azul-oscuro: #0f2a4a;
        --neon-glow: #2EC4B6;
        --sombra-azul: rgba(26, 54, 93, 0.2);
        --sombra-naranja: rgba(255, 107, 53, 0.2);
        --degradado-hero: linear-gradient(135deg, var(--azul-marino) 0%, var(--azul-oscuro) 100%);
        --degradado-botones: linear-gradient(to right, var(--naranja-brillante) 0%, var(--verde-esmeralda) 100%);
    }

    /* Estilos generales */
    body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8fafc;
        color: #333;
        line-height: 1.6;
    }

    /* Header spacer con degradado profesional */
    .header-spacer {
        height: 80px;
        background: var(--degradado-hero);
        box-shadow: 0 4px 12px var(--sombra-azul);
    }

    .carousel-container-3d {
    position: relative;
    perspective: 1200px;
    margin: 40px auto;
    height: 450px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(
        45deg,
        var(--verde-esmeralda),
        var(--naranja-brillante),
        var(--azul-marino),
        var(--verde-esmeralda)
    );
    border-radius: 0; /* Esquinas cuadradas */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    padding: 20px;
    z-index: 1; /* Cambiado de -1 a 1 para que esté sobre el fondo */
    animation: borderGlow 8s linear infinite;
    background-size: 300% 300%; /* Para la animación del gradiente */
    filter: url('#glow'); /* Efecto de iluminación SVG */
}



    /* Animación para el gradiente del borde - VERSIÓN ORIGINAL */
    @keyframes borderGlow {
        0% { background-position: 0% 50%; }
        100% { background-position: 300% 50%; }
    }

    /* Contenedor 3D - VERSIÓN ORIGINAL */
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

    /* Tarjetas - VERSIÓN ORIGINAL */
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

    /* MEJORA: Ajuste de imágenes en el carrusel */
    .slide-card img {
        width: 100%;
        height: 260px;
        object-fit: contain;
        background-color: #fff;
        padding: 15px; /* Añadido espacio interno */
        max-width: 100%; /* Asegura que no se desborde */
        max-height: 100%; /* Asegura que no se desborde */
        @if($brightness)
            animation: pulseBrightness 4s ease-in-out infinite;
        @endif
    }

    /* Descripción de la tarjeta - VERSIÓN ORIGINAL */
    .slide-description {
        background: var(--naranja-brillante);
        color: var(--blanco);
        text-align: left;
        font-size: 0.95rem;
        padding: 8px 8px 8px 5px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        font-weight: 600;
    }

    /* Animaciones - VERSIÓN ORIGINAL */
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

    /* Estilos apilados - VERSIÓN ORIGINAL */
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

    /* Estilos para el layout principal */
    .container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 30px;
    }

    .content-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        margin-top: 40px;
    }

    /* Sección del mapa - Diseño mejorado */
    .map-section {
        flex: 2;
        min-width: 0;
    }

    .map-header {
        margin-bottom: 30px;
        text-align: center;
    }

    .map-header h2 {
        color: var(--azul-marino);
        font-size: 2rem;
        margin-bottom: 10px;
        position: relative;
        display: inline-block;
    }

    .map-header h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: var(--naranja-brillante);
        font-size: 10rem;
    }

    .map-container {
        width: 100%;
        height: 450px;
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 25px var(--sombra-azul);
        margin-bottom: 25px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .map-iframe {
        width: 100%;
        height: 100%;
        border: none;
        filter: grayscale(20%) contrast(110%);
    }

    /* Botón de direcciones con efecto hover */
    .directions-button {
        display: inline-block;
        background: var(--degradado-botones);
        color: white;
        padding: 14px 28px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px var(--sombra-naranja);
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
    }

    .directions-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px var(--sombra-naranja);
    }

    .directions-button::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, var(--verde-esmeralda) 0%, var(--naranja-brillante) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        
    }


    /* Sección de información - Tarjetas modernas */
    .info-section {
        flex: 1;
        background-color: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        min-width: 0;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .info-section h2 {
        color: var(--azul-marino);
        font-size: 2.5rem;
        border-bottom: 2px solid var(--verde-esmeralda);
        padding-bottom: 15px;
        margin-bottom: 30px;
        text-align: center;
    }

    .info-card {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        border-left: 5px solid var(--naranja-brillante);
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
    }

    .info-card h3 {
        margin-top: 0;
        color: var(--azul-marino);
        font-size: 1.8rem;
        margin-bottom: 15px;
        position: relative;
        padding-bottom: 8px;
    }

    .info-card h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--naranja-brillante);
    }

    .info-card h4 {
        margin: 12px 0 5px 0;
        color: var(--azul-oscuro);
        font-size: 1.3rem;
    }

    .info-card p, .info-card a {
        color: #555;
        font-size: 1.5rem;
        line-height: 1.6;
    }

    .info-card a {
        text-decoration: none;
        display: block;
        padding: 8px 0;
        transition: color 0.3s ease;
    }

    .info-card a:hover {
        color: var(--naranja-brillante);
    }

    /* Servicios en tres columnas - Versión mejorada */
.three-column-services {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px; /* Aumenté el gap para mejor separación */
}

.three-column-services ul {
    flex: 1;
    min-width: 160px; /* Un poco más ancho */
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.three-column-services li {
    margin-bottom: 15px; /* Más espacio entre items */
    position: relative;
    padding-left: 25px; /* Más espacio para el bullet */
    line-height: 1.5; /* Mejor interlineado */
}

.three-column-services li::before {
    content: '•';
    color: var(--verde-esmeralda);
    font-size: 1.8rem; /* Bullet más grande (antes 1.5rem) */
    position: absolute;
    left: 0;
    top: -7px; /* Ajuste de posición por el tamaño */
}

.three-column-services a {
    color: var(--azul-oscuro);
    text-decoration: none;
    transition: all 0.3s ease;
    display: block;
    padding: 6px 0; /* Más padding vertical */
    font-size: 1.1rem; /* Tamaño aumentado (antes no tenía definido) */
    font-weight: 500; /* Peso medio para mejor legibilidad */
}

.three-column-services a:hover {
    color: var(--naranja-brillante);
    transform: translateX(8px); /* Efecto hover más notorio */
}

/* Ajustes responsivos */
@media (max-width: 768px) {
    .three-column-services a {
        font-size: 1rem; /* Tamaño ligeramente menor en móviles */
    }
    
    .three-column-services li::before {
        font-size: 1.6rem;
        top: -5px;
    }
}

@media (max-width: 576px) {
    .three-column-services {
        gap: 15px;
    }
    
    .three-column-services ul {
        min-width: 140px;
    }
}

    /* MEJORA: Sección de actividades/servicios con imágenes ajustadas */
    .activities-section {
        margin-top: 70px;
    }

    .activity {
        margin-bottom: 70px;
    }

    .activity-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        flex-wrap: wrap;
    }

    .activity-content.left {
        flex-direction: row;
    }

    .activity-content.right {
        flex-direction: row-reverse;
    }

    /* MEJORA PRINCIPAL: Ajuste de imágenes en el dashboard */
    .activity img {
        width: 50%;
        max-width: 400px; /* Reducido de 600px para mejor proporción */
        height: auto;
        max-height: 300px; /* Limita la altura máxima */
        object-fit: contain; /* Mantiene la proporción sin recortar */
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transition: transform 0.5s ease, box-shadow 0.5s ease;
        margin: 0 auto; /* Centra la imagen */
        display: block; /* Asegura que los márgenes funcionen */
    }

    .activity img:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .description {
        width: 45%;
        background-color: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border-left: 5px solid var(--naranja-brillante);
        transition: transform 0.5s ease;
    }

    .description:hover {
        transform: translateY(-10px);
    }

    .description h3 {
        color: var(--azul-marino);
        font-size: 2.2rem;
        margin-bottom: 20px;
        position: relative;
    }

    .description h3::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--verde-esmeralda);
    }

    .description p {
        font-size: 1.3rem;
        color: #555;
        line-height: 1.8;
        margin-top: 20px;
    }

    /* Media queries para responsividad */
    @media (max-width: 1200px) {
        .container {
            padding: 25px;
        }
        
        /* Ajustes para imágenes en pantallas grandes */
        .activity img {
            max-width: 350px;
        }
    }

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
            height: 400px;
        }
        
        .activity-content {
            gap: 30px;
        }
        
        .activity img,
        .description {
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Ajuste específico para imágenes en tablet */
        .activity img {
            max-height: 350px;
        }
    }

    @media (max-width: 768px) {
        .header-spacer {
            height: 60px;
        }
        
        .carousel-container-3d {
            height: 380px;
            margin: 30px auto;
            padding: 15px;
        }
        
        .slide-card {
            width: 180px;
            height: 280px;
        }
        
        .slide-card img {
            height: 220px;
        }
        
        .map-container {
            height: 350px;
        }
        
        .info-section {
            padding: 25px;
        }
        
        .description {
            padding: 25px;
        }
        
        .description h3 {
            font-size: 1.8rem;
        }
        
        /* Ajuste para imágenes en móviles */
        .activity img {
            max-height: 250px;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding: 15px;
        }
        
        .carousel-container-3d {
            height: 320px;
            margin: 20px auto;
        }
        
        .slide-card {
            width: 160px;
            height: 240px;
        }
        
        .slide-card img {
            height: 180px;
        }
        
        .map-container {
            height: 250px;
        }
        
        .directions-button {
            padding: 12px 20px;
            font-size: 1rem;
        }
        
        .info-card {
            padding: 15px;
        }
        
        .three-column-services {
            flex-direction: column;
        }
        
        .description {
            padding: 20px;
        }
        
        .description h3 {
            font-size: 1.6rem;
        }
        
        .description p {
            font-size: 1rem;
        }
        
        /* Ajuste final para imágenes en móviles pequeños */
        .activity img {
            max-height: 200px;
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
<div class="container">
    <div class="content-wrapper">
        <!-- MAPA -->
        <div class="map-section">
            <div class="map-header">
                <h2>Nuestra ubicación</h2>
                <p>Encuéntranos fácilmente en Plaza La Gloria</p>
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
            <h2>Información del Centro</h2>

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
                            <ul>
                                @foreach($column as $service)
                                    <li>
                                   <a href="#service-{{ $service->id }}">
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
</div>

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