<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaAdminController extends Controller
{
    public function index()
    {
        $reservas = DB::table('transfer_reservas as r')
            ->leftJoin('usuarios as u', 'r.id_cliente', '=', 'u.id')
            ->leftJoin('transfer_viajeros as vj', 'u.id', '=', 'vj.id_usuario')
            ->leftJoin('transfer_hotel as h', 'r.id_hotel', '=', 'h.id_hotel')
            ->leftJoin('transfer_zona as z', 'r.id_destino', '=', 'z.id_zona')
            ->leftJoin('transfer_vehiculo as v', 'r.id_vehiculo', '=', 'v.id_vehiculo')
            ->leftJoin('transfer_tipo_reserva as p', 'r.id_tipo_reserva', '=', 'p.id_tipo_reserva')
            ->select(
                'r.*',
                DB::raw('COALESCE(vj.nombre, u.username) as nombre_usuario'),
                DB::raw('COALESCE(vj.apellido1, "") as apellido_usuario'),
                'u.email',
                'h.nombre as nombre_hotel',
                'z.descripcion as nombre_destino',
                'v.descripcion as nombre_vehiculo',
                'p.descripcion as tipo_reserva'
            )
            ->orderByDesc('r.fecha_entrada')
            ->get();

        return view('admin.reserva.index', compact('reservas'));
    }

    public function create()
    {
        $usuarios = DB::table('usuarios as u')
            ->leftJoin('transfer_viajeros as vj', 'u.id', '=', 'vj.id_usuario')
            ->select('u.id', 'u.email', DB::raw('COALESCE(vj.nombre, u.username) as nombre'), 'vj.apellido1')
            ->orderBy('nombre')->get();

        $hoteles = DB::table('transfer_hotel')->orderBy('nombre')->get();
        $destinos = DB::table('transfer_zona')->orderBy('descripcion')->get();
        $vehiculos = DB::table('transfer_vehiculo')->orderBy('descripcion')->get();
        $tipos = DB::table('transfer_tipo_reserva')->orderBy('descripcion')->get();

        return view('admin.reserva.create', compact('usuarios', 'hoteles', 'destinos', 'vehiculos', 'tipos'));
    }

    public function store(Request $request)
    {
        $localizador = strtoupper(uniqid('LOC'));
        $fecha_reserva = now();

        DB::table('transfer_reservas')->insert([
            'localizador' => $localizador,
            'id_hotel' => $request->id_hotel,
            'id_tipo_reserva' => $request->id_tipo_reserva,
            'id_cliente' => $request->id_cliente,
            'fecha_reserva' => $fecha_reserva,
            'id_destino' => $request->id_destino,
            'fecha_entrada' => $request->fecha_entrada,
            'hora_entrada' => $request->hora_entrada,
            'numero_vuelo_entrada' => $request->numero_vuelo_entrada,
            'origen_vuelo_entrada' => $request->origen_vuelo_entrada,
            'hora_vuelo_salida' => $request->hora_vuelo_salida,
            'fecha_vuelo_salida' => $request->fecha_vuelo_salida,
            'num_viajeros' => $request->num_viajeros,
            'id_vehiculo' => $request->id_vehiculo,
        ]);

        $this->notificarCambioReserva($request->id_cliente, "Un administrador ha creado una nueva reserva para ti con localizador $localizador.");

        return redirect()->route('admin.reserva.index')->with('success', 'Reserva creada correctamente.');
    }

    public function edit($id)
    {
        $reserva = DB::table('transfer_reservas')->where('id_reserva', $id)->first();
        if (!$reserva) abort(404, 'Reserva no encontrada');

        $usuarios = DB::table('usuarios as u')
            ->leftJoin('transfer_viajeros as vj', 'u.id', '=', 'vj.id_usuario')
            ->select('u.id', 'u.email', DB::raw('COALESCE(vj.nombre, u.username) as nombre'), 'vj.apellido1')
            ->orderBy('nombre')->get();

        $hoteles = DB::table('transfer_hotel')->orderBy('nombre')->get();
        $destinos = DB::table('transfer_zona')->orderBy('descripcion')->get();
        $vehiculos = DB::table('transfer_vehiculo')->orderBy('descripcion')->get();
        $tipos = DB::table('transfer_tipo_reserva')->orderBy('descripcion')->get();

        return view('admin.reserva.edit', compact('reserva', 'usuarios', 'hoteles', 'destinos', 'vehiculos', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $reserva = DB::table('transfer_reservas')->where('id_reserva', $id)->first();
        if (!$reserva) abort(404, 'Reserva no encontrada');

        DB::table('transfer_reservas')->where('id_reserva', $id)->update([
            'id_hotel' => $request->id_hotel,
            'id_tipo_reserva' => $request->id_tipo_reserva,
            'id_cliente' => $request->id_cliente,
            'fecha_modificacion' => now(),
            'id_destino' => $request->id_destino,
            'fecha_entrada' => $request->fecha_entrada,
            'hora_entrada' => $request->hora_entrada,
            'numero_vuelo_entrada' => $request->numero_vuelo_entrada,
            'origen_vuelo_entrada' => $request->origen_vuelo_entrada,
            'hora_vuelo_salida' => $request->hora_vuelo_salida,
            'fecha_vuelo_salida' => $request->fecha_vuelo_salida,
            'num_viajeros' => $request->num_viajeros,
            'id_vehiculo' => $request->id_vehiculo,
        ]);

        $this->notificarCambioReserva($request->id_cliente, "Un administrador ha modificado tu reserva con localizador {$reserva->localizador}.");

        return redirect()->route('admin.reserva.index')->with('success', 'Reserva actualizada correctamente.');
    }

    public function destroy($id)
    {
        $reserva = DB::table('transfer_reservas')->where('id_reserva', $id)->first();
        if ($reserva) {
            $this->notificarCambioReserva($reserva->id_cliente, "Un administrador ha eliminado tu reserva con localizador {$reserva->localizador}.");
        }

        DB::table('transfer_reservas')->where('id_reserva', $id)->delete();
        return redirect()->route('admin.reserva.index')->with('success', 'Reserva eliminada.');
    }

    private function notificarCambioReserva($usuario_id, $mensaje)
{
    DB::table('transfer_notificaciones')->insert([
        'id_usuario' => $usuario_id,
        'mensaje' => $mensaje,
        'created_at' => now(),
        'updated_at' => now()
    ]);
}

}
