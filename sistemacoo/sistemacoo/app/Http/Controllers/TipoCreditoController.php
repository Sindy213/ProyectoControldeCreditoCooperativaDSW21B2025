<?php

namespace App\Http\Controllers;

use App\Models\TipoCredito;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TipocreditoController extends Controller
{
    public function index()
    {
        $tipos = TipoCredito::all();
        return view('tiposcreditos.index', compact('tipos'));
    }

    public function create()
    {
        $opcionesNombre = TipoCredito::opcionesNombre();
        return view('tiposcreditos.create', compact('opcionesNombre'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:tiposcreditos,codigo',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'tasa_anual' => 'required|numeric|min:0',
            'plazo_min_meses' => 'required|integer|min:1',
            'plazo_max_meses' => 'required|integer|gte:plazo_min_meses',
            'monto_min' => 'required|numeric|min:0',
            'monto_max' => 'required|numeric|gte:monto_min',
            'condiciones_json' => 'nullable|json',
        ]);

        TipoCredito::create($request->all());

        return redirect()->route('tiposcreditos.index')
                         ->with('success', 'Tipo de crédito creado correctamente.');
    }

    public function edit(TipoCredito $tipo)
    {
        $opcionesNombre = TipoCredito::opcionesNombre();
        return view('tiposcreditos.edit', compact('tipo','opcionesNombre'));
    }

    public function update(Request $request, TipoCredito $tipo)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:tiposcreditos,codigo,' . $tipo->id,
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'tasa_anual' => 'required|numeric|min:0',
            'plazo_min_meses' => 'required|integer|min:1',
            'plazo_max_meses' => 'required|integer|gte:plazo_min_meses',
            'monto_min' => 'required|numeric|min:0',
            'monto_max' => 'required|numeric|gte:monto_min',
            'condiciones_json' => 'nullable|json',
        ]);

        $tipo->update($request->all());

        return redirect()->route('tiposcreditos.index')
                         ->with('success', 'Tipo de crédito actualizado correctamente.');
    }

    public function destroy(TipoCredito $tipo)
    {
        $tipo->delete();
        return redirect()->route('tiposcreditos.index')
                         ->with('success', 'Tipo de crédito eliminado correctamente.');
    }

    public function show(TipoCredito $tipo)
    {
        return view('tiposcreditos.show', compact('tipo'));
    }

    public function exportPdf()
    {
        $tipos = TipoCredito::all();
        $pdf = Pdf::loadView('tiposcreditos.pdf', compact('tipos'));
        return $pdf->download('tiposcreditos.pdf');
    }
}
