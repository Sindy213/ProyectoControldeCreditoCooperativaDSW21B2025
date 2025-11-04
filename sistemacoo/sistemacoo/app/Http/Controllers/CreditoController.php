<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    /**
     * Muestra todos los créditos
     */
    public function index()
    {
        $creditos = Credito::with('cliente')->get(); // Incluye datos del cliente
        return view('creditos.index', compact('creditos'));
    }

    /**
     * Formulario para crear un crédito
     */
    public function create()
    {
        $clientes = Cliente::all(); // Listado de clientes para seleccionar
        return view('creditos.create', compact('clientes'));
    }

    /**
     * Guarda un nuevo crédito en BD
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'monto_solicitado' => 'required|numeric|min:0',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo_meses' => 'required|integer|min:1',
            'fecha_aprobacion' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        Credito::create($request->all());

        return redirect()->route('creditos.index')
                         ->with('success', 'Crédito registrado exitosamente.');
    }

    /**
     * Muestra un crédito específico
     */
    public function show($id)
    {
        $credito = Credito::with('cliente')->findOrFail($id);
        return view('creditos.show', compact('credito'));
    }

    /**
     * Formulario para editar un crédito
     */
    public function edit($id)
    {
        $credito = Credito::findOrFail($id);
        $clientes = Cliente::all();
        return view('creditos.edit', compact('credito', 'clientes'));
    }

    /**
     * Actualiza un crédito
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'monto_solicitado' => 'required|numeric|min:0',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo_meses' => 'required|integer|min:1',
            'fecha_aprobacion' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        $credito = Credito::findOrFail($id);
        $credito->update($request->all());

        return redirect()->route('creditos.index')
                         ->with('success', 'Crédito actualizado exitosamente.');
    }

    /**
     * Elimina un crédito
     */
    public function destroy($id)
    {
        $credito = Credito::findOrFail($id);
        $credito->delete();

        return redirect()->route('creditos.index')
                         ->with('success', 'Crédito eliminado correctamente.');
    }
}
