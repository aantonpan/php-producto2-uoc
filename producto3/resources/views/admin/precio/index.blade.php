@extends('admin.layout')

<!-- resources/views/admin/precio/index.blade.php -->
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
            <i class="bi bi-cash-coin"></i> Precios por hotel y vehículo
        </h2>
        <a href="{{ route('precioadmin.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-circle"></i> Nuevo precio
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Hotel</th>
                    <th>Vehículo</th>
                    <th>Precio (€)</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($precios as $p)
                    <tr>
                        <td>{{ $p->id_precios }}</td>
                        <td>{{ $p->hotel }}</td>
                        <td>{{ $p->vehiculo }}</td>
                        <td>{{ number_format($p->Precio, 2) }} €</td>
                        <td class="text-end">
                            <a href="{{ route('precioadmin.edit', $p->id_precios) }}" class="btn btn-sm btn-warning rounded-pill me-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('precioadmin.destroy', $p->id_precios) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill"
                                        onclick="return confirm('¿Eliminar este precio?')">
                                    <i class="bi bi-trash"></i> Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay precios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
