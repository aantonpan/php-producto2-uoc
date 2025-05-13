@extends('admin.layout')

<!-- resources/views/admin/vehiculo/create.blade.php -->
<div class="container py-4">
    <h2 class="mb-4 d-flex align-items-center gap-2 text-dark">
        <i class="bi bi-truck"></i> Crear Vehículo
    </h2>

    <form method="POST" action="{{ route('vehiculoadmin.store') }}">
        @csrf
        <div class="card p-4 shadow-sm border-0">
            @php
                $vehiculo = $vehiculo ?? null;
            @endphp

            @include('admin.vehiculo._form_fields')

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-check-circle"></i> Guardar
                </button>
                <a href="{{ route('vehiculoadmin.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>
