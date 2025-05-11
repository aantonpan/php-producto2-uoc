<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VehiculoAdminController extends Controller
{
    public function index()
    {
        $vehiculos = DB::table('transfer_vehiculo')
            ->orderByDesc('id_vehiculo')
            ->get();

        return view('admin.vehiculo.index', compact('vehiculos'));
    }

    public function create()
    {
        return view('admin.vehiculo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'email_conductor' => 'required|email|unique:transfer_vehiculo,email_conductor',
            'password' => 'required|string|min:6',
        ]);

        DB::table('transfer_vehiculo')->insert([
            'descripcion' => $request->descripcion,
            'email_conductor' => $request->email_conductor,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.vehiculo.index')->with('success', 'Vehículo creado correctamente.');
    }

    public function edit($id)
    {
        $vehiculo = DB::table('transfer_vehiculo')->where('id_vehiculo', $id)->first();
        if (!$vehiculo) {
            return redirect()->route('admin.vehiculo.index')->with('error', 'Vehículo no encontrado.');
        }

        return view('admin.vehiculo.edit', compact('vehiculo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'email_conductor' => 'required|email|unique:transfer_vehiculo,email_conductor,' . $id . ',id_vehiculo',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'descripcion' => $request->descripcion,
            'email_conductor' => $request->email_conductor,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('transfer_vehiculo')->where('id_vehiculo', $id)->update($data);

        return redirect()->route('admin.vehiculo.index')->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy($id)
    {
        DB::table('transfer_vehiculo')->where('id_vehiculo', $id)->delete();
        return redirect()->route('admin.vehiculo.index')->with('success', 'Vehículo eliminado.');
    }
}
