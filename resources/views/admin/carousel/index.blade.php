@extends('layouts.admi-app-master')

@section('content')
<div class="container mx-auto p-6 pb-32"> {{-- AUMENTÉ PADDING INFERIOR --}}
    <h2 class="text-2xl font-bold mb-6">Carrusel</h2>

    {{-- Botón para crear nuevo slide --}}
    <a href="{{ route('admin.carousel.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block mb-6">
        + Nuevo Slide
    </a>

    {{-- Tabla de Slides --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow mb-10 text-sm text-left">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Enlace</th>
                    <th class="px-4 py-2">Orden</th>
                    <th class="px-4 py-2">Activo</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($slides as $slide)
                    <tr class="border-b">
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $slide->image_path) }}" width="100" class="rounded shadow" />
                        </td>
                        <td class="px-4 py-2">{{ $slide->description }}</td>
                        <td class="px-4 py-2">{{ $slide->link_url }}</td>
                        <td class="px-4 py-2">{{ $slide->display_order }}</td>
                        <td class="px-4 py-2">{{ $slide->is_active ? 'Sí' : 'No' }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.carousel.edit', $slide) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Editar</a>
                            <form action="{{ route('admin.carousel.destroy', $slide) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar este slide?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">No hay slides registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- CONFIGURACIÓN DEL CARRUSEL --}}
    <h3 class="text-xl font-semibold mb-4">Configuración del Carrusel</h3>
    <form action="{{ route('admin.carousel.updateSettings') }}" method="POST" class="space-y-4 max-w-lg bg-gray-100 p-6 rounded shadow">
        @csrf

        <div>
            <label for="style" class="block font-semibold">Topología:</label>
            <select name="style" id="style" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                <option value="ring" {{ $settings?->style === 'ring' ? 'selected' : '' }}>Anillo</option>
                <option value="flat" {{ $settings?->style === 'flat' ? 'selected' : '' }}>Plano</option>
                <option value="stacked" {{ $settings?->style === 'stacked' ? 'selected' : '' }}>Stacked</option>
            </select>
        </div>

        <div>
            <label for="radius" class="block font-semibold">Radio (px):</label>
            <input type="number" name="radius" id="radius" value="{{ $settings?->radius ?? 300 }}" class="w-full mt-1 border rounded p-2" min="100" max="1000">
        </div>

        <div>
            <label for="duration" class="block font-semibold">Duración del giro (s):</label>
            <input type="number" name="duration" id="duration" value="{{ $settings?->duration ?? 20 }}" class="w-full mt-1 border rounded p-2" min="5" max="60">
        </div>

        <div>
            <label class="inline-flex items-center mt-2">
                <input type="checkbox" name="brightness_animation" class="form-checkbox" {{ $settings?->brightness_animation ? 'checked' : '' }}>
                <span class="ml-2">Activar animación de brillo</span>
            </label>
        </div>

        <div>
            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded">Guardar configuración</button>
        </div>
    </form>
</div>
@endsection