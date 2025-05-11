<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PerfilAdminController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        if (!$usuario || $usuario->tipo !== 'admin') {
            abort(403, 'Acceso denegado.');
        }

        return view('admin.perfil.index', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        if (!$usuario || $usuario->tipo !== 'admin') {
            abort(403, 'Acceso denegado.');
        }

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $updateData = [
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $usuario->id)->update($updateData);

        // Opcional: actualizar los datos de la sesión con nuevos datos
        $usuario->email = $request->email;
        if (isset($updateData['password'])) {
            $usuario->password = $updateData['password'];
        }

        session()->flash('success', 'Perfil actualizado correctamente.');
        return redirect()->route('perfiladmin.index');
    }
}
