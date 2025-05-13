@extends('layouts.app')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="d-flex align-items-center gap-2 mb-0">
            <i class="bi bi-journal-check"></i> Reservas
        </h2>
        
        <button class="btn btn-primary rounded-pill px-4"
                data-bs-toggle="modal"
                data-bs-target="#formModal"
                data-url="{{ route('reserva.create', ['modal' => 1]) }}">
            <i class="bi bi-plus-lg me-1"></i> Nueva reserva
        </button>
    </div>

    @if (empty($reservas))
        <div class="alert alert-info shadow-sm border-0">No tienes reservas.</div>
    @else
        <div class="table-responsive rounded shadow-sm">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th>Localizador</th>
                        <th>Fecha Entrada</th>
                        <th>Hora Entrada</th>
                        <th>Nº Vuelo</th>
                        <th>Origen</th>
                        <th>Fecha Salida</th>
                        <th>Hora Salida</th>
                        <th>Destino</th>
                        <th>Viajeros</th>
                        <th>Precio</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $res)
                        @php
                            $fechaHora = new DateTime($res['fecha_entrada'] . ' ' . $res['hora_entrada']);
                            $ahora = new DateTime();
                            $diff = $ahora->diff($fechaHora);
                            $puedeEditar = $fechaHora > $ahora && $diff->days >= 2;
                        @endphp
                        <tr>
                            <td>{{ $res['localizador'] }}</td>
                            <td>{{ $res['fecha_entrada'] }}</td>
                            <td>{{ $res['hora_entrada'] }}</td>
                            <td>{{ $res['numero_vuelo_entrada'] }}</td>
                            <td>{{ $res['origen_vuelo_entrada'] }}</td>
                            <td>{{ $res['fecha_vuelo_salida'] ?? '-' }}</td>
                            <td>{{ $res['hora_vuelo_salida'] ?? '-' }}</td>
                            <td>{{ $res['nombre_destino'] }}</td>
                            <td>{{ $res['num_viajeros'] }}</td>
                            <td>{{ isset($res['Precio']) ? $res['Precio'] . ' €' : 'N/D' }}</td>
                            <td class="text-end" style="width: 180px;">
                                @if ($puedeEditar)
                                    <button class="btn btn-sm btn-warning rounded-pill"
                                            data-bs-toggle="modal"
                                            data-bs-target="#formModal"
                                            data-url="{{ route('reserva.edit', ['id' => $res['id_reserva'], 'modal' => 1]) }}">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill" disabled>Editar</button>
                                @endif

                                <a href="#" class="btn btn-sm btn-danger rounded-pill"
                                   data-id="{{ $res['id_reserva'] }}"
                                   data-eliminar>
                                    <i class="bi bi-trash"></i> Borrar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Modal de creación/edición con iframe -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-sm">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title d-flex align-items-center gap-2" id="formModalLabel">
                    <i class="bi bi-journal-check"></i> Formulario de Reserva
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="formFrame" class="form-iframe w-100" style="height: 80vh; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    const formModal = document.getElementById('formModal');
    const formFrame = document.getElementById('formFrame');
    const modalTitle = document.getElementById('formModalLabel');

    formModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        formFrame.src = url;

        if (url.includes('create')) {
            modalTitle.innerHTML = '<i class="bi bi-plus fs-3 me-2"></i> Nueva Reserva';
        } else if (url.includes('edit')) {
            modalTitle.innerHTML = '<i class="bi bi-pencil-square"></i> Editar Reserva';
        } else {
            modalTitle.innerHTML = '<i class="bi bi-journal-check"></i> Formulario de Reserva';
        }
    });

    formModal.addEventListener('hidden.bs.modal', function () {
        formFrame.src = '';
        window.location.reload();
    });

    window.addEventListener('message', function (event) {
        if (event.data === 'closeModal') {
            bootstrap.Modal.getInstance(formModal).hide();
        }
        if (event.data?.type === 'setTitle') {
            modalTitle.innerHTML = `<i class="bi ${event.data.icon} me-2"></i> ${event.data.text}`;
        }
    });

    document.querySelectorAll('[data-eliminar]').forEach(boton => {
        boton.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.dataset.id;

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará la reserva definitivamente.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#c0392b',
                cancelButtonColor: '#dcdcdc',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('reserva/delete') }}/" + id;
                }
            });
        });
    });
</script>

@if (session('success_reserva'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Hecho!',
            text: "{{ session('success_reserva') }}",
            confirmButtonColor: '#8e44ad'
        });
    </script>
@endif

@if (session('error_reserva'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error_reserva') }}",
            confirmButtonColor: '#8e44ad'
        });
    </script>
@endif
