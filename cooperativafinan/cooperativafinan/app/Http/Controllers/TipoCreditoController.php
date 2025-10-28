<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TipoCredito;
use Illuminate\Http\Request;

class TipoCreditoController extends Controller
{
    // Middleware de permisos
    public function __construct()
    {
        $this->middleware('permission:creditos.view', ['only' => ['index','show']]);
        $this->middleware('permission:creditos.create', ['only' => ['create','store']]);
        $this->middleware('permission:creditos.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:creditos.close', ['only' => ['destroy']]);
    }

    // Mostrar todos los tipos de crédito
    public function index()
    {
        $tipos = TipoCredito::all();
        return view('tiposcreditos.index', compact('tipos'));
    }

    // Formulario para crear tipo de crédito
    public function create()
    {
        return view('tiposcreditos.create');
    }

    // Guardar nuevo tipo de crédito
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:tipos_creditos,codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tasa_anual' => 'required|numeric|min:0',
            'plazo_min_meses' => 'required|integer|min:1',
            'plazo_max_meses' => 'required|integer|gte:plazo_min_meses',
            'monto_min' => 'required|numeric|min:1',
            'monto_max' => 'required|numeric|gte:monto_min',
            'condiciones_json' => 'nullable|json'
        ]);

        TipoCredito::create($request->all());

        return redirect()->route('tiposcreditos.index')->with('success','Tipo de crédito creado correctamente.');
    }

    // Ver detalle de tipo de crédito
    public function show(TipoCredito $tipoCredito)
    {
        return view('tiposcreditos.show', compact('tipoCredito'));
    }

    // Formulario para editar tipo de crédito
    public function edit(TipoCredito $tipoCredito)
    {
        return view('tiposcreditos.edit', compact('tipoCredito'));
    }

    // Actualizar tipo de crédito
    public function update(Request $request, TipoCredito $tipoCredito)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:tipos_creditos,codigo,' . $tipoCredito->id,
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tasa_anual' => 'required|numeric|min:0',
            'plazo_min_meses' => 'required|integer|min:1',
            'plazo_max_meses' => 'required|integer|gte:plazo_min_meses',
            'monto_min' => 'required|numeric|min:1',
            'monto_max' => 'required|numeric|gte:monto_min',
            'condiciones_json' => 'nullable|json'
        ]);

        $tipoCredito->update($request->all());

        return redirect()->route('tiposcreditos.index')->with('success','Tipo de crédito actualizado correctamente.');
    }

    // Eliminar tipo de crédito
    public function destroy(TipoCredito $tipoCredito)
    {
        if($tipoCredito->creditos()->count() > 0 || $tipoCredito->solicitudes()->count() > 0){
            return redirect()->route('tiposcreditos.index')->with('error','No se puede eliminar: existen créditos o solicitudes asociados.');
        }

        $tipoCredito->delete();

        return redirect()->route('tiposcreditos.index')->with('success','Tipo de crédito eliminado correctamente.');
    }

    public function exportPdf()
    {
       $tipos = TipoCredito::all();
       $pdf = Pdf::loadView('tiposcreditos.pdf', compact('tipos'));
       return $pdf->download('tiposcreditos.pdf');
    }
}
