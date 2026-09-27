@extends('layouts.admi-app-master')

@section('content')
<div class="admin-dashboard-container py-3 px-md-4">
    <!-- Hero / Banner de Bienvenida y Acceso Rápido -->
    <div class="dashboard-hero-card mb-4">
        <div class="hero-header-row d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="hero-badge"><i class="fas fa-shield-halved me-1"></i> Panel Administrativo</span>
                </div>
                <h1 class="hero-title mb-1">Centro de Control <span class="text-accent">Cybac</span></h1>
                <p class="hero-subtitle mb-0">Monitoreo financiero, control de pagos y gestión operativa en tiempo real.</p>
            </div>
            <div class="hero-date-badge d-inline-flex align-items-center">
                <i class="far fa-calendar-check me-2 text-accent-light"></i>
                <span>{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>

        <!-- Barra de Acceso Rápido a Módulos -->
        <div class="quick-access-wrapper">
            <div class="quick-access-title mb-3 d-flex align-items-center">
                <i class="fas fa-bolt me-2 text-accent"></i> Acceso Rápido a Módulos
            </div>
            <div class="quick-access-grid">
                <!-- Clases -->
                <a href="{{ route('admin.classes.index') }}" class="quick-access-item">
                    <div class="quick-icon-box bg-gradient-navy">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <span class="quick-label">Clases</span>
                </a>

                <!-- Pagos -->
                <a href="{{ route('admin.payments.index') }}" class="quick-access-item">
                    <div class="quick-icon-box bg-gradient-orange">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <span class="quick-label">Pagos</span>
                </a>

                <!-- Membresías -->
                <a href="{{ route('admin.memberships.index') }}" class="quick-access-item">
                    <div class="quick-icon-box bg-gradient-teal">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <span class="quick-label">Membresías</span>
                </a>

                <!-- Carrusel -->
                <a href="{{ route('admin.carousel.index') }}" class="quick-access-item">
                    <div class="quick-icon-box bg-gradient-blue">
                        <i class="fas fa-images"></i>
                    </div>
                    <span class="quick-label">Carrusel</span>
                </a>

                <!-- Información -->
                <a href="{{ route('admin.center-information.index') }}" class="quick-access-item">
                    <div class="quick-icon-box bg-gradient-warm">
                        <i class="fas fa-circle-info"></i>
                    </div>
                    <span class="quick-label">Información</span>
                </a>

                <!-- Requerimientos -->
                <a href="{{ route('admin.requirements.index') }}" class="quick-access-item">
                    <div class="quick-icon-box bg-gradient-green">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <span class="quick-label">Requisitos</span>
                </a>

                <!-- Servicios -->
                <a href="{{ route('admin.service.index') }}" class="quick-access-item">
                    <div class="quick-icon-box bg-gradient-indigo">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <span class="quick-label">Servicios</span>
                </a>

                <!-- Usuarios -->
                <a href="{{ route('admin.users.index') }}" class="quick-access-item">
                    <div class="quick-icon-box bg-gradient-purple">
                        <i class="fas fa-users-gear"></i>
                    </div>
                    <span class="quick-label">Usuarios</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Tarjetas de Métricas Principales (KPIs) -->
    <div class="row g-3 mb-4">
        <!-- Tarjeta: Ingresos (30 días) -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="stat-card stat-card-primary h-100">
                <div class="stat-card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="stat-label">Ingresos (30 días)</span>
                            <h2 class="stat-value text-dark mb-0">${{ number_format($revenueLast30Days, 2) }}</h2>
                        </div>
                        <div class="stat-icon-wrapper stat-icon-primary">
                            <i class="fas fa-sack-dollar"></i>
                        </div>
                    </div>
                    <div class="stat-meta d-flex align-items-center">
                        <span class="meta-tag meta-tag-success me-2">
                            <i class="fas fa-arrow-trend-up me-1"></i> Facturación activa
                        </span>
                        <span class="meta-subtext">Pagos aprobados</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Pagos Aprobados -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="stat-card stat-card-success h-100">
                <div class="stat-card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="stat-label">Pagos Aprobados</span>
                            <h2 class="stat-value text-dark mb-0">{{ $paymentStatuses['approved'] }}</h2>
                        </div>
                        <div class="stat-icon-wrapper stat-icon-success">
                            <i class="fas fa-circle-check"></i>
                        </div>
                    </div>
                    <div class="stat-meta">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="meta-subtext">Efectividad de pagos</span>
                            <span class="meta-percentage">{{ $paymentStatuses['total'] > 0 ? round(($paymentStatuses['approved'] / $paymentStatuses['total']) * 100) : 0 }}%</span>
                        </div>
                        <div class="custom-progress-bar">
                            <div class="progress-fill bg-success" style="width: {{ $paymentStatuses['total'] > 0 ? round(($paymentStatuses['approved'] / $paymentStatuses['total']) * 100) : 0 }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Pagos Pendientes -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="stat-card stat-card-warning h-100">
                <div class="stat-card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="stat-label">Pagos Pendientes</span>
                            <h2 class="stat-value text-dark mb-0">{{ $paymentStatuses['pending'] }}</h2>
                        </div>
                        <div class="stat-icon-wrapper stat-icon-warning">
                            <i class="fas fa-clock-rotate-left"></i>
                        </div>
                    </div>
                    <div class="stat-meta d-flex align-items-center">
                        @if($paymentStatuses['pending'] > 0)
                            <span class="meta-tag meta-tag-warning me-2">
                                <i class="fas fa-triangle-exclamation me-1"></i> Por revisar
                            </span>
                            <span class="meta-subtext">Comprobantes en espera</span>
                        @else
                            <span class="meta-tag meta-tag-neutral me-2">
                                <i class="fas fa-check me-1"></i> Al día
                            </span>
                            <span class="meta-subtext">Sin pendientes</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Total de Transacciones -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="stat-card stat-card-info h-100">
                <div class="stat-card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="stat-label">Total Transacciones</span>
                            <h2 class="stat-value text-dark mb-0">{{ $paymentStatuses['total'] }}</h2>
                        </div>
                        <div class="stat-icon-wrapper stat-icon-info">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                    <div class="stat-meta d-flex align-items-center justify-content-between">
                        <span class="meta-subtext">
                            <span class="text-danger fw-semibold">{{ $paymentStatuses['rejected'] }}</span> rech. ·
                            <span class="text-secondary fw-semibold">{{ $paymentStatuses['expired'] }}</span> venc.
                        </span>
                        <span class="meta-tag meta-tag-info">
                            <i class="fas fa-database me-1"></i> Registro global
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Gráficos de Análisis -->
    <div class="row g-4 mb-4">
        <!-- Gráfico Principal: Ingresos Mensuales -->
        <div class="col-xl-8 col-lg-7">
            <div class="chart-card h-100">
                <div class="chart-card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <h3 class="chart-title mb-1">
                            <i class="fas fa-chart-area me-2 text-primary"></i>Evolución de Ingresos
                        </h3>
                        <p class="chart-subtitle mb-0">Comportamiento mensual de cobros aprobados</p>
                    </div>

                    <!-- Controles de rango de tiempo -->
                    <div class="d-flex align-items-center gap-2">
                        <div class="btn-group btn-group-sm range-btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary" onclick="setChartRange(6, this)">6M</button>
                            <button type="button" class="btn btn-outline-secondary active" onclick="setChartRange(12, this)">12M</button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light border dropdown-toggle" type="button" id="chartOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sliders"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="chartOptionsDropdown">
                                <li><h6 class="dropdown-header">Rango temporal</h6></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="updateChart(6)"><i class="fas fa-calendar-minus me-2 text-muted"></i>Últimos 6 meses</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="updateChart(12)"><i class="fas fa-calendar-days me-2 text-muted"></i>Últimos 12 meses</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="chart-card-body">
                    <div class="chart-canvas-container" style="position: relative; height: 340px;">
                        <canvas id="monthlyRevenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico Secundario: Distribución de Pagos -->
        <div class="col-xl-4 col-lg-5">
            <div class="chart-card h-100 d-flex flex-column">
                <div class="chart-card-header">
                    <h3 class="chart-title mb-1">
                        <i class="fas fa-chart-pie me-2 text-accent"></i>Distribución de Pagos
                    </h3>
                    <p class="chart-subtitle mb-0">Proporción general por estado de transacción</p>
                </div>

                <div class="chart-card-body flex-grow-1 d-flex flex-column justify-content-between">
                    <div class="chart-doughnut-container position-relative my-auto" style="height: 220px;">
                        <canvas id="paymentStatusChart"></canvas>
                    </div>

                    <!-- Leyenda interactiva personalizada -->
                    <div class="status-legend-grid mt-3 pt-3 border-top">
                        <div class="legend-status-item">
                            <div class="d-flex align-items-center mb-1">
                                <span class="legend-bullet bg-success me-2"></span>
                                <span class="legend-name">Aprobados</span>
                            </div>
                            <span class="legend-val text-dark fw-bold">{{ $paymentStatuses['approved'] }}</span>
                        </div>

                        <div class="legend-status-item">
                            <div class="d-flex align-items-center mb-1">
                                <span class="legend-bullet bg-warning me-2"></span>
                                <span class="legend-name">Pendientes</span>
                            </div>
                            <span class="legend-val text-dark fw-bold">{{ $paymentStatuses['pending'] }}</span>
                        </div>

                        <div class="legend-status-item">
                            <div class="d-flex align-items-center mb-1">
                                <span class="legend-bullet bg-danger me-2"></span>
                                <span class="legend-name">Rechazados</span>
                            </div>
                            <span class="legend-val text-dark fw-bold">{{ $paymentStatuses['rejected'] }}</span>
                        </div>

                        <div class="legend-status-item">
                            <div class="d-flex align-items-center mb-1">
                                <span class="legend-bullet bg-secondary me-2"></span>
                                <span class="legend-name">Vencidos</span>
                            </div>
                            <span class="legend-val text-dark fw-bold">{{ $paymentStatuses['expired'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Variables de Estilo del Dashboard */
    :root {
        --dash-navy: #1A365D;
        --dash-navy-dark: #0F2A4A;
        --dash-navy-light: #2A4365;
        --dash-orange: #FF6B35;
        --dash-teal: #2EC4B6;
        --dash-slate-50: #F8FAFC;
        --dash-slate-100: #F1F5F9;
        --dash-slate-200: #E2E8F0;
        --dash-slate-400: #94A3B8;
        --dash-slate-600: #475569;
        --dash-slate-800: #1E293B;
        --dash-shadow-sm: 0 2px 4px rgba(15, 23, 42, 0.04);
        --dash-shadow-md: 0 4px 16px rgba(15, 23, 42, 0.06);
        --dash-shadow-lg: 0 10px 30px rgba(15, 23, 42, 0.08);
        --dash-radius: 16px;
    }

    .admin-dashboard-container {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: var(--dash-slate-800);
    }

    /* Hero Card */
    .dashboard-hero-card {
        background: linear-gradient(135deg, var(--dash-navy) 0%, var(--dash-navy-dark) 100%);
        border-radius: var(--dash-radius);
        padding: 2.4rem 2.8rem;
        color: #ffffff;
        box-shadow: var(--dash-shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .dashboard-hero-card::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 240px;
        height: 240px;
        background: radial-gradient(circle, rgba(255, 107, 53, 0.25) 0%, rgba(255, 107, 53, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .dashboard-hero-card::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: 20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(46, 196, 182, 0.15) 0%, rgba(46, 196, 182, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        padding: 0.4rem 1rem;
        border-radius: 30px;
        font-size: 1.15rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        line-height: 1.2;
        color: #ffffff;
        letter-spacing: -0.5px;
    }

    .text-accent {
        color: var(--dash-orange);
    }

    .text-accent-light {
        color: var(--dash-teal);
    }

    .hero-subtitle {
        font-size: 1.35rem;
        color: rgba(255, 255, 255, 0.82);
        font-weight: 400;
    }

    .hero-date-badge {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 30px;
        padding: 0.8rem 1.6rem;
        font-size: 1.25rem;
        font-weight: 500;
        color: #ffffff;
        backdrop-filter: blur(6px);
        white-space: nowrap;
    }

    /* Acceso Rápido */
    .quick-access-wrapper {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.6rem 2rem;
        backdrop-filter: blur(8px);
        position: relative;
        z-index: 2;
    }

    .quick-access-title {
        font-size: 1.25rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(255, 255, 255, 0.9);
    }

    .quick-access-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(95px, 1fr));
        gap: 1.4rem;
        justify-content: center;
    }

    .quick-access-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none !important;
        padding: 1rem 0.6rem;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .quick-access-item:hover {
        background: rgba(255, 255, 255, 0.16);
        transform: translateY(-4px);
        border-color: rgba(255, 255, 255, 0.25);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .quick-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.8rem;
        margin-bottom: 0.7rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: transform 0.25s ease;
    }

    .quick-access-item:hover .quick-icon-box {
        transform: scale(1.1);
    }

    .quick-label {
        font-size: 1.15rem;
        font-weight: 600;
        color: #ffffff;
        text-align: center;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    /* Gradientes para iconos */
    .bg-gradient-navy   { background: linear-gradient(135deg, #1A365D, #2B6CB0); }
    .bg-gradient-orange { background: linear-gradient(135deg, #FF6B35, #F56565); }
    .bg-gradient-teal   { background: linear-gradient(135deg, #2EC4B6, #319795); }
    .bg-gradient-blue   { background: linear-gradient(135deg, #3182CE, #4299E1); }
    .bg-gradient-warm   { background: linear-gradient(135deg, #DD6B20, #ED8936); }
    .bg-gradient-green  { background: linear-gradient(135deg, #38A169, #48BB78); }
    .bg-gradient-indigo { background: linear-gradient(135deg, #4C51BF, #667EEA); }
    .bg-gradient-purple { background: linear-gradient(135deg, #805AD5, #9F7AEA); }

    /* Stat Cards */
    .stat-card {
        background: #ffffff;
        border: 1px solid var(--dash-slate-200);
        border-radius: var(--dash-radius);
        padding: 2rem;
        box-shadow: var(--dash-shadow-sm);
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--dash-shadow-md);
        border-color: #cbd5e1;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .stat-card-primary::before { background: linear-gradient(90deg, var(--dash-navy), var(--dash-blue, #3182ce)); }
    .stat-card-success::before { background: linear-gradient(90deg, #10B981, #34D399); }
    .stat-card-warning::before { background: linear-gradient(90deg, #F59E0B, #FBBF24); }
    .stat-card-info::before    { background: linear-gradient(90deg, var(--dash-teal), #38BDF8); }

    .stat-label {
        display: block;
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dash-slate-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2.6rem;
        font-weight: 700;
        line-height: 1.1;
        color: var(--dash-slate-800);
        letter-spacing: -0.5px;
    }

    .stat-icon-wrapper {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        flex-shrink: 0;
    }

    .stat-icon-primary { background: #EEF2FF; color: var(--dash-navy); }
    .stat-icon-success { background: #ECFDF5; color: #10B981; }
    .stat-icon-warning { background: #FFFBEB; color: #F59E0B; }
    .stat-icon-info    { background: #F0FDFA; color: var(--dash-teal); }

    .stat-meta {
        margin-top: 1.4rem;
        font-size: 1.15rem;
    }

    .meta-tag {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .meta-tag-success { background: #DCFCE7; color: #15803D; }
    .meta-tag-warning { background: #FEF3C7; color: #B45309; }
    .meta-tag-info    { background: #E0F2FE; color: #0369A1; }
    .meta-tag-neutral { background: #F1F5F9; color: var(--dash-slate-600); }

    .meta-subtext {
        color: var(--dash-slate-600);
        font-size: 1.15rem;
    }

    .meta-percentage {
        font-weight: 700;
        color: #10B981;
        font-size: 1.2rem;
    }

    .custom-progress-bar {
        width: 100%;
        height: 6px;
        background: #E2E8F0;
        border-radius: 10px;
        overflow: hidden;
    }

    .custom-progress-bar .progress-fill {
        height: 100%;
        border-radius: 10px;
        transition: width 0.6s ease;
    }

    /* Chart Cards */
    .chart-card {
        background: #ffffff;
        border: 1px solid var(--dash-slate-200);
        border-radius: var(--dash-radius);
        padding: 2.2rem;
        box-shadow: var(--dash-shadow-sm);
        transition: box-shadow 0.25s ease;
    }

    .chart-card:hover {
        box-shadow: var(--dash-shadow-md);
    }

    .chart-card-header {
        margin-bottom: 2rem;
    }

    .chart-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dash-slate-800);
        letter-spacing: -0.3px;
    }

    .chart-subtitle {
        font-size: 1.25rem;
        color: var(--dash-slate-600);
    }

    .range-btn-group .btn {
        font-size: 1.15rem;
        padding: 0.35rem 0.9rem;
        font-weight: 600;
        border-color: var(--dash-slate-200);
        color: var(--dash-slate-600);
    }

    .range-btn-group .btn.active {
        background: var(--dash-navy);
        color: #ffffff;
        border-color: var(--dash-navy);
    }

    /* Leyenda interactiva de Pagos */
    .status-legend-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.2rem;
    }

    .legend-status-item {
        background: var(--dash-slate-50);
        border: 1px solid var(--dash-slate-200);
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .legend-bullet {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .legend-name {
        font-size: 1.15rem;
        font-weight: 500;
        color: var(--dash-slate-600);
    }

    .legend-val {
        font-size: 1.35rem;
    }

    /* Responsive Queries */
    @media (max-width: 992px) {
        .dashboard-hero-card {
            padding: 2rem 1.8rem;
        }

        .hero-title {
            font-size: 2.2rem;
        }

        .stat-value {
            font-size: 2.2rem;
        }

        .quick-access-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 576px) {
        .dashboard-hero-card {
            padding: 1.6rem 1.4rem;
        }

        .hero-title {
            font-size: 1.9rem;
        }

        .hero-subtitle {
            font-size: 1.15rem;
        }

        .quick-access-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .chart-card {
            padding: 1.5rem;
        }

        .status-legend-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Toastify para notificaciones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Gráfico Doughnut de Estado de Pagos
    const paymentStatusCtx = document.getElementById('paymentStatusChart');
    if (paymentStatusCtx) {
        window.paymentStatusChart = new Chart(paymentStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Aprobados', 'Pendientes', 'Rechazados', 'Vencidos'],
                datasets: [{
                    data: [
                        {{ $paymentStatuses['approved'] }},
                        {{ $paymentStatuses['pending'] }},
                        {{ $paymentStatuses['rejected'] }},
                        {{ $paymentStatuses['expired'] }}
                    ],
                    backgroundColor: [
                        '#10B981', // Verde esmeralda (Aprobados)
                        '#F59E0B', // Ámbar cálido (Pendientes)
                        '#EF4444', // Rojo coral (Rechazados)
                        '#64748B'  // Slate (Vencidos)
                    ],
                    hoverBackgroundColor: [
                        '#059669',
                        '#D97706',
                        '#DC2626',
                        '#475569'
                    ],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1E293B',
                        titleColor: '#F8FAFC',
                        bodyColor: '#F8FAFC',
                        padding: 12,
                        cornerRadius: 8,
                        boxPadding: 6,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const value = context.raw || 0;
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return ` ${context.label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // 2. Gráfico Lineal de Ingresos Mensuales
    const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart');
    if (monthlyRevenueCtx) {
        const gradientFill = monthlyRevenueCtx.getContext('2d').createLinearGradient(0, 0, 0, 320);
        gradientFill.addColorStop(0, 'rgba(26, 54, 93, 0.22)');
        gradientFill.addColorStop(1, 'rgba(26, 54, 93, 0.00)');

        window.monthlyRevenueChart = new Chart(monthlyRevenueCtx, {
            type: 'line',
            data: {
                labels: @json($monthlyRevenueData['labels']),
                datasets: [{
                    label: "Ingresos",
                    tension: 0.35,
                    backgroundColor: gradientFill,
                    borderColor: "#1A365D",
                    borderWidth: 3,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: "#1A365D",
                    pointBorderColor: "#ffffff",
                    pointBorderWidth: 2,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: "#FF6B35",
                    pointHoverBorderColor: "#ffffff",
                    pointHoverBorderWidth: 3,
                    data: @json($monthlyRevenueData['data']),
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1E293B',
                        titleColor: '#F8FAFC',
                        bodyColor: '#F8FAFC',
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem) {
                                return ' Facturación: $' + Number(tooltipItem.raw).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748B',
                            font: {
                                size: 12,
                                family: 'Poppins'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: Math.ceil({{ $monthlyRevenueData['max'] }} * 1.2),
                        grid: {
                            color: '#E2E8F0',
                            drawBorder: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            color: '#64748B',
                            font: {
                                size: 12,
                                family: 'Poppins'
                            },
                            callback: function(value) {
                                return '$' + Number(value).toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }
});

// Función de actualización de rango
function setChartRange(months, element) {
    if (element) {
        document.querySelectorAll('.range-btn-group .btn').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
    }
    updateChart(months);
}

// Función para refrescar datos del gráfico
function updateChart(months) {
    if (!window.monthlyRevenueChart) return;

    fetch(`/admin/dashboard-data?months=${months}`)
        .then(response => {
            if (!response.ok) throw new Error('Error al obtener datos');
            return response.json();
        })
        .then(data => {
            window.monthlyRevenueChart.data.labels = data.labels;
            window.monthlyRevenueChart.data.datasets[0].data = data.data;
            const maxVal = Math.max(...data.data, 0);
            window.monthlyRevenueChart.options.scales.y.max = Math.ceil(maxVal > 0 ? maxVal * 1.2 : 100);
            window.monthlyRevenueChart.update();

            // Notificación elegante
            if (typeof Toastify === 'function') {
                Toastify({
                    text: `Vista actualizada: últimos ${months} meses`,
                    duration: 2500,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "linear-gradient(135deg, #1A365D, #0F2A4A)",
                        borderRadius: "8px",
                        fontSize: "1.2rem",
                        padding: "12px 20px"
                    }
                }).showToast();
            }
        })
        .catch(err => {
            console.error('Error al actualizar datos:', err);
        });
}
</script>
@endpush
