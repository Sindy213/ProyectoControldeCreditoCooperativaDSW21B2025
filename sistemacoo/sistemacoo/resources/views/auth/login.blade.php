<x-guest-layout>
    @php $title = 'Iniciar Sesión' @endphp
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Inicia sesión</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div class="relative">
            <label for="email" class="sr-only">Correo</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
            </div>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="Correo electrónico"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Contraseña -->
        <div class="relative">
            <label for="password" class="sr-only">Contraseña</label>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="Contraseña"
                   class="block w-full pl-10 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Recordarme y olvidar contraseña -->
        <div class="flex items-center justify-between">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">Recordarme</span>
            </label>
            <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                ¿Olvidaste tu contraseña?
            </a>
        </div>

        <!-- Botón -->
        <div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg">
                Iniciar Sesión
            </button>
        </div>

        <p class="text-center text-sm text-gray-600 mt-4">
            ¿No tienes cuenta? 
            <a class="text-blue-600 hover:underline" href="{{ route('register') }}">Regístrate</a>
        </p>
    </form>
</x-guest-layout>
