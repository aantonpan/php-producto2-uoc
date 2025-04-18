<div class="container py-4">
  <h2 class="mb-4"><i class="bi bi-truck"></i> Vehículos</h2>
  <a href="?r=vehiculoadmin/create" class="btn btn-primary mb-3">+ Nuevo vehículo</a>
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
              <a href="?r=vehiculoadmin/edit&id=<?= $v['id_vehiculo'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="?r=vehiculoadmin/delete&id=<?= $v['id_vehiculo'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
