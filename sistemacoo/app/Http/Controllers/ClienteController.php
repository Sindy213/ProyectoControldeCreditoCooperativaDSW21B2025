<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Mostrar listado de clientes.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Guardar nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'dui' => 'required|string|max:20|unique:clientes',
            'direccion' => 'nullable|string|max:200',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:clientes',
            'genero' => 'required|in:Masculino,Femenino,LGBT',
            'estado_civil' => 'required|in:Soltero,Soltera,Casado,Casada,Soltero/a,Casado/a',
            'fecha_nacimiento' => 'nullable|date',
        ], [
            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'dui.required' => 'El DUI es obligatorio.',
            'dui.unique' => 'Este DUI ya está registrado.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            'genero.required' => 'Debe seleccionar un género.',
            'estado_civil.required' => 'Debe seleccionar un estado civil.',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', '✅ Cliente creado correctamente.');
    }

    /**
     * Mostrar un cliente específico.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar cliente existente.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'dui' => 'required|string|max:20|unique:clientes,dui,' . $cliente->id,
            'direccion' => 'nullable|string|max:200',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'genero' => 'required|in:Masculino,Femenino,LGBT',
            'estado_civil' => 'required|in:Soltero,Soltera,Casado,Casada,Soltero/a,Casado/a',
            'fecha_nacimiento' => 'nullable|date',
        ], [
            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'dui.required' => 'El DUI es obligatorio.',
            'dui.unique' => 'Este DUI ya está registrado.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            'genero.required' => 'Debe seleccionar un género.',
            'estado_civil.required' => 'Debe seleccionar un estado civil.',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', '✅ Cliente actualizado correctamente.');
    }

    /**
     * Eliminar cliente.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', '🗑️ Cliente eliminado correctamente.');
    }
}
