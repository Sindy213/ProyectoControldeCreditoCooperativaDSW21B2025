<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Pago;
use App\Models\Solicitud;
use App\Models\Cita;
use App\Models\Tipocredito;

class PdfController extends Controller
{
    public function clientes(){ 
        $data = Cliente::all();
        $pdf = Pdf::loadView('pdf.clientes', compact('data'));
        return $pdf->download('clientes.pdf');
    }

    public function creditos(){ 
        $data = Credito::with('cliente','tipo')->get();
        $pdf = Pdf::loadView('pdf.creditos', compact('data'));
        return $pdf->download('creditos.pdf');
    }

    public function pagos(){ 
        $data = Pago::with('credito','user')->get();
        $pdf = Pdf::loadView('pdf.pagos', compact('data'));
        return $pdf->download('pagos.pdf');
    }

    public function solicitudes(){ 
        $data = Solicitud::with('cliente','tipo','revisor')->get();
        $pdf = Pdf::loadView('pdf.solicitudes', compact('data'));
        return $pdf->download('solicitudes.pdf');
    }

    public function citas(){ 
        $data = Cita::with('cliente','user')->get();
        $pdf = Pdf::loadView('pdf.citas', compact('data'));
        return $pdf->download('citas.pdf');
    }

    public function tipos_creditos(){ 
        $data = Tipocredito::all();
        $pdf = Pdf::loadView('pdf.tiposcreditos', compact('data'));
        return $pdf->download('tiposcreditos.pdf');
    }
}
