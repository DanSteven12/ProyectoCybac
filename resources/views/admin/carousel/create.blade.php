@extends('layouts.admi-app-master')

@section('content')
<div class="container mx-auto max-w-2xl p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Agregar Slide</h2>

    {{-- MOSTRAR ERRORES --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULARIO --}}
    <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="description" class="block">Descripción</label>
            <input type="text" name="description" id="description" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="image" class="block">Imagen</label>
            <input type="file" name="image" id="image" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="link_url" class="block">Enlace</label>
            <input type="url" name="link_url" id="link_url" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="display_order" class="block">Orden</label>
            <input type="number" name="display_order" id="display_order" min="0" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="is_active" class="block">Estado</label>
            <select name="is_active" id="is_active" class="w-full border p-2 rounded">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        </div>
    </form>
</div>
@endsection