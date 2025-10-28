<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\TipocreditoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

// Autenticación Breeze
require __DIR__.'/auth.php';

// Redirigir raíz al login
Route::get('/', fn() => redirect()->route('login'));

// Rutas protegidas por auth
Route::middleware('auth')->group(function () {

    // --------------------------
    // DASHBOARD
    // --------------------------
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --------------------------
    // PERFIL
    // --------------------------
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // --------------------------
    // CLIENTES
    // --------------------------
    Route::prefix('Administrador')->group(function () {
        Route::middleware('permission:Administrador.view')->group(function () {
            Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');
            Route::get('{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
            Route::get('pdf', [ClienteController::class, 'exportPdf'])->name('clientes.pdf');
        });
        Route::middleware('permission:Administrador.create')->group(function () {
            Route::get('create', [ClienteController::class, 'create'])->name('clientes.create');
            Route::post('/', [ClienteController::class, 'store'])->name('clientes.store');
        });
        Route::middleware('permission:Administrador.edit')->group(function () {
            Route::get('{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
            Route::put('{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
        });
        Route::middleware('permission:Administrador.delete')->delete('{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    });

    // --------------------------
    // CRÉDITOS
    // --------------------------
    Route::prefix('creditos')->group(function () {
        Route::middleware('permission:creditos.view')->group(function () {
            Route::get('/', [CreditoController::class, 'index'])->name('creditos.index');
            Route::get('{credito}', [CreditoController::class, 'show'])->name('creditos.show');
            Route::get('pdf', [CreditoController::class, 'exportPdf'])->name('creditos.pdf');
        });
        Route::middleware('permission:creditos.create')->group(function () {
            Route::get('create', [CreditoController::class, 'create'])->name('creditos.create');
            Route::post('/', [CreditoController::class, 'store'])->name('creditos.store');
        });
        Route::middleware('permission:creditos.edit')->group(function () {
            Route::get('{credito}/edit', [CreditoController::class, 'edit'])->name('creditos.edit');
            Route::put('{credito}', [CreditoController::class, 'update'])->name('creditos.update');
        });
        Route::middleware('permission:creditos.close')->delete('{credito}', [CreditoController::class, 'destroy'])->name('creditos.destroy');
    });

    // --------------------------
    // PAGOS
    // --------------------------
    Route::prefix('pagos')->group(function () {
        Route::middleware('permission:pagos.view')->group(function () {
            Route::get('/', [PagoController::class, 'index'])->name('pagos.index');
            Route::get('pdf', [PagoController::class, 'exportPdf'])->name('pagos.pdf');
        });
        Route::middleware('permission:pagos.create')->group(function () {
            Route::get('create', [PagoController::class, 'create'])->name('pagos.create');
            Route::post('/', [PagoController::class, 'store'])->name('pagos.store');
        });
        Route::middleware('permission:pagos.delete')->delete('{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');
    });

    // --------------------------
    // SOLICITUDES
    // --------------------------
    Route::prefix('solicitudes')->group(function () {
        Route::middleware('permission:solicitudes.review')->group(function () {
            Route::get('/', [SolicitudController::class, 'index'])->name('solicitudes.index');
            Route::get('pdf', [SolicitudController::class, 'exportPdf'])->name('solicitudes.pdf');
        });
        Route::middleware('permission:solicitudes.create')->group(function () {
            Route::get('create', [SolicitudController::class, 'create'])->name('solicitudes.create');
            Route::post('/', [SolicitudController::class, 'store'])->name('solicitudes.store');
        });
        Route::middleware('permission:solicitudes.approve')->put('{solicitud}/approve', [SolicitudController::class, 'approve'])->name('solicitudes.approve');
        Route::middleware('permission:solicitudes.reject')->put('{solicitud}/reject', [SolicitudController::class, 'reject'])->name('solicitudes.reject');
    });

    // --------------------------
    // CITAS
    // --------------------------
    Route::middleware('permission:citas.manage')->group(function () {
        Route::get('citas/pdf', [CitaController::class, 'exportPdf'])->name('citas.pdf');
        Route::resource('citas', CitaController::class);
    });

    // --------------------------
    // TIPOS DE CRÉDITOS
    // --------------------------
    Route::middleware('permission:dashboard.view')->group(function () {
        Route::get('tiposcreditos/pdf', [TipocreditoController::class, 'exportPdf'])->name('tiposcreditos.pdf');
        Route::resource('tiposcreditos', TipocreditoController::class);
    });

    // --------------------------
    // REPORTES
    // --------------------------
    Route::middleware('permission:reports.view')->group(function () {
        Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
        Route::get('reportes/pdf', [ReporteController::class, 'exportPdf'])->name('reportes.exportPdf');
    });

    // --------------------------
    // USUARIOS
    // --------------------------
    Route::middleware('permission:users.manage')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // --------------------------
    // ROLES
    // --------------------------
    Route::middleware('permission:roles.manage')->prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store');
        Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // --------------------------
    // PERMISOS
    // --------------------------
    Route::middleware('permission:permissions.manage')->prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });


});
