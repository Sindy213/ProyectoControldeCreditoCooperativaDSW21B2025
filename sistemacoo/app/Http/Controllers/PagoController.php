<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Credito;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Traer todos los pagos con información del crédito
        $pagos = Pago::with('credito')->orderBy('fecha_pago', 'desc')->get();
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener créditos para relacionar con el pago
        $creditos = Credito::all();
        return view('pagos.create', compact('creditos'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pago = Pago::with('credito')->findOrFail($id);
        return view('pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        $creditos = Credito::all();
        return view('pagos.edit', compact('pago', 'creditos'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente.');
    }
}
