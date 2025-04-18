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
    <a href="?r=reserva/index" class="btn btn-outline-primary">Ver todas mis reservas</a>
  </div>
</div>

<div class="modal fade" id="reservaModal" tabindex="-1" aria-labelledby="reservaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-journal-check"></i> Detalle de la Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="reserva-info-list">
          <div class="reserva-item"><strong>Localizador:</strong> <span id="modal-localizador"></span></div>
          <div class="reserva-item"><strong>Fecha entrada:</strong> <span id="modal-fecha"></span></div>
          <div class="reserva-item"><strong>Hora entrada:</strong> <span id="modal-hora"></span></div>
          <div class="reserva-item"><strong>Nº Vuelo:</strong> <span id="modal-vuelo"></span></div>
          <div class="reserva-item"><strong>Origen:</strong> <span id="modal-origen"></span></div>
          <div class="reserva-item"><strong>Fecha salida:</strong> <span id="modal-fecha-salida"></span></div>
          <div class="reserva-item"><strong>Hora salida:</strong> <span id="modal-hora-salida"></span></div>
          <div class="reserva-item"><strong>Destino:</strong> <span id="modal-destino"></span></div>
          <div class="reserva-item"><strong>Vehículo:</strong> <span id="modal-vehiculo"></span></div>
          <div class="reserva-item"><strong>Viajeros:</strong> <span id="modal-viajeros"></span></div>
          <div class="reserva-item"><strong>Precio:</strong> <span id="modal-precio"></span> €</div>
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
      events: <?= json_encode($GLOBALS['eventos'] ?? []) ?>,
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
