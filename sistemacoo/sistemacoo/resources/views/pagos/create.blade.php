<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">➕ Registrar Pago</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form action="{{ route('pagos.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block">Crédito</label>
                        <select name="credito_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Seleccione un crédito</option>
                            @foreach($creditos as $c)
                                <option value="{{ $c->id }}">{{ $c->numero_credito }} — {{ $c->cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block">Usuario</label>
                        <select name="user_id" class="w-full border-gray-300 rounded-lg" required>
                            @foreach($usuarios as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label class="block">Monto Pagado</label>
                        <input type="number" step="0.01" name="monto_pagado" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label class="block">Tipo de Pago</label>
                        <select name="tipo_pago" class="w-full border-gray-300 rounded-lg" required>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Transferencia">Transferencia</option>
                            <option value="Depósito">Depósito</option>
                        </select>
                    </div>

                    <div>
                        <label class="block">Nota (opcional)</label>
                        <textarea name="nota" class="w-full border-gray-300 rounded-lg" rows="2"></textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('pagos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
