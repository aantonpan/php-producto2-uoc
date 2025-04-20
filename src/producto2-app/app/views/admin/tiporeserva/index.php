<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
      <i class="bi bi-tags"></i> Tipos de Reserva</h2>
      </h2>
  <a href="?r=tiporeservaadmin/create" class="btn btn-success rounded-pill px-4">
  <i class="bi bi-plus-circle"></i> Nuevo tipo</a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr><th>ID</th><th>Descripción</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($tipos as $t): ?>
          <tr>
            <td><?= $t['id_tipo_reserva'] ?></td>
            <td><?= htmlspecialchars($t['descripcion']) ?></td>
            <td class="text-end">
              <a href="?r=tiporeservaadmin/edit&id=<?= $t['id_tipo_reserva'] ?>" class="btn btn-sm btn-warning rounded-pill me-2">
              <i class="bi bi-pencil"></i> Editar
              </a>
              <a href="?r=tiporeservaadmin/delete&id=<?= $t['id_tipo_reserva'] ?>" class="btn btn-sm btn-danger rounded-pill">
              <i class="bi bi-trash"></i> Borrar
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
