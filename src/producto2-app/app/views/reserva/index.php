<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Mis reservas</h2>
        <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#formModal"
                data-url="?r=reserva/create&modal=1">
            Nueva reserva
        </button>
    </div>

    <?php if (empty($reservas)): ?>
        <div class="alert alert-info">No tienes reservas.</div>
    <?php else: ?>
        <table class="table table-bordered table-hover">
            <thead class="table-light">
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
                    <th>Acciones</th>
                </tr>
            </thead>
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
                        <td>
                            <?php if ($puedeEditar): ?>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#formModal"
                                        data-url="?r=reserva/edit&id=<?= $res['id_reserva'] ?>&modal=1">
                                    Editar
                                </button>
                                <a href="?r=reserva/delete&id=<?= $res['id_reserva'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('¿Seguro que quieres cancelar esta reserva?')">Borrar</a>
                            <?php else: ?>
                                <button class="btn btn-sm btn-secondary" disabled>Editar</button>
                                <button class="btn btn-sm btn-secondary" disabled>Borrar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>

<!-- Modal de creación/edición -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Formulario de reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body p-0">
        <iframe id="formFrame" src="" style="width: 100%; height: 75vh; border: none;"></iframe>
      </div>
    </div>
  </div>
</div>

<script>
  const formModal = document.getElementById('formModal');
  const formFrame = document.getElementById('formFrame');

  if (formModal && formFrame) {
    formModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      if (button && button.getAttribute('data-url')) {
        formFrame.src = button.getAttribute('data-url');
      }
    });

    formModal.addEventListener('hidden.bs.modal', function () {
        window.location.reload();
    });
  }
</script>
