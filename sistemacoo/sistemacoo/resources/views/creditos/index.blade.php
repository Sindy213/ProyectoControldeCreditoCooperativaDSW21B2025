<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Lista de Créditos
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <a href="{{ route('creditos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">➕ Nuevo Crédito</a>
                <a href="{{ route('creditos.exportPdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">📄 Exportar PDF</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Cliente</th>
                            <th class="px-4 py-2 text-left">Tipo de Crédito</th>
                            <th class="px-4 py-2 text-left">Monto</th>
                            <th class="px-4 py-2 text-left">Tasa Anual (%)</th>
                            <th class="px-4 py-2 text-left">Plazo (meses)</th>
                            <th class="px-4 py-2 text-left">Cuota mensual</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($creditos as $credito)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $credito->id }}</td>
                            <td class="px-4 py-2">{{ $credito->cliente->nombre }} {{ $credito->cliente->apellido }}</td>
                            <td class="px-4 py-2">{{ $credito->tipo->nombre }}</td>
                            <td class="px-4 py-2">${{ number_format($credito->monto_capital,2) }}</td>
                            <td class="px-4 py-2">{{ $credito->tasa_anual }}</td>
                            <td class="px-4 py-2">{{ $credito->plazo_meses }}</td>
                            <td class="px-4 py-2">${{ $credito->cuota_mensual }}</td>
                            <td class="px-4 py-2 capitalize">{{ $credito->estado }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('creditos.show', $credito->id) }}" class="text-blue-600 hover:underline">👁 Ver</a> |
                                <a href="{{ route('creditos.edit', $credito->id) }}" class="text-yellow-600 hover:underline">✏️ Editar</a> |
                                <form action="{{ route('creditos.destroy', $credito->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar crédito?')">🗑 Eliminar</button>
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
