<div class="container py-4">
  <h2 class="mb-4"><i class="bi bi-building"></i> Hoteles</h2>
  <a href="?r=hoteladmin/create" class="btn btn-primary mb-3">+ Nuevo hotel</a>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr><th>ID</th><th>Nombre</th><th>Dirección</th><th>Zona</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($hoteles as $h): ?>
          <tr>
            <td><?= $h['id_hotel'] ?></td>
            <td><?= htmlspecialchars($h['nombre']) ?></td>
            <td><?= htmlspecialchars($h['direccion']) ?></td>
            <td><?= htmlspecialchars($h['nombre_zona'] ?? '-') ?></td>
            <td class="text-end">
              <a href="?r=hoteladmin/edit&id=<?= $h['id_hotel'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="?r=hoteladmin/delete&id=<?= $h['id_hotel'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
