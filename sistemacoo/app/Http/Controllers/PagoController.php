<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Credito;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('credito')->orderBy('fecha_pago', 'desc')->get();
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $creditos = Credito::with('cliente')->get();
        return view('pagos.create', compact('creditos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_credito' => 'required|exists:creditos,id',
            'fecha_pago' => 'required|date',
            'monto_pagado' => 'required|numeric|min:0',
            'saldo_restante' => 'required|numeric|min:0',
            'cajero_responsable' => 'required|string|max:255',
            'numero_comprobante' => 'required|string|max:255|unique:pagos',
        ]);

        Pago::create($request->all());
        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente.');
    }

    public function show($id)
    {
        $pago = Pago::with('credito')->findOrFail($id);
        return view('pagos.show', compact('pago'));
    }

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        $creditos = Credito::with('cliente')->get();
        return view('pagos.edit', compact('pago', 'creditos'));
    }

    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);
        $request->validate([
            'id_credito' => 'required|exists:creditos,id',
            'fecha_pago' => 'required|date',
            'monto_pagado' => 'required|numeric|min:0',
            'saldo_restante' => 'required|numeric|min:0',
            'cajero_responsable' => 'required|string|max:255',
            'numero_comprobante' => 'required|string|max:255|unique:pagos,numero_comprobante,' . $pago->id,
        ]);

        $pago->update($request->all());
        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy($id)
    {
        Pago::findOrFail($id)->delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente.');
    }

    public function comprobante($id)
    {
        $pago = Pago::with('credito.cliente')->findOrFail($id);
        $pdf = Pdf::loadView('pagos.comprobante', compact('pago'));
        return $pdf->download('comprobante_pago_'.$pago->id.'.pdf');
    }
}
