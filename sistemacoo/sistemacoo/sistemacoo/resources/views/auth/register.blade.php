<x-guest-layout>
    @php $title = 'Registro de Usuario' @endphp
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Crea tu cuenta</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- DUI -->
        <div class="relative">
            <label for="dui" class="sr-only">DUI</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-id-card text-gray-400"></i>
            </div>
            <input id="dui" name="dui" type="text" value="{{ old('dui') }}" required placeholder="DUI"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('dui') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Nombre completo -->
        <div class="relative">
            <label for="nombrecompleto" class="sr-only">Nombre completo</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-user text-gray-400"></i>
            </div>
            <input id="nombrecompleto" name="nombrecompleto" type="text" value="{{ old('nombrecompleto') }}" required placeholder="Nombre completo"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('nombrecompleto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Dirección -->
        <div class="relative">
            <label for="direccion" class="sr-only">Dirección</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-map-marker-alt text-gray-400"></i>
            </div>
            <input id="direccion" name="direccion" type="text" value="{{ old('direccion') }}" required placeholder="Dirección"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('direccion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Fecha de nacimiento -->
        <div class="relative">
            <label for="fechanacimiento" class="sr-only">Fecha de nacimiento</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-calendar text-gray-400"></i>
            </div>
            <input id="fechanacimiento" name="fechanacimiento" type="date" value="{{ old('fechanacimiento') }}" required
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('fechanacimiento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Teléfono -->
        <div class="relative">
            <label for="telefono" class="sr-only">Teléfono</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-phone text-gray-400"></i>
            </div>
            <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}" required placeholder="Teléfono"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="relative">
            <label for="email" class="sr-only">Correo</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
            </div>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="Correo electrónico"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Contraseña -->
        <div class="relative">
            <label for="password" class="sr-only">Contraseña</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input id="password" name="password" type="password" required placeholder="Contraseña"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div class="relative">
            <label for="password_confirmation" class="sr-only">Confirmar contraseña</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Confirmar contraseña"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Rol -->
        <div class="relative">
            <label for="rol" class="sr-only">Rol</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-user-tag text-gray-400"></i>
            </div>
            <select id="rol" name="rol" class="block w-full pl-10 border border-gray-300 rounded-lg p-2" required>
                <option value="">-- Seleccione un rol --</option>
                <option value="Administrador">Administrador</option>
                <option value="Atencion al Cliente">Atención al Cliente</option>
                <option value="Cajero">Cajero</option>
            </select>
            @error('rol') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Botón -->
        <div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg">
                Registrarse
            </button>
        </div>

        <p class="text-center text-sm text-gray-600 mt-4">
            ¿Ya tienes cuenta? 
            <a class="text-blue-600 hover:underline" href="{{ route('login') }}">Inicia sesión</a>
        </p>
    </form>
</x-guest-layout>
