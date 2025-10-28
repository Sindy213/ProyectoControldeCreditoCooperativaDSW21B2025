<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🏦 Tipos de Créditos</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-4">
                <a href="{{ route('tipos_creditos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">➕ Nuevo Tipo</a>
                <a href="{{ route('tipos_creditos.exportPdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">📄 Exportar PDF</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Código</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Tasa Anual (%)</th>
                            <th class="px-4 py-2">Plazo (meses)</th>
                            <th class="px-4 py-2">Montos ($)</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipos as $tipo)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $tipo->codigo }}</td>
                            <td class="px-4 py-2">{{ $tipo->nombre }}</td>
                            <td class="px-4 py-2">{{ $tipo->tasa_anual }}%</td>
                            <td class="px-4 py-2">{{ $tipo->plazo_min_meses }} - {{ $tipo->plazo_max_meses }}</td>
                            <td class="px-4 py-2">${{ number_format($tipo->monto_min,2) }} - ${{ number_format($tipo->monto_max,2) }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('tipos_creditos.show',$tipo->id) }}" class="text-blue-600 hover:underline">👁 Ver</a> |
                                <a href="{{ route('tipos_creditos.edit',$tipo->id) }}" class="text-yellow-600 hover:underline">✏️ Editar</a> |
                                <form action="{{ route('tipos_creditos.destroy',$tipo->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('¿Eliminar este tipo de crédito?')" class="text-red-600 hover:underline">🗑 Eliminar</button>
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
