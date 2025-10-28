<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🔍 Detalles del Tipo de Crédito</h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <ul class="space-y-2">
                <li><strong>Código:</strong> {{ $tipo->codigo }}</li>
                <li><strong>Nombre:</strong> {{ $tipo->nombre }}</li>
                <li><strong>Descripción:</strong> {{ $tipo->descripcion ?? '—' }}</li>
                <li><strong>Tasa Anual:</strong> {{ $tipo->tasa_anual }}%</li>
                <li><strong>Plazo:</strong> {{ $tipo->plazo_min_meses }} - {{ $tipo->plazo_max_meses }} meses</li>
                <li><strong>Montos:</strong> ${{ number_format($tipo->monto_min,2) }} - ${{ number_format($tipo->monto_max,2) }}</li>
                <li><strong>Condiciones:</strong> 
                    <pre>{{ json_encode(json_decode($tipo->condiciones_json), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </li>
            </ul>

            <div class="flex justify-end mt-6">
                <a href="{{ route('tipos_creditos.exportOnePdf', $tipo->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">📄 Exportar PDF</a>
            </div>
        </div>
    </div>
</x-app-layout>
