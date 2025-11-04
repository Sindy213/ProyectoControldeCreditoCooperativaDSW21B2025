<x-app-layout>
    {{-- ================== TÍTULO DE PÁGINA ================== --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🧾 Registrar Cliente
        </h2>
    </x-slot>

    {{-- ================== CONTENIDO PRINCIPAL ================== --}}
    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- Mensajes de validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-4 p-3 rounded" style="background-color: #ffe0e0; color:#7a0000;">
                        <strong>⚠️ Ocurrieron algunos errores:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Mensaje de éxito --}}
                @if (session('success'))
                    <div class="alert alert-success mb-4 p-3 rounded" style="background-color:#e0ffe0; color:#005a00;">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                {{-- ================== FORMULARIO ================== --}}
                <form action="{{ route('clientes.store') }}" method="POST" class="d-grid gap-4">
                    @csrf

                    <div class="form-group">
                        <label class="form-label fw-semibold">👤 Nombre Completo</label>
                        <input type="text" name="nombre_completo" value="{{ old('nombre_completo') }}"
                            class="form-control input-glass" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-semibold">🆔 DUI</label>
                        <input type="text" name="dui" value="{{ old('dui') }}" class="form-control input-glass" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-semibold">🏠 Dirección</label>
                        <input type="text" name="direccion" value="{{ old('direccion') }}"
                            class="form-control input-glass">
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-semibold">📞 Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}"
                            class="form-control input-glass">
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-semibold">📧 Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control input-glass"
                            required>
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-semibold">⚧ Género</label>
                        <select id="genero" name="genero" class="form-select input-glass" required>
                            <option value="" disabled {{ old('genero') ? '' : 'selected' }}>Seleccione...</option>
                            <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino
                            </option>
                            <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino
                            </option>
                            <option value="LGBT" {{ old('genero') == 'LGBT' ? 'selected' : '' }}>LGBT</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-semibold">💍 Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" class="form-select input-glass" required>
                            <option value="" selected disabled>Seleccione...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-semibold">🎂 Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                            class="form-control input-glass">
                    </div>

                    {{-- ======= BOTONES ======= --}}
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="submit" class="btn btn-gradient-lg shadow-lg text-white">
                            💾 Guardar
                        </button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-lg shadow-sm">
                            ↩ Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================== ESTILOS ================== --}}
    <style>
        .text-gradient {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .input-glass {
            border-radius: 12px;
            padding: 0.65rem 1rem;
            font-size: 1.05rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #ccc;
            background-color: #f9f9ff;
        }

        .btn-gradient-lg {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            font-size: 1.1rem;
            padding: 0.7rem 1.5rem;
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.3s;
        }

        .btn-gradient-lg:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
    </style>

    {{-- ================== SCRIPT ================== --}}
    <script>
        const generoSelect = document.getElementById('genero');
        const estadoCivilSelect = document.getElementById('estado_civil');

        const opcionesEstadoCivil = {
            'Masculino': ['Soltero', 'Casado'],
            'Femenino': ['Soltera', 'Casada'],
            'LGBT': ['Soltero/a', 'Casado/a']
        };

        generoSelect.addEventListener('change', function() {
            const genero = this.value;
            estadoCivilSelect.innerHTML = '<option value="" selected disabled>Seleccione...</option>';

            if (opcionesEstadoCivil[genero]) {
                opcionesEstadoCivil[genero].forEach(function(estado) {
                    const option = document.createElement('option');
                    option.value = estado;
                    option.text = estado;
                    if ("{{ old('estado_civil') }}" === estado) {
                        option.selected = true;
                    }
                    estadoCivilSelect.appendChild(option);
                });
            }
        });

        // Mantiene la selección previa si se recarga la página
        window.addEventListener('DOMContentLoaded', () => {
            const oldGenero = "{{ old('genero') }}";
            if (oldGenero) {
                generoSelect.value = oldGenero;
                generoSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>
