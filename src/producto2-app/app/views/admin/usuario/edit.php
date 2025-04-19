<div class="container py-4">
  <h2 class="mb-4"><i class="bi bi-pencil-square"></i> Editar Usuario</h2>

  <?php if (!empty($usuario)): ?>
    <form method="POST" action="?r=usuarioadmin/update&id=<?= $usuario['id'] ?>">
      <div class="card p-4 shadow-sm border-0">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Nombre de usuario</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($usuario['username']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Contraseña (Dejar en blanco para no cambiar)</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Tipo de usuario</label>
            <select name="tipo" class="form-select" required>
              <option value="admin" <?= $usuario['tipo'] === 'admin' ? 'selected' : '' ?>>Admin</option>
              <option value="particular" <?= $usuario['tipo'] === 'particular' ? 'selected' : '' ?>>Particular</option>
            </select>
          </div>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-check-circle"></i> Guardar cambios
          </button>
          <a href="?r=usuarioadmin/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
        </div>
      </div>
    </form>
  <?php else: ?>
    <div class="alert alert-danger">Usuario no encontrado.</div>
  <?php endif ?>
</div>
