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
                                      onkeyup="filtrarUsuariosEnVivo()"/>
                              </div>
                          </form>
                        <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                            <i class="fas fa-users me-3"></i>GESTIÓN DE USUARIOS
                        </h2>
                        <a href="{{ route('admin.users.create') }}" class="btn py-2 px-4" style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                            <i class="fas fa-plus-circle me-2"></i> NUEVO USUARIO
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
                                    <th class="ps-4 py-3" style="font-weight: 600; font-size: 1.4rem; width: 10%;">Nombres</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; width: 10%;">Apellidos</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; width: 15%;">Email</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; width: 8%;">Rol</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; width: 8%;">Estado</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; width: 12%;">Fecha Nac.</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; width: 8%;">Género</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; width: 10%;">Especialidad</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem; width: 10%;">Certificación</th>
                                    <th class="pe-4 py-3 text-center" style="font-weight: 600; font-size: 1.4rem; width: 15%;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr style="border-bottom: 2px solid #F4F4F4;">
                                    <td class="ps-4" style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">{{ $user->names }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">{{ $user->last_name }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">{{ $user->email }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">{{ $user->getRoleNames()->first() ?? 'N/A' }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">{{ $user->statuses->name ?? 'N/A' }}</td>
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">
                                        {{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d \d\e F \d\e Y') }}
                                    </td>  
                                    <td style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">{{ $user->gender }}</td>
                                    <td class="wrap-text" style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">
    {{ $user->specialty ?? 'N/A' }}
</td>
<td class="wrap-text" style="font-size: 1.4rem; color: #1A365D; font-weight: 500;">
    {{ $user->certification ?? 'N/A' }}
</td>

                                    <td class="pe-4 text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn py-1 px-2 mx-1" 
                                            style="background-color: #2EC4B6; color: #FFFFFF; font-size: 1.3rem; font-weight: 500;">
                                                <i class="fas fa-edit me-1"></i>EDITAR
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn py-1 px-2 mx-1 btn-eliminar" onclick="confirmarEliminacion(event)" 
                                                        style="font-size: 1.3rem; font-weight: 500;">
                                                    <i class="fas fa-trash-alt me-1"></i>ELIMINAR
                                                </button>   
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-users-slash fs-1" style="color: #1A365D; font-size: 3rem;"></i>
                                            <p class="mt-2 fs-5" style="font-size: 1.4rem; font-weight: 600;">No hay usuarios registrados</p>
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
                                <i class="fas fa-clipboard-list me-2"></i> MOSTRANDO <span class="fw-bold">{{ $users->count() }}</span> USUARIOS REGISTRADOS
                            </div>
                        </div>
                    </div>

                    @if($users->hasPages())
                    <div class="card-footer py-4" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                        <div class="d-flex justify-content-center">
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @endif
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

    .btn-eliminar {
        background-color: #FF6B35 !important;
        color: #FFFFFF !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
        min-width: 100px !important;
        border: none !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    /*Estilo del alert*/    
    .btn-eliminar {
        background-color: #FF6B35 !important;
        color: #FFFFFF !important;
        font-size: 1.3rem !important; /* Aumentado de 1.1rem */
        font-weight: 500 !important;
        min-width: 100px !important;
        border: none !important;
        transition: all 0.3s ease !important;
    }

    .swal2-actions {
        gap: 1.5rem !important;
        margin-top: 1.5rem !important;
    }
    
    .swal2-confirm, .swal2-cancel {
        padding: 0.6rem 1.5rem !important;
        margin: 0 !important;
    }

    .swal2-popup { 
        border-radius: 10px !important;
        border: 2px solid #1A365D !important;
        font-size: 1.3rem !important;
    }
    
    .swal2-title {
        color: #1A365D !important;
        font-size: 1.7rem !important;
        font-weight: 700 !important;
    }

    .swal2-icon.swal2-warning {
        color: #FF6B35 !important;
        border-color: #FF6B35 !important;
    }

    .swal2-confirm {
        background-color: #FF6B35 !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
    }

    .swal2-cancel {
        background-color: #2EC4B6 !important;
        font-size: 1.3rem !important;
        font-weight: 500 !important;
    }

    .pagination .page-item.active .page-link {
        background-color: #1A365D;
        border-color: #1A365D;
        font-size: 1.1rem;
        padding: 0.5rem 0.9rem;
    }

    .pagination .page-link {
        color: #1A365D;
        font-size: 1.1rem;
        padding: 0.5rem 0.9rem;
    }

    .badge {
        padding: 0.5em 0.9em;
        font-size: 1.1rem;
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
    .wrap-text {
    white-space: normal;
    word-break: break-word;
    }


    /* source(buscador) */
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
  color: rgba(26, 54, 93, 0.6); /* azul con transparencia */
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

.input:valid {
  animation: typing 2s steps(30, end);
}

.input:not(:placeholder-shown) {
  font-weight: bold;
  letter-spacing: 1px;
  text-shadow: 0px 0px 0 #000;
  animation: glitch 1s linear infinite;
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

@keyframes typing {
  from { width: 0; }
  to { width: 100%; }
}

@keyframes glitch {
  0%, 10%, 27%, 35%, 52%, 80%, 100% { transform: none; opacity: 1; }
  7% { transform: skew(-0.5deg, -0.9deg); opacity: 0.75; }
  30% { transform: skew(0.8deg, -0.1deg); opacity: 0.75; }
  55% { transform: skew(-1deg, 0.2deg); opacity: 0.75; }
  75% { transform: skew(0.4deg, 1deg); opacity: 0.75; }
}

@keyframes blink {
  50% { opacity: 0; }
}

.input:focus + .input-container::after {
  color: #fff;
}
</style>

@section('scripts')
<script>
    // Función para confirmación de eliminación
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');
        
        Swal.fire({
            title: '¿Eliminar Usuario?',
            html: `<div style="text-align: center;">
                    <i class="fas fa-exclamation-triangle" style="color: #FF6B35; font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>¿Está seguro que desea eliminar este usuario permanentemente?</p>
                    <p style="font-weight: 600;">Esta acción no se puede deshacer.</p>
                </div>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-trash-alt me-2"></i> Eliminar',
            cancelButtonText: '<i class="fas fa-times me-2"></i> Cancelar',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-eliminar',
                cancelButton: 'btn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // source(buscador)
    // Posiciona el cursor al final del texto del input al cargar
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('search-input');
    if (input) {
        input.focus();
        input.setSelectionRange(0, 0); // Cursor al inicio
    }
});

// Filtro en vivo por ROL (columna 4, índice 3)
function filtrarUsuariosEnVivo() {
    const input = document.getElementById("search-live").value.toLowerCase();
    const table = document.querySelector("table tbody");
    const rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");

        if (cells.length >= 6) {
            const nombre = cells[0].textContent.toLowerCase();       // Nombres
            const apellido = cells[1].textContent.toLowerCase();     // Apellidos
            const email = cells[2].textContent.toLowerCase();        // Email
            const fecha = cells[5].textContent.toLowerCase();        // Fecha de nacimiento

            const coincide = nombre.includes(input) || apellido.includes(input) ||
                              email.includes(input) || fecha.includes(input);

            rows[i].style.display = coincide ? "" : "none";
        }
    }
}
</script>

@endsection