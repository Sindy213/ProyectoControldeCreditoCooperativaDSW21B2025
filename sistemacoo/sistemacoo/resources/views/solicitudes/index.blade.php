<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📋 Solicitudes de Crédito</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-4">
                <a href="{{ route('solicitudes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">➕ Nueva Solicitud</a>
                <a href="{{ route('solicitudes.exportPdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">📄 Exportar PDF</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Cliente</th>
                            <th class="px-4 py-2">Tipo de Crédito</th>
                            <th class="px-4 py-2">Monto Solicitado</th>
                            <th class="px-4 py-2">Plazo (meses)</th>
                            <th class="px-4 py-2">Ingresos Declarados</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $s)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $s->id }}</td>
                            <td class="px-4 py-2">{{ $s->cliente->nombre }} {{ $s->cliente->apellido }}</td>
                            <td class="px-4 py-2">{{ $s->tipo->nombre }}</td>
                            <td class="px-4 py-2">${{ number_format($s->monto_solicitado, 2) }}</td>
                            <td class="px-4 py-2">{{ $s->plazo_meses }}</td>
                            <td class="px-4 py-2">${{ number_format($s->ingresos_declared, 2) }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-white {{ $s->estado=='pendiente'?'bg-yellow-500':($s->estado=='aprobado'?'bg-green-600':'bg-red-600') }}">
                                    {{ ucfirst($s->estado) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('solicitudes.show', $s->id) }}" class="text-blue-600 hover:underline">👁 Ver</a> |
                                <a href="{{ route('solicitudes.edit', $s->id) }}" class="text-yellow-600 hover:underline">✏️ Editar</a> |
                                <form action="{{ route('solicitudes.destroy', $s->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('¿Eliminar esta solicitud?')" class="text-red-600 hover:underline">🗑 Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
