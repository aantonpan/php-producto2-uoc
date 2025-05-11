<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReservaController extends Controller
{
    public function index()
    {
        $usuario_id = Auth::id();

        $reservas = DB::table('transfer_reservas as r')
            ->leftJoin('transfer_precios as p', function ($join) {
                $join->on('r.id_vehiculo', '=', 'p.id_vehiculo')
                     ->on('r.id_destino', '=', 'p.id_hotel');
            })
            ->leftJoin('transfer_zona as z', 'r.id_destino', '=', 'z.id_zona')
            ->select('r.*', 'p.Precio', 'z.descripcion as nombre_destino')
            ->where('r.id_cliente', $usuario_id)
            ->orderByDesc('r.fecha_entrada')
            ->get();

        return view('reserva.index', compact('reservas'));
    }

    public function create()
    {
        $destinos = DB::table('transfer_zona')->get();
        $vehiculos = DB::table('transfer_vehiculo')->get();
        $tipos = DB::table('transfer_tipo_reserva')->get();

        return view('reserva.create', compact('destinos', 'vehiculos', 'tipos'));
    }

    public function store(Request $request)
    {
        $usuario_id = Auth::id();

        $request->validate([
            'fecha_entrada' => 'required|date',
            'hora_entrada' => 'required',
            'numero_vuelo_entrada' => 'required|string',
            'origen_vuelo_entrada' => 'required|string',
            'id_tipo_reserva' => 'required|integer',
            'id_destino' => 'required|integer',
            'num_viajeros' => 'required|integer',
            'id_vehiculo' => 'required|integer',
        ]);

        $localizador = strtoupper(uniqid('LOC'));
        $fecha_reserva = now();

        DB::table('transfer_reservas')->insert([
            'localizador' => $localizador,
            'id_tipo_reserva' => $request->id_tipo_reserva,
            'id_cliente' => $usuario_id,
            'fecha_reserva' => $fecha_reserva,
            'id_destino' => $request->id_destino,
            'fecha_entrada' => $request->fecha_entrada,
            'hora_entrada' => $request->hora_entrada,
            'numero_vuelo_entrada' => $request->numero_vuelo_entrada,
            'origen_vuelo_entrada' => $request->origen_vuelo_entrada,
            'fecha_vuelo_salida' => $request->fecha_vuelo_salida,
            'hora_vuelo_salida' => $request->hora_vuelo_salida,
            'num_viajeros' => $request->num_viajeros,
            'id_vehiculo' => $request->id_vehiculo,
        ]);

        return redirect()->route('reserva.index')->with('success', 'Reserva creada correctamente.');
    }

    public function edit($id)
    {
        $usuario_id = Auth::id();

        $reserva = DB::table('transfer_reservas')
            ->where('id_reserva', $id)
            ->where('id_cliente', $usuario_id)
            ->first();

        if (!$reserva) {
            return redirect()->route('reserva.index')->with('error', 'Reserva no encontrada o no te pertenece.');
        }

        // Validación de 48h
        $fechaHora = Carbon::parse("{$reserva->fecha_entrada} {$reserva->hora_entrada}");
        if ($fechaHora->isPast() || now()->diffInHours($fechaHora) < 48) {
            return redirect()->route('reserva.index')->with('error', 'No puedes modificar reservas con menos de 48h de antelación.');
        }

        $destinos = DB::table('transfer_zona')->get();
        $vehiculos = DB::table('transfer_vehiculo')->get();
        $tipos = DB::table('transfer_tipo_reserva')->get();

        return view('reserva.edit', compact('reserva', 'destinos', 'vehiculos', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $usuario_id = Auth::id();

        $reserva = DB::table('transfer_reservas')
            ->where('id_reserva', $id)
            ->where('id_cliente', $usuario_id)
            ->first();

        if (!$reserva) {
            return redirect()->route('reserva.index')->with('error', 'Reserva no encontrada o no te pertenece.');
        }

        $fechaHora = Carbon::parse("{$reserva->fecha_entrada} {$reserva->hora_entrada}");
        if ($fechaHora->isPast() || now()->diffInHours($fechaHora) < 48) {
            return redirect()->route('reserva.index')->with('error', 'No puedes modificar reservas con menos de 48h de antelación.');
        }

        DB::table('transfer_reservas')->where('id_reserva', $id)->update([
            'fecha_entrada' => $request->fecha_entrada,
            'hora_entrada' => $request->hora_entrada,
            'numero_vuelo_entrada' => $request->numero_vuelo_entrada,
            'origen_vuelo_entrada' => $request->origen_vuelo_entrada,
            'fecha_vuelo_salida' => $request->fecha_vuelo_salida,
            'hora_vuelo_salida' => $request->hora_vuelo_salida,
            'id_destino' => $request->id_destino,
            'id_vehiculo' => $request->id_vehiculo,
            'num_viajeros' => $request->num_viajeros,
        ]);

        return redirect()->route('reserva.index')->with('success', 'Reserva modificada correctamente.');
    }

    public function destroy($id)
    {
        $usuario_id = Auth::id();

        $reserva = DB::table('transfer_reservas')
            ->where('id_reserva', $id)
            ->where('id_cliente', $usuario_id)
            ->first();

        if (!$reserva) {
            return redirect()->route('reserva.index')->with('error', 'Reserva no encontrada o no te pertenece.');
        }

        $fechaHora = Carbon::parse("{$reserva->fecha_entrada} {$reserva->hora_entrada}");
        if ($fechaHora->isPast() || now()->diffInHours($fechaHora) < 48) {
            return redirect()->route('reserva.index')->with('error', 'No puedes eliminar reservas con menos de 48h de antelación.');
        }

        DB::table('transfer_reservas')->where('id_reserva', $id)->delete();

        return redirect()->route('reserva.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
