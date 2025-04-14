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
        events: <?= json_encode($GLOBALS['eventos']) ?>
    });

    calendar.render();
});
</script>

