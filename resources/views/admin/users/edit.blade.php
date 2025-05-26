@extends('layouts.admi-app-master')

@section('content')
<div class="container-fluid main-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Editar Usuario
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">
                                <!-- Nombres -->
                                <div class="mb-3">
                                    <label for="names" class="form-label">Nombres</label>
                                    <input type="text" class="form-control @error('names') is-invalid @enderror" id="names" name="names" value="{{ old('names', $user->names) }}" required>
                                    @error('names')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Apellidos -->
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nueva Contraseña -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Nueva Contraseña</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirmar Contraseña -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>

                                <!-- Rol -->
                                <div class="mb-3">
                                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
    <option value="">Seleccione un rol</option>
    @foreach($roles as $role)
        <option value="{{ $role->name }}" {{ $user->getRoleNames()->first() == $role->name ? 'selected' : '' }}>
            {{ $role->name }}
        </option>
    @endforeach
</select>

                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="col-md-6">
                                <!-- Estado -->
                                <div class="mb-3">
                                    <label for="status_id" class="form-label">Estado</label>
                                    <select class="form-select @error('status_id') is-invalid @enderror" id="status_id" name="status_id" required>
                                        <option value="">Seleccione estado</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" {{ old('status_id', $user->status_id) == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Fecha Nacimiento -->
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">Fecha Nacimiento</label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" required>
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Género -->
                                <div class="mb-3">
                                    <label class="form-label">Género</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
    <input class="form-check-input" type="radio" name="gender" id="masculino" value="Masculino" {{ old('gender', $user->gender) == 'Masculino' ? 'checked' : '' }}>
    <label class="form-check-label" for="masculino">Masculino</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="gender" id="femenino" value="Femenino" {{ old('gender', $user->gender) == 'Femenino' ? 'checked' : '' }}>
    <label class="form-check-label" for="femenino">Femenino</label>
</div>

                                    </div>
                                    @error('gender')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Especialidad -->
                                <div class="mb-3">
                                    <label for="specialty" class="form-label">Especialidad</label>
                                    <input type="text" class="form-control @error('specialty') is-invalid @enderror" id="specialty" name="specialty" value="{{ old('specialty', $user->specialty) }}">
                                    @error('specialty')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Certificación -->
                                <div class="mb-3">
                                    <label for="certification" class="form-label">Certificación</label>
                                    <input type="text" class="form-control @error('certification') is-invalid @enderror" id="certification" name="certification" value="{{ old('certification', $user->certification) }}">
                                    @error('certification')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save2 me-2"></i>Actualizar Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .main-wrapper {
        margin-top: 50px;
        padding: 30px 0;
        min-height: calc(100vh - 100px);
    }

    .card {
        border-radius: 0.75rem;
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .main-wrapper {
            margin-top: 80px;
            padding: 15px 0;
            min-height: calc(100vh - 80px);
        }

        .card {
            margin: 1rem;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
        }
    }

    .form-control, .form-select {
        border-radius: 0.5rem;
        padding: 0.75rem 1.25rem;
        border: 2px solid #dee2e6;
        font-size: 1rem;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .btn {
        font-size: 1.05rem;
        padding: 0.8rem 1.75rem;
        border-radius: 0.6rem;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background-color: #2c3e50;
        border-color: #2c3e50;
    }

    .btn-primary:hover {
        background-color: #1a252f;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#rol_id, #status_id').select2({
            theme: 'bootstrap-5',
            placeholder: 'Seleccione una opción',
            width: '100%',
            dropdownParent: $('.card-body')
        });

        $('#birth_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            endDate: 'today',
            todayHighlight: true,
            language: 'es',
            orientation: 'bottom auto'
        }).on('show', function(e) {
            $('.datepicker').css('z-index', '9999');
        });
    });
</script>
@endsection
