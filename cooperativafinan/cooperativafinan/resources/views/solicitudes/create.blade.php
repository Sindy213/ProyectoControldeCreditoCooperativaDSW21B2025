<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">➕ Nueva Solicitud de Crédito</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form action="{{ route('solicitudes.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Cliente</label>
                        <select name="cliente_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $c)
                                <option value="{{ $c->id }}">{{ $c->nombre }} {{ $c->apellido }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Tipo de Crédito</label>
                        <select name="tipo_credito_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Seleccione un tipo</option>
                            @foreach($tipos as $t)
                                <option value="{{ $t->id }}">{{ $t->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Monto Solicitado ($)</label>
                        <input type="number" step="0.01" name="monto_solicitado" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label>Plazo (meses)</label>
                        <input type="number" name="plazo_meses" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label>Ingresos Declarados ($)</label>
                        <input type="number" step="0.01" name="ingresos_declared" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div class="col-span-2">
                        <label>Observaciones</label>
                        <textarea name="observaciones" class="w-full border-gray-300 rounded-lg" rows="3"></textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('solicitudes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
