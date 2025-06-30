@extends('layouts.admi-app-master')

@section('content')
<div class="container mx-auto px-6 py-8 max-w-2xl bg-white shadow-lg rounded-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Agregar Servicio</h2>

    <form action="{{ route('admin.services_home.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Categoría 
        <div>
            <label for="category" class="block text-sm font-semibold text-gray-700 mb-1">Categoría</label>
            <select name="category" id="category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @foreach(['Swimming', 'Zumba', 'Yoga'] as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div> --}}

        {{-- Nombre --}}
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
            <input type="text" name="name" id="name" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   required>
        </div>

        {{-- Descripción --}}
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
            <textarea name="description" id="description" rows="4" 
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                      required></textarea>
        </div>

        {{-- Imagen --}}
        <div>
            <label for="image_url" class="block text-sm font-semibold text-gray-700 mb-1">Imagen</label>
            <input type="file" name="image_url" id="image_url"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition">
        </div>

        {{-- Botón --}}
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-300">
                Crear Servicio
            </button>
        </div>
    </form>
</div>
@endsection