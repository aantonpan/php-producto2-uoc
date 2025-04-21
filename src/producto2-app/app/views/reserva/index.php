<?php // index.php de reservas ?>

<div class="container py-4">
  <!-- Encabezado -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-journal-check"></i> Mis Reservas
      </h2>
    </div>
    <button class="btn btn-primary rounded-pill px-4"
            data-bs-toggle="modal"
            data-bs-target="#formModal"
            data-url="?r=reserva/create&modal=1">
      <i class="bi bi-plus-lg me-1"></i> Nueva reserva
    </button>
  </div>

  <?php if (empty($reservas)): ?>
    <div class="alert alert-info shadow-sm border-0">No tienes reservas.</div>
  <?php else: ?>
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
        <tbody>
          <?php foreach ($reservas as $res): ?>
            <?php
              $fechaHora = new DateTime($res['fecha_entrada'] . ' ' . $res['hora_entrada']);
              $ahora = new DateTime();
              $diff = $ahora->diff($fechaHora);
              $puedeEditar = $fechaHora > $ahora && $diff->days >= 2;
            ?>
            <tr>
              <td><?= $res['localizador'] ?></td>
              <td><?= $res['fecha_entrada'] ?></td>
              <td><?= $res['hora_entrada'] ?></td>
              <td><?= $res['numero_vuelo_entrada'] ?></td>
              <td><?= $res['origen_vuelo_entrada'] ?></td>
              <td><?= $res['fecha_vuelo_salida'] ?? '-' ?></td>
              <td><?= $res['hora_vuelo_salida'] ?? '-' ?></td>
              <td><?= $res['nombre_destino'] ?></td>
              <td><?= $res['num_viajeros'] ?></td>
              <td><?= isset($res['Precio']) ? $res['Precio'] . ' €' : 'N/D' ?></td>
              <td class="text-end">
                <?php if ($puedeEditar): ?>
                  <button class="btn btn-sm btn-warning rounded-pill"
                          data-bs-toggle="modal"
                          data-bs-target="#formModal"
                          data-url="?r=reserva/edit&id=<?= $res['id_reserva'] ?>&modal=1">
                    <i class="bi bi-pencil-square"></i> Editar
                  </button>
                  <a href="?r=reserva/delete&id=<?= $res['id_reserva'] ?>"
                    class="btn btn-sm btn-danger rounded-pill"
                    onclick="return confirm('¿Seguro que quieres cancelar esta reserva?')">
                    <i class="bi bi-trash"></i> Borrar
                  </a>
                <?php else: ?>
                  <button class="btn btn-sm btn-outline-secondary rounded-pill" disabled>Editar</button>
                  <button class="btn btn-sm btn-outline-secondary rounded-pill" disabled>Borrar</button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  <?php endif ?>
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

  if (formModal && formFrame) {
    formModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      if (!button) return;

      const url = button.getAttribute('data-url');
      formFrame.src = url;

      if (url.includes('create')) {
        modalTitle.innerHTML = '<i class="bi bi-plus fs-3 me-2"></i> Nueva Reserva';
        document.querySelector('#formModal .modal-header').classList.add('bg-primary', 'text-white');
      } else if (url.includes('edit')) {
        modalTitle.innerHTML = '<i class="bi bi-pencil-square"></i> Editar Reserva';
        document.querySelector('#formModal .modal-header').classList.add('bg-primary', 'text-white');
      } else {
        modalTitle.innerHTML = '<i class="bi bi-journal-check"></i> Formulario de Reserva';
      }

    });

    formModal.addEventListener('hidden.bs.modal', function () {
      formFrame.src = '';
      document.querySelector('#formModal .modal-header').classList.remove('bg-primary', 'text-white');
      window.location.reload();
    });


    // Escucha desde iframe para cerrar el modal con JS
    window.addEventListener('message', function (event) {
      if (event.data === 'closeModal') {
        const modal = bootstrap.Modal.getInstance(formModal);
        modal.hide();
      }

      // Actualiza el título con localizador si se recibe
      if (event.data?.type === 'setTitle') {
        const { icon, text } = event.data;
        modalTitle.innerHTML = `<i class="bi ${icon} me-2"></i> ${text}`;
      }
    });

  }
</script>
