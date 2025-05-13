@extends('layout')

<div class="container py-4">
    <h2 class="mb-4">Bienvenido, {{ session('usuario.username') }}</h2>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Calendario de reservas
        </div>
        <div class="card-body">
            <div id="calendar">[Aquí se cargará el calendario]</div>
        </div>
    </div>

    <div class="mt-3 text-end">
        <a href="{{ route('reserva.index') }}" class="btn btn-outline-primary">Ver todas mis reservas</a>
    </div>
</div>
