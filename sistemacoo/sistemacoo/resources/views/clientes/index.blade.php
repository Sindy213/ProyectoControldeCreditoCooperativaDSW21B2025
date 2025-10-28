<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">👥 Lista de Clientes</h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="flex justify-between mb-4">
            <a href="{{ route('clientes.create') }}" class="btn btn-success">➕ Nuevo Cliente</a>
            <a href="{{ route('clientes.exportPdf') }}" class="btn btn-danger">📄 Exportar a PDF</a>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full table table-bordered text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Apellido</th>
                        <th class="px-4 py-2">Identificación</th>
                        <th class="px-4 py-2">Teléfono</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Dirección</th>
                        <th class="px-4 py-2">Ocupación</th>
                        <th class="px-4 py-2">Ingreso mensual</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $cliente->id }}</td>
                            <td class="px-4 py-2">{{ $cliente->nombre }}</td>
                            <td class="px-4 py-2">{{ $cliente->apellido }}</td>
                            <td class="px-4 py-2">{{ $cliente->identificacion }}</td>
                            <td class="px-4 py-2">{{ $cliente->telefono }}</td>
                            <td class="px-4 py-2">{{ $cliente->email }}</td>
                            <td class="px-4 py-2">{{ $cliente->direccion }}</td>
                            <td class="px-4 py-2">{{ $cliente->ocupacion }}</td>
                            <td class="px-4 py-2">${{ number_format($cliente->ingreso_mensual, 2) }}</td>
                            <td class="px-4 py-2">
                                <span class="badge bg-{{ $cliente->estado == 'activo' ? 'success' : 'danger' }}">
                                    {{ ucfirst($cliente->estado) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-info btn-sm">👁️ Ver</a>
                                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Deseas eliminar este cliente?')">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
