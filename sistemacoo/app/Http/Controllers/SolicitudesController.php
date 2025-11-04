<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Cliente;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::with('cliente')->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('solicitudes.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'fecha_solicitud' => 'required|date',
            'monto_solicitado' => 'required|numeric',
            'estado' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        Solicitud::create($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada correctamente.');
    }

    public function show(string $id)
    {
        $solicitud = Solicitud::with('cliente')->findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    public function edit(string $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $clientes = Cliente::all();
        return view('solicitudes.edit', compact('solicitud', 'clientes'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'fecha_solicitud' => 'required|date',
            'monto_solicitado' => 'required|numeric',
            'estado' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada correctamente.');
    }
}
