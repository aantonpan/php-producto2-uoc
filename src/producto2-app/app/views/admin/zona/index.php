<div class="container py-4">
  <h2 class="mb-4"><i class="bi bi-geo-alt"></i> Zonas</h2>
  <a href="?r=zonaadmin/create" class="btn btn-primary mb-3">+ Nueva zona</a>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr><th>ID</th><th>Descripción</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($zonas as $z): ?>
          <tr>
            <td><?= $z['id_zona'] ?></td>
            <td><?= htmlspecialchars($z['descripcion']) ?></td>
            <td class="text-end">
              <a href="?r=zonaadmin/edit&id=<?= $z['id_zona'] ?>" class="btn btn-sm btn-warning rounded-pill me-2">
              <i class="bi bi-pencil"></i> Editar
              <a href="?r=zonaadmin/delete&id=<?= $z['id_zona'] ?>" class="btn btn-sm btn-danger rounded-pill" onclick="return confirm('¿Eliminar este usuario?')">
              <i class="bi bi-trash"></i> Borrar
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
