@extends('layouts.admi-app-master')

@section('content')
<div class="container mx-auto px-6 py-8 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Información del Centro</h2>

    <form action="{{ route('admin.center-information.update', $centerInformation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="schedule" class="block font-medium text-gray-700">Horario</label>
            <textarea name="schedule" id="schedule" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('schedule', $centerInformation->schedule) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="phone" class="block font-medium text-gray-700">Teléfono</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $centerInformation->phone) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $centerInformation->email) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div class="mb-6">
            <label for="address" class="block font-medium text-gray-700">Dirección</label>
            <input type="text" name="address" id="address" value="{{ old('address', $centerInformation->address) }}" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Actualizar</button>
    </form>
</div>
@endsection