<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Rol</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label>Nombre del rol</label>
                        <input type="text" name="name" class="border px-2 py-1 w-full" value="{{ $role->name }}" required>
                    </div>

                    <div class="mb-4">
                        <label>Permisos</label>
                        <div class="grid grid-cols-2 gap-2 mt-1">
                            @foreach($permissions as $perm)
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                        @if(in_array($perm->id, $rolePermissions)) checked @endif>
                                    {{ $perm->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
