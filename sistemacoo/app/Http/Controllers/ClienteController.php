<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'dui' => 'required|string|max:20|unique:clientes',
            'direccion' => 'nullable|string|max:200',
            'telefono' => 'nullable|string|max:20',
            'correo_electronico' => 'required|email|unique:clientes',
            'genero' => 'required|in:Masculino,Femenino,LGBT',
            'estado_civil' => 'required|in:Soltera,Casada',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'dui' => 'required|string|max:20|unique:clientes,dui,' . $cliente->id,
            'direccion' => 'nullable|string|max:200',
            'telefono' => 'nullable|string|max:20',
            'correo_electronico' => 'required|email|unique:clientes,correo_electronico,' . $cliente->id,
            'genero' => 'required|in:Masculino,Femenino,LGBT',
            'estado_civil' => 'required|in:Soltera,Casada',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
