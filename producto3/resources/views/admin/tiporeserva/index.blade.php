@extends('admin.layout')

<!-- resources/views/admin/tiporeserva/index.blade.php -->
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
            <i class="bi bi-tags"></i> Tipos de Reserva
        </h2>
        <a href="{{ route('tiporeservaadmin.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-circle"></i> Nuevo tipo
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tipos as $t)
                    <tr>
                        <td>{{ $t->id_tipo_reserva }}</td>
                        <td>{{ $t->descripcion }}</td>
                        <td class="text-end">
                            <a href="{{ route('tiporeservaadmin.edit', $t->id_tipo_reserva) }}" class="btn btn-sm btn-warning rounded-pill me-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('tiporeservaadmin.destroy', $t->id_tipo_reserva) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill"
                                        onclick="return confirm('¿Eliminar este tipo de reserva?')">
                                    <i class="bi bi-trash"></i> Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">No hay tipos de reserva registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
