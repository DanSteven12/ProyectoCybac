@extends('layouts.admi-app-master')

@section('content')
<div class="container mx-auto max-w-3xl px-6 py-10 bg-white rounded-lg shadow-lg mt-10">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b pb-2">Información del Centro</h2>

    @if(isset($info) && $info)
        <div class="space-y-4 text-gray-700">
            <p><span class="font-semibold">Horario:</span> {{ $info->schedule }}</p>
            <p><span class="font-semibold">Teléfono:</span> {{ $info->phone }}</p>
            <p><span class="font-semibold">Email:</span> {{ $info->email }}</p>
            <p><span class="font-semibold">Dirección:</span> {{ $info->address }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.center-information.edit', $info->id) }}"
               class="inline-block bg-blue-600 hover:bg-blue-800 text-white font-semibold px-5 py-2 rounded transition">
               Editar Información
            </a>
        </div>
    @else
        <div class="text-gray-600 mb-6 italic">
            No hay información del centro registrada aún.
        </div>

        <div>
            <a href="{{ route('admin.center-information.create') }}"
               class="inline-block bg-green-600 hover:bg-green-800 text-white font-semibold px-5 py-2 rounded transition">
               Agregar Información
            </a>
        </div>
    @endif
</div>
@endsection