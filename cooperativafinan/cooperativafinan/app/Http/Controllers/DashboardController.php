<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Pago;
use App\Models\Solicitud;
use App\Models\Cita;
use App\Models\TipoCredito;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Métricas generales
        $totalClientes = Cliente::count();
        $creditosActivos = Credito::where('estado','activo')->count();
        $pagosRecibidos = Pago::sum('monto_pagado');

        $ultimosCreditos = Credito::latest()->take(5)->get();
        $solicitudesPendientes = Solicitud::where('estado','pendiente')->count();
        $citasHoy = Cita::whereDate('fecha_hora', now())->count();

        // Gráficos
        $tiposCreditoLabels = TipoCredito::pluck('nombre');
        $tiposCreditoValues = $tiposCreditoLabels->map(fn($tipo) =>
            Credito::whereHas('tipo', fn($q)=>$q->where('nombre',$tipo))->count()
        );

        $meses = collect(range(1,12))->map(fn($m) => date('F', mktime(0,0,0,$m,1)))->toArray();
        $pagosPorMes = collect(range(1,12))->map(fn($m) =>
            Pago::whereMonth('created_at',$m)->sum('monto_pagado')
        )->toArray();

        // Notificaciones por rol
        $notificaciones = [];

        if($user->hasRole('Administrador')) {
            $nuevosCreditos = Credito::where('estado','pendiente')->count();
            if($nuevosCreditos > 0){
                $notificaciones[] = [
                    'title' => 'Nuevos Créditos Pendientes',
                    'text' => "Tienes $nuevosCreditos créditos pendientes",
                    'icon' => 'info'
                ];
            }
        }

        if($user->hasRole('Cajero')) {
            $pagosHoy = Pago::whereDate('created_at', now())->count();
            if($pagosHoy > 0){
                $notificaciones[] = [
                    'title' => 'Pagos Recibidos Hoy',
                    'text' => "Se han registrado $pagosHoy pagos hoy",
                    'icon' => 'success'
                ];
            }
        }

        if($user->hasRole('Atencion')) {
            $solicitudesPendientes = Solicitud::where('estado','pendiente')->count();
            if($solicitudesPendientes > 0){
                $notificaciones[] = [
                    'title' => 'Solicitudes Pendientes',
                    'text' => "Tienes $solicitudesPendientes solicitudes por revisar",
                    'icon' => 'warning'
                ];
            }
        }

        return view('dashboard', compact(
            'totalClientes','creditosActivos','pagosRecibidos',
            'ultimosCreditos','solicitudesPendientes','citasHoy',
            'tiposCreditoLabels','tiposCreditoValues',
            'meses','pagosPorMes','notificaciones'
        ));
    }
}
