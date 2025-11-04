<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\SolicitudesController;
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
    
    // Dashboard principal (controlador)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboards específicos por rol (si deseas mantenerlos)
    Route::get('/admin', function () { return view('dashboard.admin'); })->name('dashboard.admin');
    Route::get('/atencion', function () { return view('dashboard.atencion'); })->name('dashboard.atencion');
    Route::get('/cajero', function () { return view('dashboard.cajero'); })->name('dashboard.cajero');
    

    // Recursos protegidos
    Route::resource('clientes', ClienteController::class);
    Route::resource('creditos', CreditoController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('solicitudes', SolicitudesController::class);
    Route::resource('citas', CitaController::class);
    Route::get('/pagos/{id}/comprobante', [PagoController::class, 'comprobante'])->name('pagos.comprobante');


    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
