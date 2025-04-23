
  <div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
      <i class="bi bi-geo-alt"></i>Zonas</h2>
    </h2>
    <a href="?r=zonaadmin/create" class="btn btn-success rounded-pill px-4">
    <i class="bi bi-plus-circle"></i> Nueva zona
    </a>
  </div>

  <div class="table-responsive shadow-sm rounded">
  <table class="table table-hover align-middle">
  <thead class="table-light text-uppercase small text-muted">
  <tr><th>ID</th><th>Descripción</th><th class="text-end">Acciones</th></tr>
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
