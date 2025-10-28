<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">💵 Detalles del Pago #{{ $pago->id }}</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <div class="grid grid-cols-2 gap-4">
                <p><strong>Crédito:</strong> {{ $pago->credito->numero_credito }}</p>
                <p><strong>Usuario:</strong> {{ $pago->usuario->name }}</p>
                <p><strong>Fecha de Pago:</strong> {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</p>
                <p><strong>Monto Pagado:</strong> ${{ number_format($pago->monto_pagado,2) }}</p>
                <p><strong>Tipo de Pago:</strong> {{ $pago->tipo_pago }}</p>
                <p><strong>Nota:</strong> {{ $pago->nota ?? '—' }}</p>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('pagos.exportOnePdf', $pago->id) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">📄 Exportar PDF</a>
            </div>
        </div>
    </div>
</x-app-layout>
