<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        // Puedes pasar el rol para condicionar módulos si quieres
        return view('dashboard', [
            'usuario' => $usuario,
            'rol' => $usuario->rol
        ]);
    }
}
