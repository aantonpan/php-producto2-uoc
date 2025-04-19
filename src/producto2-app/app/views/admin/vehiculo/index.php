


<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
      <i class="bi bi-truck"></i> Vehículos</h2>
      <a href="?r=vehiculoadmin/create" class="btn btn-success rounded-pill px-4">
        <i class="bi bi-plus-circle"></i> Nuevo vehículo
     </a>
</div>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr><th>ID</th><th>Descripción</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($vehiculos as $v): ?>
          <tr>
            <td><?= $v['id_vehiculo'] ?></td>
            <td><?= htmlspecialchars($v['descripcion']) ?></td>
            <td class="text-end">
              <a href="?r=vehiculoadmin/edit&id=<?= $v['id_vehiculo'] ?>" class="btn btn-sm btn-warning rounded-pill me-2">
              <i class="bi bi-pencil"></i> Editar
              <a href="?r=vehiculoadmin/delete&id=<?= $v['id_vehiculo'] ?>" class="btn btn-sm btn-danger rounded-pill" onclick="return confirm('¿Eliminar este usuario?')">
              <i class="bi bi-trash"></i> Borrar
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
