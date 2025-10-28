<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'dui' => 'required|string|unique:users',
            'nombrecompleto' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'fechanacimiento' => 'required|date',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'rol' => 'required|in:Administrador,Atencion al Cliente,Cajero',
        ]);

        $user = User::create([
            'name' => $request->nombrecompleto, // requerido por Breeze
            'dui' => $request->dui,
            'nombrecompleto' => $request->nombrecompleto,
            'direccion' => $request->direccion,
            'fechanacimiento' => $request->fechanacimiento,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect('/dashboard'); // redirige a tu dashboard existente
    }
}
