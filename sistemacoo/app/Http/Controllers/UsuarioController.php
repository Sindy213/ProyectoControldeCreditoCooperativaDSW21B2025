<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    /**
     * Mostrar lista de usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar formulario para crear usuario.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Guardar usuario nuevo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'usuario' => 'required|string|max:50|unique:usuarios,usuario',
            'password' => 'required|string|min:6', // opcional: añadir confirmed si usas password_confirmation
            'rol' => 'required|string|max:50',
            'estado' => 'required|boolean',
            'ultimo_acceso' => 'nullable|date',
        ]);

        $usuario = Usuario::create([
            'nombre_completo' => $request->nombre_completo,
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'estado' => (bool) $request->estado,
            'ultimo_acceso' => $request->ultimo_acceso ? Carbon::parse($request->ultimo_acceso) : null,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Mostrar detalles de un usuario.
     */
    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualizar usuario.
     */
    public function update(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'usuario' => 'required|string|max:50|unique:usuarios,usuario,' . $usuario->id,
            'password' => 'nullable|string|min:6', // si viene vacío no se cambia
            'rol' => 'required|string|max:50',
            'estado' => 'required|boolean',
            'ultimo_acceso' => 'nullable|date',
        ]);

        $usuario->nombre_completo = $request->nombre_completo;
        $usuario->usuario = $request->usuario;
        $usuario->rol = $request->rol;
        $usuario->estado = (bool) $request->estado;
        $usuario->ultimo_acceso = $request->ultimo_acceso ? Carbon::parse($request->ultimo_acceso) : $usuario->ultimo_acceso;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}
