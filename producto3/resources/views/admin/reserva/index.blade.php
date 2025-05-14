@extends('admin.layout')

<!-- resources/views/admin/reserva/index.blade.php -->
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
            <i class="bi bi-journal-check"></i> Reservas
        </h2>
        <a href="{{ route('reservaadmin.create') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-circle"></i> Nueva reserva
        </a>
    </div>

    @if ($reservas->isEmpty())
        <div class="alert alert-info shadow-sm">No hay reservas registradas.</div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th>Localizador</th>
                        <th>Hotel</th>
                        <th>Cliente</th>
                        <th>Destino</th>
                        <th>Vehículo</th>
                        <th>Tipo</th>
                        <th>Entrada</th>
                        <th>Vuelo Entrada</th>
                        <th>Salida</th>
                        <th>Viajeros</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $r)
                        <tr>
                            <td>{{ $r->localizador }}</td>
                            <td>{{ $r->nombre_hotel ?? '-' }}</td>
                            <td>{{ $r->nombre_usuario }} {{ $r->apellido_usuario }}</td>
                            <td>{{ $r->nombre_destino }}</td>
                            <td>{{ $r->nombre_vehiculo }}</td>
                            <td>{{ $r->tipo_reserva }}</td>
                            <td>
                                {{ $r->fecha_entrada }} {{ $r->hora_entrada }}
                            </td>
                            <td>
                                {{ $r->numero_vuelo_entrada }} / {{ $r->origen_vuelo_entrada }}
                            </td>
                            <td>
                                {{ $r->hora_vuelo_salida }} / {{ $r->fecha_vuelo_salida }}
                            </td>
                            <td>{{ $r->num_viajeros }}</td>
                            <td class="text-end" style="width: 180px;">
                                <a href="{{ route('reservaadmin.edit', $r->id_reserva) }}"
                                   class="btn btn-sm btn-warning rounded-pill me-2">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('reservaadmin.destroy', $r->id_reserva) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill"
                                            onclick="return confirm('¿Eliminar esta reserva?')">
                                        <i class="bi bi-trash"></i> Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
