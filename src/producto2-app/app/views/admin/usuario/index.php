<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="d-flex align-items-center gap-2 mb-0">
      <i class="bi bi-people"></i> Gestión de Usuarios
    </h2>
  </div>

  <?php if (empty($usuarios)): ?>
    <div class="alert alert-info shadow-sm">No hay usuarios registrados.</div>
  <?php else: ?>
    <div class="table-responsive shadow-sm rounded">
      <table class="table table-hover align-middle">
        <thead class="table-light text-uppercase small text-muted">
          <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Fecha creación</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $u): ?>
            <tr>
              <td><?= htmlspecialchars($u['username']) ?></td>
              <td><?= htmlspecialchars($u['email']) ?></td>
              <td><?= ucfirst($u['tipo']) ?></td>
              <td><?= date('d/m/Y', strtotime($u['creado_en'])) ?></td>
              <td class="text-end">
                <a href="?r=usuarioadmin/edit&id=<?= $u['id'] ?>" class="btn btn-sm btn-warning rounded-pill me-2">
                  <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="?r=usuarioadmin/delete&id=<?= $u['id'] ?>" class="btn btn-sm btn-danger rounded-pill" onclick="return confirm('¿Eliminar este usuario?')">
                  <i class="bi bi-trash"></i> Borrar
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  <?php endif ?>
</div>
