<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoReservaAdminController extends Controller
{
    public function index()
    {
        $tipos = DB::table('transfer_tipo_reserva')
            ->orderByDesc('id_tipo_reserva')
            ->get();

        return view('admin.tiporeserva.index', compact('tipos'));
    }

    public function create()
    {
        return view('admin.tiporeserva.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        DB::table('transfer_tipo_reserva')->insert([
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.tiporeserva.index')->with('success', 'Tipo de reserva creado.');
    }

    public function edit($id)
    {
        $tipo = DB::table('transfer_tipo_reserva')->where('id_tipo_reserva', $id)->first();

        if (!$tipo) {
            abort(404, 'Tipo de reserva no encontrado');
        }

        return view('admin.tiporeserva.edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        DB::table('transfer_tipo_reserva')->where('id_tipo_reserva', $id)->update([
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.tiporeserva.index')->with('success', 'Tipo de reserva actualizado.');
    }

    public function destroy($id)
    {
        DB::table('transfer_tipo_reserva')->where('id_tipo_reserva', $id)->delete();

        return redirect()->route('admin.tiporeserva.index')->with('success', 'Tipo de reserva eliminado.');
    }
}
