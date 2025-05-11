<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class VehiculoController extends Controller
{
    public function index()
    {
        // Opción para asegurar que solo acceden usuarios con rol 'vehiculo'
        if (Auth::user()->tipo !== 'vehiculo') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return view('vehiculo.index');
    }
}
