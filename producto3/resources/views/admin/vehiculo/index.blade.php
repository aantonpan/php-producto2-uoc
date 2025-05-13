@extends('admin.layout')

<!-- resources/views/admin/vehiculo/index.blade.php -->
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
            <i class="bi bi-truck"></i> Vehículos
        </h2>
        <a href="{{ route('vehiculoadmin.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-circle"></i> Nuevo vehículo
        </a>
    </div>

    @if (session('success_vehiculo'))
        <div class="alert alert-success">
            {{ session('success_vehiculo') }}
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Email Conductor</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehiculos as $v)
                    <tr>
                        <td>{{ $v->id_vehiculo }}</td>
                        <td>{{ $v->descripcion }}</td>
                        <td>{{ $v->email_conductor }}</td>
                        <td class="text-end">
                            <a href="{{ route('vehiculoadmin.edit', $v->id_vehiculo) }}" class="btn btn-sm btn-warning rounded-pill me-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('vehiculoadmin.destroy', $v->id_vehiculo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill"
                                        onclick="return confirm('¿Eliminar este vehículo?')">
                                    <i class="bi bi-trash"></i> Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay vehículos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
