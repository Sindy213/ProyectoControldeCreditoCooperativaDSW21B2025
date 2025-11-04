<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">✏️ Editar Tipo de Crédito</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg border border-gray-200">
            <form action="{{ route('tiposcreditos.update', $tipo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-gray-700">Código</label>
                        <input type="text" name="codigo" value="{{ $tipo->codigo }}" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" value="{{ $tipo->nombre }}" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" rows="3">{{ $tipo->descripcion }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Tasa Anual (%)</label>
                        <input type="number" step="0.01" name="tasa_anual" value="{{ $tipo->tasa_anual }}" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Plazo Mínimo (meses)</label>
                        <input type="number" name="plazo_min_meses" value="{{ $tipo->plazo_min_meses }}" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Plazo Máximo (meses)</label>
                        <input type="number" name="plazo_max_meses" value="{{ $tipo->plazo_max_meses }}" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Monto Mínimo ($)</label>
                        <input type="number" step="0.01" name="monto_min" value="{{ $tipo->monto_min }}" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Monto Máximo ($)</label>
                        <input type="number" step="0.01" name="monto_max" value="{{ $tipo->monto_max }}" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700">Condiciones (JSON)</label>
                        <textarea name="condiciones_json" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" rows="4">{{ $tipo->condiciones_json }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-2">
                    <a href="{{ route('tiposcreditos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">Cancelar</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
