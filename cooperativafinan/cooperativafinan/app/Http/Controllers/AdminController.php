<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Pago;
use App\Models\Solicitud;
use App\Models\Cita;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();
        $totalRoles = Role::count();
        $totalPermisos = Permission::count();
        $totalClientes = Cliente::count();
        $creditosActivos = Credito::where('estado', 'activo')->count();
        $pagosHoy = Pago::whereDate('created_at', now())->sum('monto_pagado');
        $solicitudesPendientes = Solicitud::where('estado', 'pendiente')->count();
        $citasHoy = Cita::whereDate('fecha_hora', now())->count();

        // Gráficos simples por tipo de crédito
        $tiposCredito = Credito::with('tipo')->get()->groupBy('tipo.nombre')->map->count();

        return view('admin.dashboard', compact(
            'totalUsuarios', 'totalRoles', 'totalPermisos', 'totalClientes',
            'creditosActivos', 'pagosHoy', 'solicitudesPendientes', 'citasHoy', 'tiposCredito'
        ));
    }
}
