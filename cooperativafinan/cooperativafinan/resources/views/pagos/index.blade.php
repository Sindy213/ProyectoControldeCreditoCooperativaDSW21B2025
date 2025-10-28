<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">💰 Control de Pagos</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between mb-4">
                <a href="{{ route('pagos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">➕ Nuevo Pago</a>
                <a href="{{ route('pagos.exportPdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">📄 Exportar PDF</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Crédito</th>
                            <th class="px-4 py-2 text-left">Usuario</th>
                            <th class="px-4 py-2 text-left">Fecha de Pago</th>
                            <th class="px-4 py-2 text-left">Monto Pagado</th>
                            <th class="px-4 py-2 text-left">Tipo de Pago</th>
                            <th class="px-4 py-2 text-left">Nota</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $pago->id }}</td>
                            <td class="px-4 py-2">{{ $pago->credito->numero_credito }}</td>
                            <td class="px-4 py-2">{{ $pago->usuario->name }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">${{ number_format($pago->monto_pagado, 2) }}</td>
                            <td class="px-4 py-2">{{ $pago->tipo_pago }}</td>
                            <td class="px-4 py-2">{{ $pago->nota ?? '—' }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('pagos.show', $pago->id) }}" class="text-blue-600 hover:underline">👁 Ver</a> |
                                <a href="{{ route('pagos.edit', $pago->id) }}" class="text-yellow-600 hover:underline">✏️ Editar</a> |
                                <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('¿Eliminar este pago?')" class="text-red-600 hover:underline">🗑 Eliminar</button>
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
