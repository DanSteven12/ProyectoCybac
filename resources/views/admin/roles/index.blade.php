@extends('layouts.admi-app-master')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestión de Roles</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Nuevo Rol
    </a>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
</thead>
<tbody>
    @forelse($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" 
                    style="display:inline"
                    onsubmit="return confirm('¿Seguro que deseas eliminar este rol?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">No hay roles registrados</td>
        </tr>
    @endforelse
</tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection