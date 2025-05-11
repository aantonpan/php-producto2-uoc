<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZonaAdminController extends Controller
{
    public function index()
    {
        $zonas = DB::table('transfer_zona')
            ->orderByDesc('id_zona')
            ->get();

        return view('admin.zona.index', compact('zonas'));
    }

    public function create()
    {
        return view('admin.zona.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        DB::table('transfer_zona')->insert([
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.zona.index')->with('success', 'Zona creada correctamente.');
    }

    public function edit($id)
    {
        $zona = DB::table('transfer_zona')->where('id_zona', $id)->first();

        if (!$zona) {
            abort(404, 'Zona no encontrada');
        }

        return view('admin.zona.edit', compact('zona'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        DB::table('transfer_zona')->where('id_zona', $id)->update([
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.zona.index')->with('success', 'Zona actualizada correctamente.');
    }

    public function destroy($id)
    {
        DB::table('transfer_zona')->where('id_zona', $id)->delete();

        return redirect()->route('admin.zona.index')->with('success', 'Zona eliminada.');
    }
}
