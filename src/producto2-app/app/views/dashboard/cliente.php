<div class="container py-4">
    <h2 class="mb-4">Bienvenido, <?= $_SESSION['usuario']['username'] ?></h2>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Calendario de reservas
        </div>
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
    <div class="mt-3 text-end">
        <a href="?r=reserva/index" class="btn btn-outline-primary">Ver todas mis reservas</a>
    </div>
</div>

<!-- Modal Bootstrap para detalles de la reserva -->
<div class="modal fade" id="reservaModal" tabindex="-1" aria-labelledby="reservaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reservaModalLabel">Detalle de la Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body row">
        <div class="col-md-6">
          <p><strong>Localizador:</strong> <span id="modal-localizador"></span></p>
          <p><strong>Fecha entrada:</strong> <span id="modal-fecha"></span></p>
          <p><strong>Hora entrada:</strong> <span id="modal-hora"></span></p>
          <p><strong>Nº Vuelo:</strong> <span id="modal-vuelo"></span></p>
          <p><strong>Origen:</strong> <span id="modal-origen"></span></p>
        </div>
        <div class="col-md-6">
          <p><strong>Fecha salida:</strong> <span id="modal-fecha-salida"></span></p>
          <p><strong>Hora salida:</strong> <span id="modal-hora-salida"></span></p>
          <p><strong>Destino:</strong> <span id="modal-destino"></span></p>
          <p><strong>Vehículo:</strong> <span id="modal-vehiculo"></span></p>
          <p><strong>Viajeros:</strong> <span id="modal-viajeros"></span></p>
          <p><strong>Precio:</strong> <span id="modal-precio"></span> €</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="#" id="btn-editar" class="btn btn-warning">Editar</a>
        <a href="#" id="btn-cancelar" class="btn btn-danger" onclick="return confirm('¿Seguro que quieres borrar esta reserva?')">Borrar</a>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: <?= json_encode($GLOBALS['eventos']) ?>,

        eventClick: function(info) {
            const event = info.event;
            const props = event.extendedProps;

            document.getElementById('modal-localizador').textContent = event.title;
            document.getElementById('modal-fecha').textContent = event.start.toLocaleDateString();
            document.getElementById('modal-hora').textContent = event.start.toLocaleTimeString();
            document.getElementById('modal-vuelo').textContent = props.vuelo;
            document.getElementById('modal-origen').textContent = props.origen;
            document.getElementById('modal-fecha-salida').textContent = props.fechaSalida;
            document.getElementById('modal-hora-salida').textContent = props.horaSalida;
            document.getElementById('modal-destino').textContent = props.destino;
            document.getElementById('modal-vehiculo').textContent = props.vehiculo;
            document.getElementById('modal-viajeros').textContent = props.numViajeros;
            document.getElementById('modal-precio').textContent = props.precio;

            document.getElementById('btn-editar').href = '?r=reserva/edit&id=' + props.reservaId;
            document.getElementById('btn-cancelar').href = '?r=reserva/delete&id=' + props.reservaId;

            var myModal = new bootstrap.Modal(document.getElementById('reservaModal'));
            myModal.show();
        }
    });

    calendar.render();
});
</script>


