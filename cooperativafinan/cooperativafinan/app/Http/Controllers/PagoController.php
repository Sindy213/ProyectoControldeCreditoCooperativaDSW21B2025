<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pago;
use App\Models\Credito;
use App\Models\User;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    // Middleware de permisos
    public function __construct()
    {
        $this->middleware('permission:pagos.view', ['only' => ['index','show']]);
        $this->middleware('permission:pagos.create', ['only' => ['create','store']]);
    }

    // Mostrar todos los pagos
    public function index()
    {
        $pagos = Pago::with('credito.cliente','user')->orderBy('fecha_pago','desc')->get();
        return view('pagos.index', compact('pagos'));
    }

    // Formulario para registrar pago
    public function create()
    {
        $creditos = Credito::where('estado','activo')->get();
        $usuarios = User::all();
        return view('pagos.create', compact('creditos','usuarios'));
    }

    // Guardar pago
    public function store(Request $request)
    {
        $request->validate([
            'credito_id' => 'required|exists:creditos,id',
            'user_id' => 'required|exists:users,id',
            'fecha_pago' => 'required|date',
            'monto_pagado' => 'required|numeric|min:0.01',
            'tipo_pago' => 'required|string|max:255',
            'nota' => 'nullable|string'
        ]);

        $credito = Credito::find($request->credito_id);

        // Actualizar saldo del crédito
        $saldo_despues = $credito->saldo - $request->monto_pagado;
        $credito->saldo = max($saldo_despues, 0);
        $credito->pagos_realizados += 1;

        if($credito->saldo <= 0){
            $credito->estado = 'cerrado';
        }

        $credito->save();

        // Registrar pago
        Pago::create([
            'credito_id' => $request->credito_id,
            'user_id' => $request->user_id,
            'fecha_pago' => $request->fecha_pago,
            'monto_pagado' => $request->monto_pagado,
            'tipo_pago' => $request->tipo_pago,
            'saldo_despues' => $credito->saldo,
            'nota' => $request->nota
        ]);

        return redirect()->route('pagos.index')->with('success','Pago registrado correctamente.');
    }

    // Ver detalle de un pago
    public function show(Pago $pago)
    {
        return view('pagos.show', compact('pago'));
    }

    public function exportPdf()
    {

      $pagos = Pago::with('credito.cliente')->get();
      $pdf = Pdf::loadView('pagos.pdf', compact('pagos'));
      return $pdf->download('pagos.pdf');

    }
 
}
