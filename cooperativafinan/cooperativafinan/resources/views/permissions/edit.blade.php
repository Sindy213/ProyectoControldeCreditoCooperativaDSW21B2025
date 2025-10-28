<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Permiso</h2></x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf @method('PUT')
            <label class="block mb-2">Nombre del Permiso:</label>
            <input type="text" name="name" value="{{ $permission->name }}" class="w-full border px-3 py-2 rounded mb-4" required>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Actualizar</button>
        </form>
    </div>
</x-app-layout>
