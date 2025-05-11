<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardClienteController extends Controller
{
    public function index()
    {
        $usuario_id = Auth::id(); // Laravel ya maneja la sesión

        $reservas = DB::table('transfer_reservas as r')
            ->leftJoin('transfer_vehiculo as v', 'r.id_vehiculo', '=', 'v.id_vehiculo')
            ->leftJoin('transfer_zona as z', 'r.id_destino', '=', 'z.id_zona')
            ->leftJoin('transfer_precios as p', function ($join) {
                $join->on('p.id_vehiculo', '=', 'r.id_vehiculo')
                     ->on('p.id_hotel', '=', 'r.id_destino');
            })
            ->select(
                'r.id_reserva', 'r.localizador', 'r.fecha_entrada', 'r.hora_entrada', 'r.numero_vuelo_entrada',
                'r.origen_vuelo_entrada', 'r.fecha_vuelo_salida', 'r.hora_vuelo_salida',
                'r.num_viajeros', 'r.id_vehiculo', 'r.id_destino',
                'v.descripcion as nombre_vehiculo',
                'z.descripcion as nombre_destino',
                DB::raw("COALESCE(p.Precio, 'N/D') AS precio")
            )
            ->where('r.id_cliente', $usuario_id)
            ->get();

        // Convertir reservas a eventos para el calendario
        $eventos = $reservas->map(function ($reserva) {
            return [
                'title' => 'Reserva ' . $reserva->localizador,
                'start' => $reserva->fecha_entrada . 'T' . $reserva->hora_entrada,
                'reservaId' => $reserva->id_reserva,
                'vuelo' => $reserva->numero_vuelo_entrada,
                'origen' => $reserva->origen_vuelo_entrada,
                'fechaSalida' => $reserva->fecha_vuelo_salida,
                'horaSalida' => $reserva->hora_vuelo_salida,
                'destino' => $reserva->nombre_destino,
                'vehiculo' => $reserva->nombre_vehiculo,
                'numViajeros' => $reserva->num_viajeros,
                'precio' => $reserva->precio
            ];
        });

        return view('dashboard.cliente', [
            'eventos' => $eventos
        ]);
    }
}

