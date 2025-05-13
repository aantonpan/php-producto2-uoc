@extends('admin.layout')

<!-- resources/views/admin/tiporeserva/create.blade.php -->
<div class="container py-4">
    <h2 class="mb-4 text-dark"><i class="bi bi-plus-circle"></i> Nuevo Tipo de Reserva</h2>

    <form method="POST" action="{{ route('tiporeservaadmin.store') }}">
        @csrf
        <div class="card p-4 shadow-sm border-0">
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">Guardar</button>
                <a href="{{ route('tiporeservaadmin.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
