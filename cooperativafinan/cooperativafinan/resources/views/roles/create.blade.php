<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Rol</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Nombre del rol</label>
                        <input type="text" name="name" class="border px-2 py-1 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label>Permisos</label>
                        <div class="grid grid-cols-2 gap-2 mt-1">
                            @foreach($permissions as $perm)
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $perm->id }}">
                                    {{ $perm->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
