@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid px-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-10">
            <div class="card shadow-sm" style="border: 2px solid #1A365D;">
                <div class="card-header py-3" style="background-color: #1A365D; color: #FFFFFF; border-bottom: 3px solid #FF6B35;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center" style="gap: 1rem;">
                 <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex align-items-center" style="gap: 1rem;">
    <div class="input-container">
        <input 
            name="search"
            value="{{ request('search') }}"
            class="input" 
            type="text" 
            placeholder="Buscar usuarios..." 
            autocomplete="off"/>
    </div>

    <select name="roleFilter" class="form-select" onchange="this.form.submit()">
        <option value="2" {{ request('roleFilter', '2') == '2' ? 'selected' : '' }}>Usuarios</option>
        <option value="3" {{ request('roleFilter') == '3' ? 'selected' : '' }}>Instructores</option>
    </select>
  <!-- Botón para ver administrador -->
                              <button type="button" class="btn py-2 px-4" style="background-color: #1A365D; color: #FFFFFF; font-weight: 600; font-size: 1.3rem; border: 2px solid #FF6B35;" onclick="mostrarAdministrador()">
                                  <i class="fas fa-user-shield me-2"></i> ADMINISTRADOR
                              </button>

    <button type="submit" class="btn py-2 px-4" style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
        <i class="fas fa-search me-2"></i> BUSCAR
    </button>

    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary py-2 px-4" style="font-weight: 600; font-size: 1.3rem;">
        <i class="fas fa-times me-2"></i> LIMPIAR
    </a>

    @if(request('roleFilter')) 
        | Rol: 
        @switch(request('roleFilter'))
            @case('2')
                Usuario
                @break
            @case('3')
                Instructor
                @break
            @default
                Desconocido
        @endswitch
    @endif
</form>
                        </div>

                        <h2 class="mb-0" style="font-weight: 700; font-size: 2.0rem;">
                            <i class="fas fa-users me-3"></i>GESTIÓN DE USUARIOS
                        </h2>

                        <div class="d-flex align-items-center" style="gap: 1rem;">
                            @auth
                                @if(auth()->user()->role_id == 1)
                                    <a href="{{ route('admin.users.edit', auth()->user()->id) }}" 
                                       class="btn py-2 px-4" 
                                       style="background-color: #0A2647; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                        <i class="fas fa-user-cog me-2"></i> Mi cuenta
                                    </a>
                                @endif
                            @endauth
                            <a href="{{ route('admin.users.create') }}" class="btn py-2 px-4" style="background-color: #FF6B35; color: #FFFFFF; font-weight: 600; font-size: 1.3rem;">
                                <i class="fas fa-plus-circle me-2"></i> NUEVO USUARIO
                            </a>
                        </div>
                    </div>
                </div>

                @if(request('search') || request('roleFilter'))
                <div class="alert alert-info m-4" style="background-color: #2EC4B6; color: #FFFFFF; border-left: 5px solid #1A365D;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-filter me-3 fs-4"></i>
                        <strong class="fs-5">
                            Filtros aplicados: 
                            @if(request('search')) Búsqueda: "{{ request('search') }}" @endif
                            @if(request('roleFilter')) | Rol: {{ ucfirst(request('roleFilter')) }} @endif
                        </strong>
                    </div>
                </div>
                @endif

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

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="border-top: none; width: 100%;">
                            <thead>
                                <tr style="background-color: #1A365D; color: #FFFFFF;">
                                    <th class="ps-4 py-3" style="font-weight: 600; font-size: 1.4rem;">Nombres</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Apellidos</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Email</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Rol</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Estado</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Fecha Nac.</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Género</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Especialidad</th>
                                    <th class="py-3" style="font-weight: 600; font-size: 1.4rem;">Certificación</th>
                                    <th class="pe-4 py-3 text-center" style="font-weight: 600; font-size: 1.4rem;">Acciones</th>
                                </tr>
                            </thead>
                          <tbody>
    @forelse($users as $user)
        <tr style="border-bottom: 2px solid #F4F4F4; {{ $user->status && $user->status->name === 'Inactivo' ? 'background-color: #f8d7da;' : '' }}">
            <td class="ps-4" style="font-size: 1.4rem; color: #1A365D;">{{ $user->names }}</td>
            <td style="font-size: 1.4rem; color: #1A365D;">{{ $user->last_name }}</td>
            <td style="font-size: 1.4rem; color: #1A365D;">{{ $user->email }}</td>
            <td style="font-size: 1.4rem; color: #1A365D;">{{ $user->role->name_rol ?? 'N/A' }}</td>
            <td style="font-size: 1.4rem; color: #1A365D;">
                {{ $user->status->name ?? 'N/A' }}
            </td>
            <td style="font-size: 1.4rem; color: #1A365D;">
                {{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d \d\e F \d\e Y') }}
            </td>
            <td style="font-size: 1.4rem; color: #1A365D;">{{ $user->gender }}</td>
            <td class="wrap-text" style="font-size: 1.4rem; color: #1A365D;">{{ $user->specialty ?? 'N/A' }}</td>
            <td class="wrap-text" style="font-size: 1.4rem; color: #1A365D;">{{ $user->certification ?? 'N/A' }}</td>
            <td class="pe-4 text-center">
                <!-- botones de acciones -->
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="10" class="text-center py-4" style="font-size: 1.3rem;">
                @if(request('search') || request('roleFilter'))
                    No se encontraron usuarios con los filtros aplicados
                @else
                    No hay usuarios registrados
                @endif
            </td>
        </tr>
    @endforelse
</tbody>

                        </table>
                    </div>

                    <div class="card-footer py-4" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted" style="font-size: 1.3rem; font-weight: 500;">
                                <i class="fas fa-clipboard-list me-2"></i> 
                                MOSTRANDO <span class="fw-bold">{{ $users->count() }}</span> DE 
                                <span class="fw-bold">{{ $users->total() }}</span> USUARIOS REGISTRADOS
                            </div>
                            <div style="font-size: 1.3rem; font-weight: 500;">
                                <i class="fas fa-calendar-alt me-2"></i>
                                {{ now()->translatedFormat('l, d \d\e F \d\e Y') }}
                            </div>
                        </div>
                    </div>

                    @if($users->hasPages())
                        <div class="card-footer py-4" style="background-color: #F4F4F4; border-top: 2px solid #1A365D;">
                            <div class="d-flex justify-content-center">
                                {{ $users->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .input-container {
        position: relative;
        width: 300px;
    }

    .input {
        width: 100%;
        height: 60px;
        padding: 10px;
        font-size: 1.3rem;
        font-weight: 500;
        border: 4px solid #1A365D;
        background-color: #F4F4F4;
        color: #1A365D;
    }

    .input:focus {
        outline: none;
        border: 4px solid #FF6B35;
        box-shadow: 0 0 5px #FF6B35;
    }

    .wrap-text {
        white-space: normal;
        word-wrap: break-word;
        max-width: 200px;
    }

    .btn-sm {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
</style>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Función para mostrar el administrador
    function mostrarAdministrador() {
        Swal.fire({
            title: 'Gestión de Administrador',
            html: `<div style="text-align: center;">
                    <i class="fas fa-user-shield" style="color: #1A365D; font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>Esta sección es para gestionar el único usuario administrador del sistema.</p>
                    <p style="font-weight: 600;">¿Desea editar los datos del administrador?</p>
                </div>`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-edit me-2"></i> Editar',
            cancelButtonText: '<i class="fas fa-times me-2"></i> Cancelar',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn',
                cancelButton: 'btn btn-eliminar'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir a la edición del administrador
                window.location.href = "{{ route('admin.users.edit', auth()->user()->id) }}";
            }
        });
    }

    // Manejar la eliminación de usuarios con SweetAlert
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const form = this.closest('form');
            
            Swal.fire({
                title: '¿Estás seguro?',
                html: `<div style="text-align: center;">
                        <i class="fas fa-exclamation-triangle" style="color: #FF6B35; font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p>Estás a punto de eliminar al usuario: <strong>${userName}</strong></p>
                        <p style="font-weight: 600;">Esta acción no se puede deshacer</p>
                    </div>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-trash me-2"></i> Sí, eliminar',
                cancelButtonText: '<i class="fas fa-times me-2"></i> Cancelar',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario de eliminación
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-HTTP-Method-Override': 'DELETE'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mostrar mensaje de éxito y recargar la página
                            Swal.fire({
                                title: '¡Eliminado!',
                                html: `<div style="text-align: center;">
                                        <i class="fas fa-check-circle" style="color: #2EC4B6; font-size: 3rem; margin-bottom: 1rem;"></i>
                                        <p>El usuario <strong>${userName}</strong> ha sido eliminado correctamente.</p>
                                    </div>`,
                                icon: 'success',
                                confirmButtonText: '<i class="fas fa-check me-2"></i> Aceptar',
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                }
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            // Mostrar mensaje de error si no se puede eliminar
                            Swal.fire({
                                title: '¡Error!',
                                html: `<div style="text-align: center;">
                                        <i class="fas fa-exclamation-circle" style="color: #FF6B35; font-size: 3rem; margin-bottom: 1rem;"></i>
                                        <p>No se puede eliminar al usuario <strong>${userName}</strong> porque tiene pagos asociados.</p>
                                        <p>Primero debe eliminar los pagos relacionados.</p>
                                    </div>`,
                                icon: 'error',
                                confirmButtonText: '<i class="fas fa-check me-2"></i> Entendido',
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    });
</script>
@endsection