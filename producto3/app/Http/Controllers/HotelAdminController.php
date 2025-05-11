<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelAdminController extends Controller
{
    public function index()
    {
        $hoteles = DB::table('transfer_hotel as h')
            ->leftJoin('transfer_zona as z', 'h.id_zona', '=', 'z.id_zona')
            ->select('h.*', 'z.descripcion as nombre_zona')
            ->orderByDesc('h.id_hotel')
            ->get();

        return view('admin.hotel.index', compact('hoteles'));
    }

    public function create()
    {
        $zonas = DB::table('transfer_zona')
            ->orderBy('descripcion')
            ->get();

        return view('admin.hotel.create', [
            'zonas' => $zonas,
            'hotel' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_zona' => 'required|integer',
            'Comision' => 'required|numeric',
            'nombre' => 'required|string',
            'direccion' => 'required|string',
        ]);

        DB::table('transfer_hotel')->insert([
            'id_zona' => $request->id_zona,
            'Comision' => $request->Comision,
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('admin.hotel.index')->with('success', 'Hotel creado correctamente');
    }

    public function edit($id)
    {
        $hotel = DB::table('transfer_hotel')->where('id_hotel', $id)->first();
        if (!$hotel) {
            abort(404, 'Hotel no encontrado');
        }

        $zonas = DB::table('transfer_zona')->orderBy('descripcion')->get();

        return view('admin.hotel.edit', compact('hotel', 'zonas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_zona' => 'required|integer',
            'Comision' => 'required|numeric',
            'nombre' => 'required|string',
            'direccion' => 'required|string',
        ]);

        DB::table('transfer_hotel')->where('id_hotel', $id)->update([
            'id_zona' => $request->id_zona,
            'Comision' => $request->Comision,
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('admin.hotel.index')->with('success', 'Hotel actualizado correctamente');
    }

    public function destroy($id)
    {
        DB::table('transfer_hotel')->where('id_hotel', $id)->delete();

        return redirect()->route('admin.hotel.index')->with('success', 'Hotel eliminado correctamente');
    }
}
