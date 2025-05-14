@extends('admin.layout')

<!-- resources/views/admin/tiporeserva/edit.blade.php -->
<div class="container py-4">
    <h2 class="mb-4 text-dark"><i class="bi bi-pencil-square"></i> Editar Tipo de Reserva</h2>

    <form method="POST" action="{{ route('tiporeservaadmin.update', $tipo->id_tipo_reserva) }}">
        @csrf
        @method('PUT')
        <div class="card p-4 shadow-sm border-0">
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control"
                       value="{{ old('descripcion', $tipo->descripcion) }}" required>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">Guardar cambios</button>
                <a href="{{ route('tiporeservaadmin.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
