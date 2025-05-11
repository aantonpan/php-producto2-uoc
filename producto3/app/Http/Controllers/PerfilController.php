<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        // Cargar datos de perfil del viajero
        $perfil = DB::table('transfer_viajeros')
            ->where('id_usuario', $usuario->id)
            ->first();

        if (!$perfil) {
            // Crear perfil si no existe
            DB::table('transfer_viajeros')->insert([
                'id_usuario' => $usuario->id,
                'nombre' => $usuario->username
            ]);

            $perfil = DB::table('transfer_viajeros')
                ->where('id_usuario', $usuario->id)
                ->first();
        }

        return view('perfil.index', compact('usuario', 'perfil'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|confirmed|min:6',
            'nombre' => 'required|string',
            'apellido1' => 'nullable|string',
            'apellido2' => 'nullable|string',
            'direccion' => 'nullable|string',
            'codigoPostal' => 'nullable|string',
            'ciudad' => 'nullable|string',
            'pais' => 'nullable|string',
            'imagen_perfil' => 'nullable|image|max:2048'
        ]);

        DB::beginTransaction();
        try {
            // Actualizar email y/o password
            $updateUser = ['email' => $request->email];
            if ($request->filled('password')) {
                $updateUser['password'] = Hash::make($request->password);
            }
            DB::table('users')->where('id', $usuario->id)->update($updateUser);

            // Subida de imagen (si hay)
            $imagenPerfil = null;
            if ($request->hasFile('imagen_perfil')) {
                $imagenPerfil = $request->file('imagen_perfil')->store('uploads', 'public');
            }

            // Actualizar datos de perfil
            $datosPerfil = [
                'nombre' => $request->nombre,
                'apellido1' => $request->apellido1,
                'apellido2' => $request->apellido2,
                'direccion' => $request->direccion,
                'codigoPostal' => $request->codigoPostal,
                'ciudad' => $request->ciudad,
                'pais' => $request->pais
            ];

            if ($imagenPerfil) {
                $datosPerfil['imagen_perfil'] = $imagenPerfil;
            }

            DB::table('transfer_viajeros')->updateOrInsert(
                ['id_usuario' => $usuario->id],
                $datosPerfil + ['id_usuario' => $usuario->id]
            );

            DB::commit();
            return redirect()->route('perfil.index')->with('success_perfil', 'Perfil actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('perfil.index')->with('error_perfil', 'Error al actualizar: ' . $e->getMessage());
        }
    }
}
