<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioAdminController extends Controller
{
    public function index()
    {
        $usuarios = DB::table('usuarios as u')
            ->leftJoin('transfer_viajeros as v', 'u.id', '=', 'v.id_usuario')
            ->select('u.*', 'v.nombre as nombre_actualizado', 'v.apellido1', 'v.apellido2')
            ->orderByDesc('u.creado_en')
            ->get();

        return view('admin.usuario.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:usuarios,email',
            'tipo' => 'required|string',
            'password' => 'nullable|min:6',
        ]);

        $id = DB::table('usuarios')->insertGetId([
            'username' => $request->username,
            'email' => $request->email,
            'tipo' => $request->tipo,
            'password' => $request->filled('password') ? Hash::make($request->password) : null,
            'creado_en' => now()
        ]);

        return redirect()->route('admin.usuario.index')->with('success', 'Usuario creado.');
    }

    public function edit($id)
    {
        $usuario = DB::table('usuarios')->where('id', $id)->first();
        if (!$usuario) abort(404, 'Usuario no encontrado');

        $viajero = null;
        if ($usuario->tipo === 'particular') {
            $viajero = DB::table('transfer_viajeros')->where('id_usuario', $id)->first();
        }

        return view('admin.usuario.edit', compact('usuario', 'viajero'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'tipo' => 'required|string',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'tipo' => $request->tipo,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('usuarios')->where('id', $id)->update($data);

        if ($request->tipo === 'particular') {
            $viajero = DB::table('transfer_viajeros')->where('id_usuario', $id)->first();
            $imagenPerfil = null;

            if ($request->hasFile('imagen_perfil')) {
                $imagenPerfil = $request->file('imagen_perfil')->store('uploads', 'public');
            }

            $viajeroData = [
                'nombre' => $request->nombre,
                'apellido1' => $request->apellido1,
                'apellido2' => $request->apellido2,
                'direccion' => $request->direccion,
                'codigoPostal' => $request->codigoPostal,
                'ciudad' => $request->ciudad,
                'pais' => $request->pais,
                'email' => $request->email,
            ];

            if ($imagenPerfil) {
                $viajeroData['imagen_perfil'] = $imagenPerfil;
            }

            if ($viajero) {
                DB::table('transfer_viajeros')->where('id_usuario', $id)->update($viajeroData);
            } else {
                $viajeroData['id_usuario'] = $id;
                DB::table('transfer_viajeros')->insert($viajeroData);
            }
        }

        return redirect()->route('admin.usuario.index')->with('success', 'Usuario actualizado.');
    }

    public function destroy($id)
    {
        DB::table('usuarios')->where('id', $id)->delete();
        return redirect()->route('admin.usuario.index')->with('success', 'Usuario eliminado.');
    }
}
