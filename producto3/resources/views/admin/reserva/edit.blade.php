@extends('admin.layout')

<!-- resources/views/admin/reserva/edit.blade.php -->
<div class="container py-4">
    <h2 class="mb-4 text-dark">
        <i class="bi bi-pencil-square"></i> Editar Reserva
        @if (isset($reserva->localizador))
            - {{ $reserva->localizador }}
        @endif
    </h2>

    <form method="POST" action="{{ route('reservaadmin.update', $reserva->id_reserva) }}">
        @csrf
        @method('PUT')
        <div class="card p-4 shadow-sm border-0">
            @include('admin.reserva._form_fields')

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-check-circle"></i> Guardar cambios
                </button>
                <a href="{{ route('reservaadmin.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>
