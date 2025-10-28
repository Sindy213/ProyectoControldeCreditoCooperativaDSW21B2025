<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Credito;
use App\Models\Cliente;
use App\Models\TipoCredito;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    // Middleware para permisos
    public function __construct()
    {
        $this->middleware('permission:creditos.view', ['only' => ['index','show']]);
        $this->middleware('permission:creditos.create', ['only' => ['create','store']]);
        $this->middleware('permission:creditos.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:creditos.close', ['only' => ['destroy']]);
    }

    // Mostrar todos los créditos
    public function index()
    {
        $creditos = Credito::with('cliente','tipo','pagos')->get();
        return view('creditos.index', compact('creditos'));
    }

    // Formulario para crear crédito
    public function create()
    {
        $clientes = Cliente::all();
        $tipos = TipoCredito::all();
        return view('creditos.create', compact('clientes','tipos'));
    }

    // Guardar crédito nuevo
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_credito_id' => 'required|exists:tipo_creditos,id',
            'monto_capital' => 'required|numeric|min:1',
            'plazo_meses' => 'required|integer|min:1',
            'tasa_anual' => 'required|numeric|min:0',
            'fecha_desembolso' => 'required|date',
        ]);

        $cliente = Cliente::find($request->cliente_id);
        $tipo = TipoCredito::find($request->tipo_credito_id);

        // Calcular interés total y cuota mensual
        $interes_total = $request->monto_capital * ($request->tasa_anual/100) * ($request->plazo_meses/12);
        $cuota_mensual = ($request->monto_capital + $interes_total)/$request->plazo_meses;

        // Generar amortización simple
        $amortization = [];
        $saldo = $request->monto_capital + $interes_total;
        for($i=1; $i<=$request->plazo_meses; $i++){
            $amortization[] = [
                'mes' => $i,
                'cuota' => round($cuota_mensual,2),
                'saldo_restante' => round($saldo - $cuota_mensual,2)
            ];
            $saldo -= $cuota_mensual;
        }

        $credito = Credito::create([
            'cliente_id' => $request->cliente_id,
            'tipo_credito_id' => $request->tipo_credito_id,
            'numero_credito' => 'CR'.time(),
            'monto_capital' => $request->monto_capital,
            'tasa_anual' => $request->tasa_anual,
            'plazo_meses' => $request->plazo_meses,
            'fecha_desembolso' => $request->fecha_desembolso,
            'fecha_finalizacion' => now()->addMonths($request->plazo_meses),
            'saldo' => $request->monto_capital + $interes_total,
            'cuota_mensual' => round($cuota_mensual,2),
            'interes_total' => round($interes_total,2),
            'estado' => 'activo',
            'pagos_realizados' => 0,
            'amortization_json' => $amortization
        ]);

        return redirect()->route('creditos.index')->with('success','Crédito creado correctamente.');
    }

    // Formulario para editar crédito
    public function edit(Credito $credito)
    {
        $clientes = Cliente::all();
        $tipos = TipoCredito::all();
        return view('creditos.edit', compact('credito','clientes','tipos'));
    }

    // Actualizar crédito
    public function update(Request $request, Credito $credito)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_credito_id' => 'required|exists:tipo_creditos,id',
            'monto_capital' => 'required|numeric|min:1',
            'plazo_meses' => 'required|integer|min:1',
            'tasa_anual' => 'required|numeric|min:0',
        ]);

        $interes_total = $request->monto_capital * ($request->tasa_anual/100) * ($request->plazo_meses/12);
        $cuota_mensual = ($request->monto_capital + $interes_total)/$request->plazo_meses;

        // Generar nueva amortización
        $amortization = [];
        $saldo = $request->monto_capital + $interes_total;
        for($i=1; $i<=$request->plazo_meses; $i++){
            $amortization[] = [
                'mes' => $i,
                'cuota' => round($cuota_mensual,2),
                'saldo_restante' => round($saldo - $cuota_mensual,2)
            ];
            $saldo -= $cuota_mensual;
        }

        $credito->update([
            'cliente_id' => $request->cliente_id,
            'tipo_credito_id' => $request->tipo_credito_id,
            'monto_capital' => $request->monto_capital,
            'tasa_anual' => $request->tasa_anual,
            'plazo_meses' => $request->plazo_meses,
            'fecha_finalizacion' => now()->addMonths($request->plazo_meses),
            'saldo' => $request->monto_capital + $interes_total,
            'cuota_mensual' => round($cuota_mensual,2),
            'interes_total' => round($interes_total,2),
            'amortization_json' => $amortization
        ]);

        return redirect()->route('creditos.index')->with('success','Crédito actualizado correctamente.');
    }

    // Cerrar crédito
    public function destroy(Credito $credito)
    {
        $credito->estado = 'cerrado';
        $credito->saldo = 0;
        $credito->save();

        return redirect()->route('creditos.index')->with('success','Crédito cerrado correctamente.');
    }


    public function exportPdf()
    {
       $creditos = Credito::with('cliente','tipo')->get();
       $pdf = Pdf::loadView('creditos.pdf', compact('creditos'));
       return $pdf->download('creditos.pdf');
    }                
}
