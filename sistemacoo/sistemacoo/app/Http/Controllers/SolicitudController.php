<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Solicitud;
use App\Models\Cliente;
use App\Models\TipoCredito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    // Middleware de permisos
    public function __construct()
    {
        
    }

    // Mostrar todas las solicitudes
    public function index()
    {
        $solicitudes = Solicitud::with('cliente','tipo','revisor')->orderBy('created_at','desc')->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    // Formulario para crear solicitud
    public function create()
    {
        $clientes = Cliente::all();
        $tipos = TipoCredito::all();
        return view('solicitudes.create', compact('clientes','tipos'));
    }

    // Guardar solicitud nueva
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_credito_id' => 'required|exists:tipo_creditos,id',
            'monto_solicitado' => 'required|numeric|min:1',
            'plazo_meses' => 'required|integer|min:1',
            'ingresos_declared' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string'
        ]);

        Solicitud::create([
            'cliente_id' => $request->cliente_id,
            'tipo_credito_id' => $request->tipo_credito_id,
            'monto_solicitado' => $request->monto_solicitado,
            'plazo_meses' => $request->plazo_meses,
            'ingresos_declared' => $request->ingresos_declared,
            'estado' => 'pendiente',
            'observaciones' => $request->observaciones
        ]);

        return redirect()->route('solicitudes.index')->with('success','Solicitud creada correctamente.');
    }

    // Ver detalle de solicitud
    public function show(Solicitud $solicitud)
    {
        return view('solicitudes.show', compact('solicitud'));
    }

    // Revisar solicitud (cambiar estado a revisada)
    public function revisar(Solicitud $solicitud)
    {
        $solicitud->estado = 'revisada';
        $solicitud->revisado_por = Auth::id();
        $solicitud->save();

        return redirect()->route('solicitudes.index')->with('success','Solicitud revisada correctamente.');
    }

    // Aprobar solicitud
    public function aprobar(Solicitud $solicitud)
    {
        $solicitud->estado = 'aprobada';
        $solicitud->revisado_por = Auth::id();
        $solicitud->save();

        return redirect()->route('solicitudes.index')->with('success','Solicitud aprobada.');
    }

    // Rechazar solicitud
    public function rechazar(Solicitud $solicitud)
    {
        $solicitud->estado = 'rechazada';
        $solicitud->revisado_por = Auth::id();
        $solicitud->save();

        return redirect()->route('solicitudes.index')->with('success','Solicitud rechazada.');
    }
    

     public function exportPdf()
    {

      $solicitudes = Solicitud::with('cliente','tipo','revisor')->get();
      $pdf = Pdf::loadView('solicitudes.pdf', compact('solicitudes'));
      return $pdf->download('solicitudes.pdf');

    }

}



