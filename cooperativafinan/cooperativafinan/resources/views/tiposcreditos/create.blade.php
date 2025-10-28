<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">➕ Nuevo Tipo de Crédito</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form action="{{ route('tipos_creditos.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label>Código</label>
                        <input type="text" name="codigo" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div class="col-span-2">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="w-full border-gray-300 rounded-lg" rows="3"></textarea>
                    </div>

                    <div>
                        <label>Tasa Anual (%)</label>
                        <input type="number" step="0.01" name="tasa_anual" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label>Plazo Mínimo (meses)</label>
                        <input type="number" name="plazo_min_meses" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label>Plazo Máximo (meses)</label>
                        <input type="number" name="plazo_max_meses" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label>Monto Mínimo ($)</label>
                        <input type="number" step="0.01" name="monto_min" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label>Monto Máximo ($)</label>
                        <input type="number" step="0.01" name="monto_max" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div class="col-span-2">
                        <label>Condiciones (JSON)</label>
                        <textarea name="condiciones_json" placeholder='{"requisitos":"DUI, NIT"}' class="w-full border-gray-300 rounded-lg" rows="4"></textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('tipos_creditos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
