@extends('layouts.app-master')

@section('content')
<style>
    /* Paleta de colores FITNFLOW */
    :root {
        --azul-marino: #1A365D;
        --naranja-brillante: #FF6B35;
        --verde-esmeralda: #2EC4B6;
        --blanco: #FFFFFF;
        --azul-oscuro: #0f2a4a;
        --neon-glow: #2EC4B6;
        --sombra-verde: rgba(46, 196, 182, 0.3);
        --sombra-naranja: rgba(255, 107, 53, 0.4);
    }

    /* Estilos generales */
    body {
        background-color: var(--azul-oscuro);
        color: var(--blanco);
        cursor: default;
    }

 .container h1 {
    color: #1A365D; /* Dorado clásico */
    text-align: center;
    margin: 2rem 0;
    font-weight: 700;
    font-size: 2.5rem;
    text-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
    line-height: 1.3;
    letter-spacing: 1px;
}




.container h1::after {
    content: '';
    display: block;
    width: 120px;
    height: 4px;
    margin: 1rem auto 0;
    border-radius: 4px;
    background: linear-gradient(
        90deg,
        var(--azul-marino),
        var(--azul-oscuro),
        var(--verde-esmeralda),
        var(--naranja-brillante),
        var(--blanco)
    );
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}


    /* Estilos para las tarjetas animadas */
    .e-card {
        margin: 30px auto;
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0px 8px 28px -9px rgba(0,0,0,0.45);
        position: relative;
        width: 100%;
        max-width: 300px;
        height: auto;
        min-height: 500px;
        border-radius: 16px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding-bottom: 1rem;
        display: flex;
        flex-direction: column;
    }

    .e-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px var(--sombra-verde);
    }

    .wave {
        position: absolute;
        width: 540px;
        height: 700px;
        opacity: 0.6;
        left: 0;
        top: 0;
        margin-left: -50%;
        margin-top: -70%;
        background: linear-gradient(744deg, var(--azul-marino), var(--verde-esmeralda) 60%, var(--naranja-brillante));
        border-radius: 40%;
        animation: wave 55s infinite linear;
    }

    .wave:nth-child(2) {
        top: 210px;
        animation-duration: 50s;
        background: linear-gradient(744deg, var(--verde-esmeralda), var(--naranja-brillante) 60%, var(--azul-marino));
    }

    .wave:nth-child(3) {
        top: 210px;
        animation-duration: 45s;
        background: linear-gradient(744deg, var(--naranja-brillante), var(--azul-marino) 60%, var(--verde-esmeralda));
    }

    .playing .wave {
        animation: wave 3000ms infinite linear;
    }

    .playing .wave:nth-child(2) {
        animation-duration: 4000ms;
    }

    .playing .wave:nth-child(3) {
        animation-duration: 5000ms;
    }

    @keyframes wave {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .icon-container {
        display: flex;
        justify-content: center;
        margin-bottom: 0.5rem;
    }

    .icon {
        width: 3em;
        color: var(--verde-esmeralda);
        filter: drop-shadow(0 0 5px var(--sombra-verde));
    }

    .infotop {
        text-align: center;
        font-size: 20px;
        position: relative;
        top: 3em; /* Ajustado para subir el contenido */
        left: 0;
        right: 0;
        color: var(--blanco);
        font-weight: 600;
        z-index: 1;
        padding: 0 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .infotop strong {
        color: var(--verde-esmeralda);
        display: block;
        margin-bottom: 0.5rem;
        font-size: 1.5rem;
    }

    .description-container {
        position: relative;
        margin: 0.5rem 0 1rem 0; /* Ajustado el margen */
        flex-grow: 1;
        min-height: 100px;
    }

    .description-text {
        font-size: 14px;
        font-weight: 300;
        text-transform: lowercase;
        opacity: 0.8;
        line-height: 1.5;
        transition: max-height 0.4s ease;
        overflow: hidden;
        text-align: left;
        word-break: break-word;
    }

    .description-text.collapsed {
        max-height: 60px;
    }

    .description-text.expanded {
        max-height: 500px;
    }

    .description-text.collapsed::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 30px;
        background: linear-gradient(to bottom, transparent, rgba(15, 42, 74, 0.8));
    }

    .toggle-description {
        background: none;
        border: none;
        color: var(--naranja-brillante);
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 0.3rem;
        display: inline-flex;
        align-items: center;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        transition: all 0.2s ease;
        z-index: 2;
        position: relative;
    }

    .toggle-description:hover {
        color: var(--blanco);
        background: rgba(255, 107, 53, 0.2);
    }

    .toggle-description i {
        margin-left: 0.3rem;
        font-size: 0.7rem;
        transition: transform 0.3s ease;
    }

    .toggle-description.expanded i {
        transform: rotate(180deg);
    }

    .membership-details {
        margin-top: auto;
        padding: 5rem;
        background: rgba(15, 42, 74, 0.7);
        border-radius: 8px;
        margin-bottom: 6rem;
    }

    .membership-details small {
        display: block;
        margin-bottom: 0.3rem;
        font-weight: 300;
    }

    .membership-details strong {
        color: var(--naranja-brillante);
        font-weight: 500;
    }

    .btn-light {
        background-color: var(--verde-esmeralda);
        color: var(--azul-marino);
        border: none;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 0.5rem;
        box-shadow: 0 4px 15px var(--sombra-verde);
        align-self: center;
    }

    .btn-light:hover {
        background-color: var(--naranja-brillante);
        color: var(--blanco);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px var(--sombra-naranja);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .e-card {
            max-width: 100%;
        }
        
        .description-text {
            font-size: 13px;
        }
    }
</style>

<div class="container">
    <h1 class="mb-4">Membresías Disponibles</h1>

    <div class="row justify-content-center">
        @foreach($memberships as $membership)
            <div class="col-md-4 d-flex justify-content-center">
                <div class="e-card playing">
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>

                    <div class="infotop">
                        <div class="icon-container">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="icon">
                                <path fill="currentColor" d="M19.4133 4.89862L14.5863 2.17544C12.9911 1.27485 11.0089 1.27485 9.41368 2.17544L4.58674
                                4.89862C2.99153 5.7992 2 7.47596 2 9.2763V14.7235C2 16.5238 2.99153 18.2014 4.58674 19.1012L9.41368
                                21.8252C10.2079 22.2734 11.105 22.5 12.0046 22.5C12.6952 22.5 13.3874 22.3657 14.0349 22.0954C14.2204
                                22.018 14.4059 21.9273 14.5872 21.8252L19.4141 19.1012C19.9765 18.7831 20.4655 18.3728 20.8651
                                17.8825C21.597 16.9894 22 15.8671 22 14.7243V9.27713C22 7.47678 21.0085 5.7992 19.4133 4.89862ZM4.10784
                                14.7235V9.2763C4.10784 8.20928 4.6955 7.21559 5.64066 6.68166L10.4676 3.95848C10.9398 3.69152 11.4701
                                3.55804 11.9996 3.55804C12.5291 3.55804 13.0594 3.69152 13.5324 3.95848L18.3593 6.68166C19.3045 7.21476
                                19.8922 8.20928 19.8922 9.2763V9.75997C19.1426 9.60836 18.377 9.53091 17.6022 9.53091C14.7929 9.53091
                                12.1041 10.5501 10.0309 12.3999C8.36735 13.8847 7.21142 15.8012 6.68783 17.9081L5.63981 17.3165C4.69466
                                16.7834 4.10699 15.7897 4.10699 14.7235H4.10784ZM10.4676 20.0413L8.60933 18.9924C8.94996 17.0479 9.94402
                                15.2665 11.4515 13.921C13.1353 12.4181 15.3198 11.5908 17.6022 11.5908C18.3804 11.5908 19.1477 11.6864
                                19.8922 11.8742V14.7235C19.8922 15.2278 19.7589 15.7254 19.5119 16.1662C18.7615 15.3596 17.6806 14.8528
                                 16.4783 14.8528C14.2136 14.8528 12.3781 16.6466 12.3781 18.8598C12.3781 19.3937 12.4861 19.9021 12.68
                                 20.3676C11.9347 20.5316 11.1396 20.4203 10.4684 20.0413H10.4676Z"></path>
                            </svg>
                        </div>
                        
                        <strong>{{ $membership->name }}</strong>
                        
                        <div class="description-container">
                            <div class="description-text collapsed" id="desc-{{ $membership->id }}">
                                {{ $membership->description }}
                            </div>
                            @if(strlen($membership->description) > 120)
                                <button class="toggle-description" data-target="desc-{{ $membership->id }}">
                                    Ver más <i class="fas fa-chevron-down"></i>
                                </button>
                            @endif
                        </div>
                        
                        <div class="membership-details">
                            <small><strong>Precio:</strong> ${{ number_format($membership->price, 2) }}</small>
                            <small><strong>Duración:</strong> {{ $membership->readable_duration }}</small>
                            <br>
                            <a href="{{ route('user.memberships.pay', $membership->id) }}" class="btn btn-light btn-sm">Contratar</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-description');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const description = document.getElementById(targetId);
                const isExpanded = description.classList.contains('expanded');
                
                description.classList.toggle('expanded');
                description.classList.toggle('collapsed');
                this.classList.toggle('expanded');
                
                if (isExpanded) {
                    this.innerHTML = 'Ver más <i class="fas fa-chevron-down"></i>';
                } else {
                    this.innerHTML = 'Ver menos <i class="fas fa-chevron-up"></i>';
                }
            });
        });
    });
</script>

<!-- Agregar FontAwesome para los íconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection