<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;

Route::get('/informe/reservas', [ReservaController::class, 'listaReservas']);