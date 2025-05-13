@extends('admin.layout')

<!-- resources/views/admin/precio/edit.blade.php -->
<div class="container py-4">
    <h2 class="mb-4 text-dark"><i class="bi bi-pencil-square"></i> Editar Precio</h2>

    <form method="POST" action="{{ route('precioadmin.update', $precio->id_precios) }}">
        @csrf
        @method('PUT')
        <div class="card p-4 shadow-sm border-0">
            @include('admin.precio._form_fields')

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">Guardar cambios</button>
                <a href="{{ route('precioadmin.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
