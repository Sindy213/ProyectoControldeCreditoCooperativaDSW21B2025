<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TipocreditoController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Rutas de autenticación de Breeze
require __DIR__.'/auth.php';

// Redirige la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login / Logout usando nuestro controlador con roles
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// Dashboards por rol
Route::middleware('auth')->group(function () {

    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboards específicos por rol
    Route::get('/admin', function () { return view('dashboard.admin'); })->name('dashboard.admin');
    Route::get('/atencion', function () { return view('dashboard.atencion'); })->name('dashboard.atencion');
    Route::get('/cajero', function () { return view('dashboard.cajero'); })->name('dashboard.cajero');

    // Recursos protegidos en el orden solicitado

    // 1️⃣ Clientes
    Route::resource('clientes', ClienteController::class);
    Route::get('clientes/export-pdf', [ClienteController::class, 'exportPdf'])->name('clientes.exportPdf');

    // 2️⃣ Tipos de Crédito
    Route::resource('tiposcreditos', TipocreditoController::class);
    Route::get('tiposcreditos/export-pdf', [TipocreditoController::class, 'exportPdf'])->name('tiposcreditos.exportPdf');

    // 3️⃣ Créditos
    Route::resource('creditos', CreditoController::class);
    Route::get('creditos/export-pdf', [CreditoController::class, 'exportPdf'])->name('creditos.exportPdf');

    // 4️⃣ Solicitudes
    Route::resource('solicitudes', SolicitudController::class);
    Route::get('solicitudes/export-pdf', [SolicitudController::class, 'exportPdf'])->name('solicitudes.exportPdf');

    // 5️⃣ Pagos
    Route::resource('pagos', PagoController::class);
    Route::get('pagos/export-pdf', [PagoController::class, 'exportPdf'])->name('pagos.exportPdf');

    // 6️⃣ Citas
    Route::resource('citas', CitaController::class);
    Route::get('citas/export-pdf', [CitaController::class, 'exportPdf'])->name('citas.exportPdf');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
