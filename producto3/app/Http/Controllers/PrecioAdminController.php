<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrecioAdminController extends Controller
{
    public function index()
    {
        $precios = DB::table('transfer_precios as p')
            ->leftJoin('transfer_vehiculo as v', 'p.id_vehiculo', '=', 'v.id_vehiculo')
            ->leftJoin('transfer_hotel as h', 'p.id_hotel', '=', 'h.id_hotel')
            ->select('p.*', 'v.descripcion as vehiculo', 'h.nombre as hotel')
            ->get();

        return view('admin.precio.index', compact('precios'));
    }

    public function create()
    {
        $vehiculos = DB::table('transfer_vehiculo')->get();
        $hoteles = DB::table('transfer_hotel')->get();
        return view('admin.precio.create', compact('vehiculos', 'hoteles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_vehiculo' => 'required|integer|exists:transfer_vehiculo,id_vehiculo',
            'id_hotel' => 'required|integer|exists:transfer_hotel,id_hotel',
            'precio' => 'required|numeric|min:0',
        ]);

        DB::table('transfer_precios')->insert([
            'id_vehiculo' => $request->id_vehiculo,
            'id_hotel' => $request->id_hotel,
            'precio' => $request->precio,
        ]);

        return redirect()->route('admin.precio.index')->with('success', 'Precio creado correctamente.');
    }

    public function edit($id)
    {
        $precio = DB::table('transfer_precios')->where('id_precios', $id)->first();
        if (!$precio) abort(404, 'Precio no encontrado.');

        $vehiculos = DB::table('transfer_vehiculo')->get();
        $hoteles = DB::table('transfer_hotel')->get();

        return view('admin.precio.edit', compact('precio', 'vehiculos', 'hoteles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_vehiculo' => 'required|integer|exists:transfer_vehiculo,id_vehiculo',
            'id_hotel' => 'required|integer|exists:transfer_hotel,id_hotel',
            'precio' => 'required|numeric|min:0',
        ]);

        DB::table('transfer_precios')->where('id_precios', $id)->update([
            'id_vehiculo' => $request->id_vehiculo,
            'id_hotel' => $request->id_hotel,
            'precio' => $request->precio,
        ]);

        return redirect()->route('admin.precio.index')->with('success', 'Precio actualizado correctamente.');
    }

    public function destroy($id)
    {
        DB::table('transfer_precios')->where('id_precios', $id)->delete();
        return redirect()->route('admin.precio.index')->with('success', 'Precio eliminado correctamente.');
    }
}
