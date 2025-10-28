<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // ✅ Agrega esta línea
use Barryvdh\DomPDF\Facade\Pdf; // Importar Dompdf
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Constructor con middleware para permisos
    public function __construct()
    {
       
    }

    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Formulario para crear cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar cliente nuevo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'identificacion' => 'required|unique:clientes',
            'telefono' => 'required',
            'email' => 'required|email|unique:clientes',
            'direccion' => 'required',
            'ocupacion' => 'nullable|string|max:255',
            'ingreso_mensual' => 'nullable|numeric',
            'estado' => 'required|in:activo,inactivo'
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente creado correctamente.');
    }

    // Ver detalles de un cliente
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    // Formulario para editar cliente
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar cliente
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'identificacion' => 'required|unique:clientes,identificacion,' . $cliente->id,
            'telefono' => 'required',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'direccion' => 'required',
            'ocupacion' => 'nullable|string|max:255',
            'ingreso_mensual' => 'nullable|numeric',
            'estado' => 'required|in:activo,inactivo'
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar cliente
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente eliminado correctamente.');
    }

    public function exportPdf()
    {

      $clientes = Cliente::all(); // Obtener todos los clientes
      $pdf = Pdf::loadView('clientes.pdf', compact('clientes')); // Vista PDF
      return $pdf->download('clientes.pdf'); // Descargar PDF
    
    }
}



