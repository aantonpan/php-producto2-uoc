<div class="container py-4">
  <h2 class="mb-4 text-dark"><i class="bi bi-tags"></i> Tipos de Reserva</h2>
  <a href="?r=tiporeservaadmin/create" class="btn btn-primary mb-3">+ Nuevo tipo</a>

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
              <a href="?r=tiporeservaadmin/edit&id=<?= $t['id_tipo_reserva'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="?r=tiporeservaadmin/delete&id=<?= $t['id_tipo_reserva'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
