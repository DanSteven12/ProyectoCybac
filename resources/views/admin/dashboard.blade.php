@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="welcome-content text-center">
                        <div class="welcome-header mb-5">
                            <h1 class="display-3 fw-bold text-primary-dark mb-4">PANEL DE ADMINISTRACIÓN <span class="text-gradient">FITNFLOW</span></h1>
                            <p class="lead fs-2 text-muted">Herramientas completas para la gestión de tu gimnasio</p>
                            <div class="divider mx-auto my-4" style="width: 150px; height: 4px; background: linear-gradient(90deg, #1A365D 0%, #FF6B35 100%);"></div>
                        </div>

                        <div class="welcome-description mb-5">
                            <p class="fs-3 text-primary-dark opacity-75">Desde este panel podrás administrar todas las operaciones de tu centro fitness de manera eficiente y profesional.</p>
                        </div>

                        <!-- Segunda fila: Cards adicionales integradas -->
                        <div class="row g-4 mt-4">
                            <!-- Card: Control de Asistencia -->
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 80px; height: 80px;">
                                        <i class="fas fa-calendar-check fa-2x"></i>
                                    </div>
                                    <h3 class="h4 text-primary-dark mb-2">Control de Asistencia</h3>
                                    <p class="fs-5 text-muted">Lleva un seguimiento preciso de las asistencias a clases o servicios.</p>
                                </div>
                            </div>

                            <!-- Card: Gestión de Clases -->
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 80px; height: 80px;">
                                        <i class="fas fa-dumbbell fa-2x"></i>
                                    </div>
                                    <h3 class="h4 text-primary-dark mb-2">Gestión de Clases</h3>
                                    <p class="fs-5 text-muted">Programa clases, controla el cupo e inscribe participantes sin complicaciones.</p>
                                </div>
                            </div>

                            <!-- Card: Reportes Automatizados -->
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 80px; height: 80px;">
                                        <i class="fas fa-file-alt fa-2x"></i>
                                    </div>
                                    <h3 class="h4 text-primary-dark mb-2">Reportes Automatizados</h3>
                                    <p class="fs-5 text-muted">Obtén informes de uso, rendimiento y asistencia con un solo clic.</p>
                                </div>
                            </div>

                            <!-- Card: Comunicación Interna -->
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-info text-white rounded-circle d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 80px; height: 80px;">
                                        <i class="fas fa-bullhorn fa-2x"></i>
                                    </div>
                                    <h3 class="h4 text-primary-dark mb-2">Comunicación Interna</h3>
                                    <p class="fs-5 text-muted">Envía avisos y recordatorios automáticos a los usuarios del sistema.</p>
                                </div>
                            </div>

                            <!-- Card: Soporte Técnico -->
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 80px; height: 80px;">
                                        <i class="fas fa-headset fa-2x"></i>
                                    </div>
                                    <h3 class="h4 text-primary-dark mb-2">Soporte Técnico</h3>
                                    <p class="fs-5 text-muted">Accede a soporte y documentación para resolver cualquier inconveniente.</p>
                                </div>
                            </div>

                            <!-- Card: Panel Administrativo -->
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-dark text-white rounded-circle d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 80px; height: 80px;">
                                        <i class="fas fa-cogs fa-2x"></i>
                                    </div>
                                    <h3 class="h4 text-primary-dark mb-2">Panel Administrativo</h3>
                                    <p class="fs-5 text-muted">Administra el sistema de forma segura y personalizada desde un solo lugar.</p>
                                </div>
                            </div>
                        </div>

                        <div class="welcome-footer mt-5">
                            <p class="fs-3 text-primary-dark opacity-75 mb-0">Utiliza el menú superior para acceder a todas las funcionalidades del sistema.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos actualizados -->
<style>
    :root {
        --primary-dark: #1A365D;
        --primary-light: #E9F0F7;
    }

    .text-primary-dark { color: var(--primary-dark); }
    .bg-primary-light { background-color: var(--primary-light); }

    .text-gradient {
        background: linear-gradient(90deg, #1A365D 0%, #FF6B35 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .feature-card {
        transition: all 0.3s ease;
        background-color: white;
        text-align: center;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        font-size: 2rem;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        background-color: var(--primary-dark) !important;
        color: white !important;
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .display-3 {
            font-size: 2.5rem;
        }

        .lead.fs-2 {
            font-size: 1.5rem !important;
        }

        .feature-icon {
            width: 60px !important;
            height: 60px !important;
            font-size: 1.5rem !important;
        }
    }
</style>
@endsection