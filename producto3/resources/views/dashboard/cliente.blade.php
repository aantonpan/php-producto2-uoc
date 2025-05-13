<div class="container py-4">
    <h2 class="mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-calendar-event"></i> Mi Calendario
    </h2>

    <div class="card">
        <div class="card-header bg-primary text-white">Calendario de reservas</div>
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>

    <div class="mt-3 text-end">
        <a href="{{ route('reserva.index') }}" class="btn btn-outline-primary">Ver todas mis reservas</a>
    </div>
</div>

<!-- Modal estilizado -->
<div class="modal fade" id="reservaModal" tabindex="-1" aria-labelledby="reservaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm rounded-4">
            <!-- CABECERA -->
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title d-flex align-items-center gap-2">
                    <i class="bi bi-journal-check"></i> Detalle de la Reserva
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- CUERPO -->
            <div class="modal-body p-4">
                <div class="row g-3">
                    @foreach([
                        'Localizador' => 'modal-localizador',
                        'Fecha entrada' => 'modal-fecha',
                        'Hora entrada' => 'modal-hora',
                        'Nº Vuelo' => 'modal-vuelo',
                        'Origen' => 'modal-origen',
                        'Fecha salida' => 'modal-fecha-salida',
                        'Hora salida' => 'modal-hora-salida',
                        'Destino' => 'modal-destino',
                        'Vehículo' => 'modal-vehiculo',
                        'Viajeros' => 'modal-viajeros'
                    ] as $label => $id)
                        <div class="col-md-6 border-bottom pb-2">
                            <strong class="text-muted">{{ $label }}:</strong><br>
                            <span id="{{ $id }}"></span>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-end mt-4">
                        <div class="px-4 py-2 bg-secondary text-white fw-semibold shadow-sm">
                            <span id="modal-precio"></span> €
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl || typeof FullCalendar === 'undefined') {
            console.error('FullCalendar no está disponible');
            return;
        }

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: @json($eventos ?? []),
            eventDidMount: function(info){
                info.el.style.cursor = 'pointer';
            },
            eventClick: function (info) {
                const e = info.event;
                const props = e.extendedProps;

                document.getElementById('modal-localizador').textContent = e.title;
                document.getElementById('modal-fecha').textContent = e.start.toLocaleDateString();
                document.getElementById('modal-hora').textContent = e.start.toLocaleTimeString();
                document.getElementById('modal-vuelo').textContent = props.vuelo || 'N/D';
                document.getElementById('modal-origen').textContent = props.origen || 'N/D';
                document.getElementById('modal-fecha-salida').textContent = props.fechaSalida || '-';
                document.getElementById('modal-hora-salida').textContent = props.horaSalida || '-';
                document.getElementById('modal-destino').textContent = props.destino || 'N/D';
                document.getElementById('modal-vehiculo').textContent = props.vehiculo || 'N/D';
                document.getElementById('modal-viajeros').textContent = props.numViajeros || 'N/D';
                document.getElementById('modal-precio').textContent = props.precio || 'N/D';

                const modal = new bootstrap.Modal(document.getElementById('reservaModal'));
                modal.show();
            }
        });

        calendar.render();
    });
</script>
