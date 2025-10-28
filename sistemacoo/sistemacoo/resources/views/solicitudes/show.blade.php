<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🔍 Detalles de Solicitud #{{ $solicitud->id }}</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <div class="grid grid-cols-2 gap-4">
                <p><strong>Cliente:</strong> {{ $solicitud->cliente->nombre }} {{ $solicitud->cliente->apellido }}</p>
                <p><strong>Tipo de Crédito:</strong> {{ $solicitud->tipo->nombre }}</p>
                <p><strong>Monto Solicitado:</strong> ${{ number_format($solicitud->monto_solicitado,2) }}</p>
                <p><strong>Plazo:</strong> {{ $solicitud->plazo_meses }} meses</p>
                <p><strong>Ingresos Declarados:</strong> ${{ number_format($solicitud->ingresos_declared,2) }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($solicitud->estado) }}</p>
                <p class="col-span-2"><strong>Observaciones:</strong> {{ $solicitud->observaciones ?? '—' }}</p>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('solicitudes.exportOnePdf', $solicitud->id) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">📄 Exportar PDF</a>
            </div>
        </div>
    </div>
</x-app-layout>
