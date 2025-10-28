<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('cliente')->orderBy('fecha_cita','asc')->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('citas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'fecha_cita' => 'required|date',
            'hora' => 'required',
            'asesor_asignado' => 'required|string|max:255',
            'motivo' => 'required|string',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada correctamente');
    }

    public function show(Cita $cita)
    {
        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        $clientes = Cliente::all();
        return view('citas.edit', compact('cita','clientes'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'fecha_cita' => 'required|date',
            'hora' => 'required',
            'asesor_asignado' => 'required|string|max:255',
            'motivo' => 'required|string',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
    }
}
