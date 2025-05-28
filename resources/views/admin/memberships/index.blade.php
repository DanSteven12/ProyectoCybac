@extends('layouts.admi-app-master')

@section('content')
    <h1>Membresías</h1>

    <a href="{{ route('admin.memberships.create') }}" class="btn btn-primary mb-3">Crear Membresía</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Duración (días)</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($memberships as $membership)
                <tr>
                    <td>{{ $membership->name }}</td>
                    <td>{{ $membership->description }}</td>
                    <td>{{ $membership->duration }}</td>
                    <td>{{ $membership->status->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.memberships.edit', $membership) }}" class="btn btn-sm btn-warning">Editar</a>
                        
                        <form action="{{ route('admin.memberships.destroy', $membership) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                onclick="return confirm('¿Seguro que deseas eliminar esta membresía?')"
                                class="btn btn-sm btn-danger"
                            >
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
