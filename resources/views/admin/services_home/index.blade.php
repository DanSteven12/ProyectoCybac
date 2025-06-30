@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex justify-content-between align-items-center">
                        <form onsubmit="event.preventDefault();" class="d-flex align-items-center" style="gap: 1rem;">
                            <div class="input-container">
                                <input 
                                    id="search-live"
                                    class="input" 
                                    type="text" 
                                    placeholder="Buscador............" 
                                    autocomplete="off"
                                    onkeyup="filtrarServiciosEnVivo()"/>
                            </div>
                        </form>
                        <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                            <i class="fas fa-concierge-bell me-3"></i>GESTIÓN DE SERVICIOS
                        </h2>
                        <a href="{{ route('admin.services_home.create') }}" class="btn py-2 px-4" style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                            <i class="fas fa-plus-circle me-2"></i> NUEVO SERVICIO
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if (session('success'))
                        <div class="alert alert-dismissible fade show m-4" role="alert" 
                            style="background-color: #2EC4B6; color: #FFFFFF; border-left: 5px solid #1A365D; font-size: 1.3rem;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-3 fs-4"></i>
                                <strong class="fs-5">{{ session('success') }}</strong>
                                <button type="button" class="btn-close btn-close-white ms-auto fs-5" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="border-top: none; width: 100%;">
                            <thead>
                                <tr style="background-color: #1A365D; color: #FFFFFF;">
                                    <th class="ps-4 py-3" style="font-weight: 600; font-size: 1.4rem;">Nombre</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Descripción</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">URL de Imagen</th>
                                    <th class="pe-4 py-3 text-center" style="font-weight: 600; font-size: 1.4rem; width: 15%;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                <tr style="border-bottom: 2px solid #F4F4F4;">
                                    <td class="ps-4" style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">{{ $service->name }}</td>
                                    <td class="wrap-text" style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">{{ $service->description }}</td>
                                    <td class="wrap-text" style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">
                                        <a href="{{ asset('storage/'.$service->image_url) }}" target="_blank" 
                                            class="btn py-1 px-3" 
                                            style="background-color: #2EC4B6; color: #FFFFFF; font-size: 1.2rem;">
                                                <i class="fas fa-expand me-1"></i> Ver Completa
                                        </a>
                                    </td>
                                    <td class="pe-4 text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.services_home.edit', $service->id) }}" class="btn py-1 px-2 mx-1" 
                                            style="background-color: #2EC4B6; color: #FFFFFF; font-size: 1.3rem; font-weight: 500;">
                                                <i class="fas fa-edit me-1"></i>EDITAR
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-concierge-bell fs-1" style="color: #1A365D; font-size: 3rem;"></i>
                                            <p class="mt-2 fs-5" style="font-size: 1.4rem; font-weight: 600;">No hay servicios registrados</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Contador con fuente más grande -->
                    <div class="card-footer py-4" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted" style="font-size: 1.3rem; font-weight: 500;">
                                <i class="fas fa-clipboard-list me-2"></i> MOSTRANDO <span class="fw-bold">{{ $services->count() }}</span> SERVICIOS REGISTRADOS
                            </div>
                        </div>
                    </div>

                    <!-- Eliminé la sección de paginación para mantener el funcionamiento original -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-size: 1.2rem;
    }
    
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .table th {
        padding: 12px 8px;
        text-transform: uppercase;
    }
    
    .table td {
        padding: 12px 8px;
        vertical-align: middle;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(46, 196, 182, 0.08);
        transform: translateY(-1px);
    }
    
    .alert {
        border-radius: 6px;
    }

    .wrap-text {
        white-space: normal;
        word-break: break-word;
    }

    /* Ajustes para móviles */
    @media (max-width: 992px) {
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .table th, .table td {
            white-space: nowrap;
            font-size: 1.0rem !important;
            padding: 10px 6px !important;
        }
        
        .btn {
            padding: 0.4rem 0.8rem !important;
            font-size: 1.0rem !important;
            min-width: auto !important;
        }
        
        .card-header h2 {
            font-size: 1.4rem !important;
        }
        
        .card-header .btn {
            font-size: 1.0rem !important;
            padding: 0.4rem 0.8rem !important;
        }
        
        .card-footer div {
            font-size: 1.0rem !important;
        }
    }

    /* Estilo del buscador */
    .input {
        width: 100%;
        max-width: 270px;
        height: 60px;
        padding: 12px;
        font-size: 18px;
        font-family: "Courier New", monospace;
        color: #1A365D;
        background-color: #2EC4B6;
        border: 4px solid #1A365D;
        border-radius: 0;
        outline: none;
        transition: all 0.3s ease;
        box-shadow: 8px 8px 0 #FF6B35;
    }

    .input::placeholder {
        color: rgba(26, 54, 93, 0.6);
    }

    .input:hover {
        transform: translate(-4px, -4px);
        box-shadow: 12px 12px 0 #FF6B35;
    }

    .input:focus {
        background-color: #1A365D;
        color: #fff;
        border-color: #FF6B35;
        animation: shake 0.5s ease-in-out;
    }

    .input:focus::placeholder {
        color: #fff;
    }

    .input-container {
        position: relative;
        width: 100%;
        max-width: 270px;
    }

    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-5px) rotate(-5deg); }
        50% { transform: translateX(5px) rotate(5deg); }
        75% { transform: translateX(-5px) rotate(-5deg); }
        100% { transform: translateX(0); }
    }
</style>

@section('scripts')
<script>
    // Filtro en vivo para servicios
    function filtrarServiciosEnVivo() {
        const input = document.getElementById("search-live").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");

            if (cells.length >= 3) {
                const nombre = cells[0].textContent.toLowerCase();       // Nombre
                const descripcion = cells[1].textContent.toLowerCase();   // Descripción
                const url = cells[2].textContent.toLowerCase();          // URL

                const coincide = nombre.includes(input) || 
                                descripcion.includes(input) || 
                                url.includes(input);

                rows[i].style.display = coincide ? "" : "none";
            }
        }
    }
</script>
@endsection
@endsection