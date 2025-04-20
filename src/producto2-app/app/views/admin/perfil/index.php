<?php $editando = isset($_GET['edit']) && $_GET['edit'] === '1'; ?>

<div class="container py-4">
  <h2 class="mb-4 d-flex align-items-center gap-2 text-dark">
    <i class="bi bi-person"></i> Mi Perfil
  </h2>

  <div style="max-width: 960px;" class="mx-auto">
    <form method="POST" action="?r=perfiladmin/edit" class="card shadow-sm border-0 p-4">
      <div class="row align-items-start g-4">
        <div class="col-md-9 offset-md-1">
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label text-muted text-uppercase small fw-semibold">Correo electrónico</label>
              <?php if ($editando): ?>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
              <?php else: ?>
                <div class="form-control-plaintext text-muted"><?= htmlspecialchars($usuario['email']) ?></div>
              <?php endif; ?>
            </div>
          </div>

          <?php if ($editando): ?>
            <hr class="my-3">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label text-muted text-uppercase small fw-semibold">Nueva contraseña</label>
                <input type="password" name="password" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label text-muted text-uppercase small fw-semibold">Repetir contraseña</label>
                <input type="password" name="password2" class="form-control">
              </div>
            </div>
          <?php endif; ?>

          <?php if ($editando): ?>
            <div class="mt-3 text-end">
              <button type="submit" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-save"></i> Guardar
              </button>
              <a href="?r=perfiladmin/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </form>

    <?php if (!$editando): ?>
      <div class="mt-3 text-end">
        <a href="?r=perfiladmin/index&edit=1" class="btn btn-warning rounded-pill px-4">
          <i class="bi bi-pencil-square"></i> Editar Perfil
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>
