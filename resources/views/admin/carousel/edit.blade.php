@extends('layouts.admi-app-master')

@section('content')
<div class="container mx-auto max-w-2xl p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Slide</h2>

    <form action="{{ route('admin.carousel.update', $carousel) }}" method="POST" enctype="multipart/form-data" class="space-y-5 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="description" class="block font-semibold text-gray-700">Descripción</label>
            <input type="text" name="description" id="description" class="w-full mt-1 border rounded-md p-2"
                value="{{ old('description', $carousel->description) }}">
        </div>

        <div>
            <label class="block font-semibold text-gray-700">Imagen actual</label>
            <img src="{{ asset('storage/' . $carousel->image_path) }}" width="200" class="mb-2 rounded">
            <label for="image" class="block font-semibold text-gray-700">Cambiar imagen (opcional)</label>
            <input type="file" name="image" id="image" class="w-full mt-1 border rounded-md p-2">
        </div>

        <div>
            <label for="link_url" class="block font-semibold text-gray-700">Enlace (opcional)</label>
            <input type="url" name="link_url" id="link_url" class="w-full mt-1 border rounded-md p-2"
                value="{{ old('link_url', $carousel->link_url) }}">
        </div>

        <div>
            <label for="display_order" class="block font-semibold text-gray-700">Orden</label>
            <input type="number" name="display_order" id="display_order" class="w-full mt-1 border rounded-md p-2"
                min="0" value="{{ old('display_order', $carousel->display_order) }}">
        </div>

        <div class="mb-4">
            <label for="is_active" class="block text-sm font-medium text-gray-700">Estado</label>
            <select name="is_active" id="is_active" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="1" @if ($carousel->is_active) selected @endif>Activo</option>
                <option value="0" @if (!$carousel->is_active) selected @endif>Inactivo</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection