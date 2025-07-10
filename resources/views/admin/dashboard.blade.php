@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Contenido principal -->
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
                        
                        <div class="features-container row g-4 mb-5">
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-primary-light text-primary-dark rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                        <i class="fas fa-users fa-3x"></i>
                                    </div>
                                    <h3 class="h2 text-primary-dark mb-3">Gestión de Usuarios</h3>
                                    <p class="fs-5 text-muted">Registra, edita y administra los miembros de tu gimnasio. Controla sus datos personales, historial de asistencia y progreso.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-primary-light text-primary-dark rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                        <i class="fas fa-credit-card fa-3x"></i>
                                    </div>
                                    <h3 class="h2 text-primary-dark mb-3">Validación de Pagos</h3>
                                    <p class="fs-5 text-muted">Revisa, aprueba o rechaza pagos de membresías. Genera reportes financieros y controla el flujo de ingresos.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-primary-light text-primary-dark rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                        <i class="fas fa-id-card fa-3x"></i>
                                    </div>
                                    <h3 class="h2 text-primary-dark mb-3">Gestión de Membresías</h3>
                                    <p class="fs-5 text-muted">Crea y configura diferentes tipos de membresías, asócialas a usuarios y realiza seguimiento de su estado.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-primary-light text-primary-dark rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                        <i class="fas fa-calendar-alt fa-3x"></i>
                                    </div>
                                    <h3 class="h2 text-primary-dark mb-3">Programación de Clases</h3>
                                    <p class="fs-5 text-muted">Organiza el calendario de actividades, asigna instructores y controla la asistencia a cada sesión.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-primary-light text-primary-dark rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                        <i class="fas fa-chart-line fa-3x"></i>
                                    </div>
                                    <h3 class="h2 text-primary-dark mb-3">Reportes y Estadísticas</h3>
                                    <p class="fs-5 text-muted">Genera reportes detallados de asistencia, pagos y progreso de los miembros con gráficos intuitivos.</p>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-3">
                                    <div class="feature-icon bg-primary-light text-primary-dark rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                        <i class="fas fa-cog fa-3x"></i>
                                    </div>
                                    <h3 class="h2 text-primary-dark mb-3">Configuración del Sistema</h3>
                                    <p class="fs-5 text-muted">Personaliza parámetros del sistema, roles de usuario y configuración general de la plataforma.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="welcome-footer mt-5">
                            <p class="fs-3 text-primary-dark opacity-75">Utiliza el menú superior para acceder a todas las funcionalidades del sistema.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-dark: #1A365D;
        --primary-light: #E9F0F7;
        --secondary: #FFC107;
        --danger: #FF6B35;
        --success: #28A745;
    }
    
    .text-primary-dark { color: var(--primary-dark); }
    .bg-primary-dark { background-color: var(--primary-dark); }
    .bg-primary-light { background-color: var(--primary-light); }
    
    .text-gradient {
        background: linear-gradient(90deg, #1A365D 0%, #FF6B35 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .card {
        border-radius: 1rem;
        overflow: hidden;
    }
    
    .feature-card {
        transition: all 0.3s ease;
        background-color: white;
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    
    .feature-icon {
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        background-color: var(--primary-dark) !important;
        color: white !important;
        transform: rotate(15deg) scale(1.1);
    }
    
    .divider {
        transition: all 0.5s ease;
    }
    
    .welcome-header:hover .divider {
        width: 200px;
    }
    
    @media (max-width: 768px) {
        .display-3 {
            font-size: 2.5rem;
        }
        
        .lead.fs-2 {
            font-size: 1.5rem !important;
        }
        
        .feature-card {
            margin-bottom: 2rem;
        }
        
        .feature-icon {
            width: 60px !important;
            height: 60px !important;
        }
        
        .feature-icon i {
            font-size: 2rem !important;
        }
    }
</style>
@endsection