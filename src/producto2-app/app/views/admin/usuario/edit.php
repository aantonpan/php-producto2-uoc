<div class="container py-4">
  <?php if (!empty($usuario)): ?>
    <form method="POST" enctype="multipart/form-data" action="?r=usuarioadmin/update&id=<?= $usuario['id'] ?>">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
          <h2 class="mb-0 d-flex align-items-center gap-2 text-dark">
            <i class="bi bi-pencil-square"></i>
            Editar Usuario: <strong><?= htmlspecialchars($usuario['username']) ?></strong>
          </h2>

          <?php if (!empty($usuario['tipo']) && $usuario['tipo'] === 'particular'): ?>
            <div class="d-flex align-items-center gap-2">
              <img id="previewImagen"
                   src="<?= htmlspecialchars($usuario['imagen_perfil']) ?>"
                   alt="Imagen perfil"
                   class="rounded-circle border border-2"
                   style="width: 48px; height: 48px; object-fit: cover;">

              <!-- Botón de subir imagen -->
              <label class="btn btn-sm btn-outline-secondary mb-0">
                <i class="bi bi-upload"></i> Subir imagen
                <input type="file" name="imagen_perfil" id="imagenInput" hidden>
              </label>
            </div>
          <?php endif; ?>
        </div>
      </div>

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

        <?php if ($usuario['tipo'] === 'particular'): ?>
          <hr class="my-4">
          <h5 class="mb-3">Información del perfil de cliente particular</h5>

          <div class="row mb-3">
            <div class="col-md-4">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre'] ?? '') ?>">
            </div>
            <div class="col-md-4">
              <label class="form-label">Apellido 1</label>
              <input type="text" name="apellido1" class="form-control" value="<?= htmlspecialchars($usuario['apellido1'] ?? '') ?>">
            </div>
            <div class="col-md-4">
              <label class="form-label">Apellido 2</label>
              <input type="text" name="apellido2" class="form-control" value="<?= htmlspecialchars($usuario['apellido2'] ?? '') ?>">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Dirección</label>
              <input type="text" name="direccion" class="form-control" value="<?= htmlspecialchars($usuario['direccion'] ?? '') ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label">Código Postal</label>
              <input type="text" name="codigoPostal" class="form-control" value="<?= htmlspecialchars($usuario['codigoPostal'] ?? '') ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label">Ciudad</label>
              <input type="text" name="ciudad" class="form-control" value="<?= htmlspecialchars($usuario['ciudad'] ?? '') ?>">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">País</label>
              <input type="text" name="pais" class="form-control" value="<?= htmlspecialchars($usuario['pais'] ?? '') ?>">
            </div>
          </div>
        <?php endif ?>

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

<!-- Script para previsualizar imagen -->
<script>
  document.getElementById('imagenInput')?.addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImagen');
    if (file && preview) {
      preview.src = URL.createObjectURL(file);
    }
  });
</script>
