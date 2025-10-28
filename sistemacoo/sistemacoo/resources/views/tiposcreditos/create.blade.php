<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">➕ Nuevo Tipo de Crédito</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg border border-gray-200">
            <form action="{{ route('tiposcreditos.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block font-medium text-gray-700">Código</label>
                        <input type="text" name="codigo" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Nombre</label>
                        <input type="text" list="nombresTipos" name="nombre" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                        <datalist id="nombresTipos">
                            @foreach($opcionesNombre as $opcion)
                                <option value="{{ $opcion }}"></option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" rows="3"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Tasa Anual (%)</label>
                        <input type="number" step="0.01" name="tasa_anual" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Plazo Mínimo (meses)</label>
                        <input type="number" name="plazo_min_meses" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Plazo Máximo (meses)</label>
                        <input type="number" name="plazo_max_meses" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Monto Mínimo ($)</label>
                        <input type="number" step="0.01" name="monto_min" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Monto Máximo ($)</label>
                        <input type="number" step="0.01" name="monto_max" class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700">Condiciones (JSON)</label>
                        <textarea name="condiciones_json" placeholder='{"requisitos":"DUI, NIT"}' class="w-full border-gray-300 rounded-lg mt-1 shadow-sm" rows="4"></textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-2">
                    <a href="{{ route('tiposcreditos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">Cancelar</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
