<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <!-- Logo simple -->
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-600 to-sky-500 flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3L3 7v6c0 5 4 9 9 9s9-4 9-9V7l-9-4z" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12h8M8 16h8" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-100">Sistema de Control de Crédito</h1>
                    <p class="text-sm text-gray-500">Cooperativa Financiera — Panel de administración</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-white/30 backdrop-blur border border-gray-200 hover:shadow-md transition">
                    <svg class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10zM3 21a9 9 0 0118 0" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-sm text-gray-700">Mi Perfil</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen relative overflow-hidden" style="background: linear-gradient(135deg, #e0e7ff 0%, #f0f9ff 100%);">
        <div class="absolute inset-0 bg-[url('/images/pattern.svg')] bg-repeat opacity-10 animate-pulse-slow"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Mensaje de bienvenida --}}
            <div class="mb-6">
                @php $rol = Auth::user()->rol; @endphp
                <div class="p-4 mb-4 rounded-lg bg-{{ $rol == 'Administrador' ? 'green' : ($rol == 'Cajero' ? 'blue' : 'purple') }}-100/70 backdrop-blur shadow text-{{ $rol == 'Administrador' ? 'green' : ($rol == 'Cajero' ? 'blue' : 'purple') }}-800 border border-{{ $rol == 'Administrador' ? 'green' : ($rol == 'Cajero' ? 'blue' : 'purple') }}-200">
                    Bienvenido, {{ $rol }} {{ Auth::user()->name }}.
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700">Accesos rápidos</h2>
                <p class="text-sm text-gray-500 mt-1">Navega directamente a los módulos. Interfaz diseñada para gestión rápida y profesional.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Clientes --}}
                <a href="{{ route('clientes.index') }}" class="group block transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative overflow-hidden rounded-2xl bg-white/30 backdrop-blur p-6 border border-white/20 shadow-lg hover:shadow-2xl transition">
                        <div class="absolute -left-10 -top-10 w-36 h-36 rounded-full bg-gradient-to-tr from-indigo-200 to-indigo-400 opacity-20 animate-pulse"></div>
                        <div class="flex items-start">
                            <div class="w-16 h-16 rounded-lg flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 mr-4 shadow-inner group-hover:scale-105 transform transition">
                                <svg class="w-9 h-9 text-blue-600" viewBox="0 0 24 24" fill="none">
                                    <path d="M16 11a4 4 0 10-8 0" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3 21v-2a4 4 0 014-4h10a4 4 0 014 4v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-700 transition">Clientes</h3>
                                <p class="mt-1 text-sm text-gray-500">Gestiona la lista de socios y sus datos</p>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Tipo de Créditos --}}
                <a href="{{ route('tiposcreditos.index') }}" class="group block transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative overflow-hidden rounded-2xl bg-white/30 backdrop-blur p-6 border border-white/20 shadow-lg hover:shadow-2xl transition">
                        <div class="absolute -right-10 -top-10 w-36 h-36 rounded-full bg-gradient-to-tr from-purple-200 to-pink-400 opacity-20 animate-pulse"></div>
                        <div class="flex items-start">
                            <div class="w-16 h-16 rounded-lg flex items-center justify-center bg-gradient-to-br from-pink-50 to-pink-100 mr-4 shadow-inner">
                                <svg class="w-9 h-9 text-pink-600" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 8c-3.86 0-7 1.5-7 4s3.14 4 7 4 7-1.5 7-4-3.14-4-7-4z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 12v6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-pink-700 transition">Tipos de Crédito</h3>
                                <p class="mt-1 text-sm text-gray-500">Gestiona los tipos de crédito y sus condiciones</p>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Créditos --}}
                <a href="{{ route('creditos.index') }}" class="group block transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative overflow-hidden rounded-2xl bg-white/30 backdrop-blur p-6 border border-white/20 shadow-lg hover:shadow-2xl transition">
                        <div class="absolute right-[-2rem] top-[-1.8rem] w-40 h-40 rounded-full bg-gradient-to-tr from-emerald-200 to-green-400 opacity-18 animate-pulse"></div>
                        <div class="flex items-start">
                            <div class="w-16 h-16 rounded-lg flex items-center justify-center bg-gradient-to-br from-green-50 to-green-100 mr-4 shadow-inner">
                                <svg class="w-9 h-9 text-green-600" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 8c-3.86 0-7 1.5-7 4s3.14 4 7 4 7-1.5 7-4-3.14-4-7-4z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 12v6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-green-700 transition">Créditos</h3>
                                <p class="mt-1 text-sm text-gray-500">Administración de créditos, cuotas y condiciones</p>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Solicitudes --}}
                <a href="{{ route('solicitudes.index') }}" class="group block transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative overflow-hidden rounded-2xl bg-white/30 backdrop-blur p-6 border border-white/20 shadow-lg hover:shadow-2xl transition">
                        <div class="absolute -left-10 -bottom-10 w-36 h-36 rounded-full bg-gradient-to-tr from-yellow-200 to-orange-400 opacity-20 animate-pulse"></div>
                        <div class="flex items-start">
                            <div class="w-16 h-16 rounded-lg flex items-center justify-center bg-gradient-to-br from-yellow-50 to-yellow-100 mr-4 shadow-inner">
                                <svg class="w-9 h-9 text-yellow-600" viewBox="0 0 24 24" fill="none">
                                    <path d="M3 7h18M3 12h18M3 17h18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-yellow-700 transition">Solicitudes</h3>
                                <p class="mt-1 text-sm text-gray-500">Registro y seguimiento de solicitudes de crédito</p>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Pagos --}}
                <a href="{{ route('pagos.index') }}" class="group block transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative overflow-hidden rounded-2xl bg-white/30 backdrop-blur p-6 border border-white/20 shadow-lg hover:shadow-2xl transition">
                        <div class="absolute right-[-10] -top-10 w-36 h-36 rounded-full bg-gradient-to-tr from-red-200 to-pink-300 opacity-20 animate-pulse"></div>
                        <div class="flex items-start">
                            <div class="w-16 h-16 rounded-lg flex items-center justify-center bg-gradient-to-br from-red-50 to-red-100 mr-4 shadow-inner">
                                <svg class="w-9 h-9 text-red-600" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 3v18M3 12h18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-red-700 transition">Pagos</h3>
                                <p class="mt-1 text-sm text-gray-500">Registro de pagos y seguimiento de cuotas</p>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Citas --}}
                <a href="{{ route('citas.index') }}" class="group block transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative overflow-hidden rounded-2xl bg-white/30 backdrop-blur p-6 border border-white/20 shadow-lg hover:shadow-2xl transition">
                        <div class="absolute -left-10 -top-10 w-36 h-36 rounded-full bg-gradient-to-tr from-teal-200 to-cyan-400 opacity-20 animate-pulse"></div>
                        <div class="flex items-start">
                            <div class="w-16 h-16 rounded-lg flex items-center justify-center bg-gradient-to-br from-cyan-50 to-cyan-100 mr-4 shadow-inner">
                                <svg class="w-9 h-9 text-cyan-600" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.6"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-cyan-700 transition">Citas</h3>
                                <p class="mt-1 text-sm text-gray-500">Agendamiento de citas y seguimiento</p>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
