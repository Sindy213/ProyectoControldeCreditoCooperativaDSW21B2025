<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">✏️ Editar Tipo de Crédito: {{ $tipo->nombre }}</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form action="{{ route('tipos_creditos.update', $tipo->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label>Código</label>
                        <input type="text" name="codigo" value="{{ $tipo->codigo }}" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="{{ $tipo->nombre }}" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div class="col-span-2">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="w-full border-gray-300 rounded-lg" rows="3">{{ $tipo->descripcion }}</textarea>
                    </div>

                    <div>
                        <label>Tasa Anual (%)</label>
                        <input type="number" step="0.01" name="tasa_anual" value="{{ $tipo->tasa_anual }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label>Plazo Mínimo</label>
                        <input type="number" name="plazo_min_meses" value="{{ $tipo->plazo_min_meses }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label>Plazo Máximo</label>
                        <input type="number" name="plazo_max_meses" value="{{ $tipo->plazo_max_meses }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label>Monto Mínimo</label>
                        <input type="number" step="0.01" name="monto_min" value="{{ $tipo->monto_min }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label>Monto Máximo</label>
                        <input type="number" step="0.01" name="monto_max" value="{{ $tipo->monto_max }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div class="col-span-2">
                        <label>Condiciones (JSON)</label>
                        <textarea name="condiciones_json" class="w-full border-gray-300 rounded-lg" rows="4">{{ $tipo->condiciones_json }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('tipos_creditos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Volver</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
