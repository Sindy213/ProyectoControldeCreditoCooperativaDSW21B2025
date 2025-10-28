<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Middleware de permisos
    public function __construct()
    {
        $this->middleware('permission:citas.manage', ['only' => ['index','create','store','edit','update','destroy']]);
    }

    // Mostrar todas las citas
    public function index()
    {
        $citas = Cita::with('cliente','user')->orderBy('fecha_hora','desc')->get();
        return view('citas.index', compact('citas'));
    }

    // Formulario para crear cita
    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = User::all(); // puede ser asignado a un usuario del sistema
        return view('citas.create', compact('clientes','usuarios'));
    }

    // Guardar cita nueva
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'user_id' => 'required|exists:users,id',
            'fecha_hora' => 'required|date',
            'tipo' => 'required|string|max:255',
            'estado' => 'required|in:programada,realizada,cancelada',
            'notas' => 'nullable|string'
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success','Cita creada correctamente.');
    }

    // Formulario para editar cita
    public function edit(Cita $cita)
    {
        $clientes = Cliente::all();
        $usuarios = User::all();
        return view('citas.edit', compact('cita','clientes','usuarios'));
    }

    // Actualizar cita
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'user_id' => 'required|exists:users,id',
            'fecha_hora' => 'required|date',
            'tipo' => 'required|string|max:255',
            'estado' => 'required|in:programada,realizada,cancelada',
            'notas' => 'nullable|string'
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success','Cita actualizada correctamente.');
    }

    // Eliminar cita
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success','Cita eliminada correctamente.');
    }

    public function exportPdf()
   {
      $citas = Cita::with('cliente','user')->get();
      $pdf = Pdf::loadView('citas.pdf', compact('citas'));
      return $pdf->download('citas.pdf');
   }
}
