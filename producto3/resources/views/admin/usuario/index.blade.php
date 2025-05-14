@extends('admin.layout')

<!-- resources/views/admin/usuario/index.blade.php -->
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
            <i class="bi bi-people"></i> Gestión de Usuarios
        </h2>
    </div>

    @if ($usuarios->isEmpty())
        <div class="alert alert-info shadow-sm">No hay usuarios registrados.</div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Fecha creación</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $u)
                        <tr>
                            <td>
                                @if ($u->tipo === 'particular' && !empty($u->nombre_actualizado))
                                    {{ $u->nombre_actualizado }} {{ $u->apellido1 }} {{ $u->apellido2 }}
                                @else
                                    {{ $u->username }}
                                @endif
                            </td>
                            <td>{{ $u->email }}</td>
                            <td>{{ ucfirst($u->tipo) }}</td>
                            <td>{{ \Carbon\Carbon::parse($u->creado_en)->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('usuarioadmin.edit', $u->id) }}" class="btn btn-sm btn-warning rounded-pill me-2">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('usuarioadmin.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill"
                                            onclick="return confirm('¿Eliminar este usuario?')">
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
