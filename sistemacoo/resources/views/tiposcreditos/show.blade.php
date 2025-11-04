<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">👁 Detalles del Tipo de Crédito</h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold text-gray-700">Código:</h3>
                    <p>{{ $tipo->codigo }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Nombre:</h3>
                    <p>{{ $tipo->nombre }}</p>
                </div>
                <div class="md:col-span-2">
                    <h3 class="font-semibold text-gray-700">Descripción:</h3>
                    <p>{{ $tipo->descripcion }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Tasa Anual:</h3>
                    <p>{{ $tipo->tasa_anual }}%</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Plazo (meses):</h3>
                    <p>{{ $tipo->plazo_min_meses }} - {{ $tipo->plazo_max_meses }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700">Montos ($):</h3>
                    <p>${{ number_format($tipo->monto_min,2) }} - ${{ number_format($tipo->monto_max,2) }}</p>
                </div>
                <div class="md:col-span-2">
                    <h3 class="font-semibold text-gray-700">Condiciones (JSON):</h3>
                    <pre class="bg-gray-100 p-2 rounded">{{ $tipo->condiciones_json }}</pre>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('tiposcreditos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">Volver</a>
            </div>
        </div>
    </div>
</x-app-layout>
