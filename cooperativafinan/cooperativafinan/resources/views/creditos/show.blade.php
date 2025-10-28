<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            💳 Detalles del Crédito #{{ $credito->numero_credito }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <div class="grid grid-cols-2 gap-4">
                <p><strong>Cliente:</strong> {{ $credito->cliente->nombre }} {{ $credito->cliente->apellido }}</p>
                <p><strong>Tipo:</strong> {{ $credito->tipo->nombre }}</p>
                <p><strong>Monto capital:</strong> ${{ number_format($credito->monto_capital,2) }}</p>
                <p><strong>Tasa anual:</strong> {{ $credito->tasa_anual }}%</p>
                <p><strong>Plazo:</strong> {{ $credito->plazo_meses }} meses</p>
                <p><strong>Cuota mensual:</strong> ${{ number_format($credito->cuota_mensual,2) }}</p>
                <p><strong>Saldo total:</strong> ${{ number_format($credito->saldo,2) }}</p>
                <p><strong>Interés total:</strong> ${{ number_format($credito->interes_total,2) }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($credito->estado) }}</p>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('creditos.exportOnePdf', $credito->id) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">📄 Exportar PDF</a>
            </div>
        </div>
    </div>
</x-app-layout>
