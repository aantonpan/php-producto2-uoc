@extends('admin.layout')

<!-- resources/views/admin/zona/create.blade.php -->
<div class="container py-4">
    <h2 class="mb-4 d-flex align-items-center gap-2 text-dark">
        <i class="bi bi-geo-alt"></i> Crear Zona
    </h2>

    <form method="POST" action="{{ route('zonaadmin.store') }}">
        @csrf
        <div class="card p-4 shadow-sm border-0">
            @php
                $zona = $zona ?? null;
            @endphp

            @include('admin.zona._form_fields')

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-check-circle"></i> Guardar
                </button>
                <a href="{{ route('zonaadmin.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
