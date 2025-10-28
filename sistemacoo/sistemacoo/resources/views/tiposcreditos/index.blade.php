<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🏦 Tipos de Créditos</h2>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Botones superiores --}}
            <div class="flex justify-between mb-6">
                <a href="{{ route('tiposcreditos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition transform hover:-translate-y-1">
                    ➕ Nuevo Tipo
                </a>
                <a href="{{ route('tiposcreditos.exportPdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg shadow-md transition transform hover:-translate-y-1">
                    📄 Exportar PDF
                </a>
            </div>

            {{-- Tabla --}}
            <div class="overflow-hidden rounded-2xl bg-white/50 backdrop-blur-lg border border-white/20 shadow-lg">
                <table class="min-w-full text-left">
                    <thead class="bg-white/30 backdrop-blur-md">
                        <tr>
                            <th class="px-6 py-3 text-gray-700 font-semibold">Código</th>
                            <th class="px-6 py-3 text-gray-700 font-semibold">Nombre</th>
                            <th class="px-6 py-3 text-gray-700 font-semibold">Tasa Anual (%)</th>
                            <th class="px-6 py-3 text-gray-700 font-semibold">Plazo (meses)</th>
                            <th class="px-6 py-3 text-gray-700 font-semibold">Montos ($)</th>
                            <th class="px-6 py-3 text-gray-700 font-semibold text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipos as $tipo)
                        <tr class="border-t border-white/30 hover:bg-white/20 transition">
                            <td class="px-6 py-4">{{ $tipo->codigo }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $tipo->nombre }}</td>
                            <td class="px-6 py-4">{{ $tipo->tasa_anual }}%</td>
                            <td class="px-6 py-4">{{ $tipo->plazo_min_meses }} - {{ $tipo->plazo_max_meses }}</td>
                            <td class="px-6 py-4">${{ number_format($tipo->monto_min,2) }} - ${{ number_format($tipo->monto_max,2) }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('tiposcreditos.show', $tipo->id) }}" class="text-blue-600 hover:underline font-semibold">👁 Ver</a>
                                <a href="{{ route('tiposcreditos.edit', $tipo->id) }}" class="text-yellow-600 hover:underline font-semibold">✏️ Editar</a>
                                <form action="{{ route('tiposcreditos.destroy', $tipo->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('¿Eliminar este tipo de crédito?')" class="text-red-600 hover:underline font-semibold">🗑 Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($tipos->isEmpty())
                <div class="mt-6 p-4 text-center text-gray-500 bg-white/30 rounded-lg shadow-inner">
                    No hay tipos de crédito registrados.
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
