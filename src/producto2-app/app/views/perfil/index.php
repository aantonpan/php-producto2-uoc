<div class="container py-4">
  <h2 class="mb-4 d-flex align-items-center gap-2">
    <i class="bi bi-person"></i> Mi Perfil
  </h2>

  <?php if (!empty($perfil['email'])): ?>
    <?php $editando = isset($_GET['edit']) && $_GET['edit'] === '1'; ?>

    <!-- WRAPPER que controla el ancho del contenido -->
    <div style="max-width: 960px;" class="mx-auto">

      <!-- FORMULARIO -->
      <form method="POST" action="?r=perfil/edit" enctype="multipart/form-data" class="card shadow-sm border-0 p-4">

        <div class="row align-items-start g-4">

          <!-- Imagen a la izquierda -->
          <div class="col-md-3 text-center d-flex flex-column align-items-center">
          <?php if (!empty($perfil['imagen_perfil'])): ?>
              <img src="uploads/perfiles/<?= htmlspecialchars($perfil['imagen_perfil']) ?>" alt="Perfil"
                   class="img-thumbnail perfil-foto mb-2 rounded-circle"
                   style="width: 150px; height: 150px; object-fit: cover;">
            <?php else: ?>
              <img src="https://via.placeholder.com/150" alt="Sin imagen"
                   class="img-thumbnail perfil-foto mb-2 rounded-circle">
            <?php endif; ?>

            <?php if ($editando): ?>
              <input type="file" class="form-control form-control-sm mt-2" name="imagen_perfil" accept="image/*">
            <?php endif; ?>
          </div>

          <!-- Info personal a la derecha -->
          <div class="col-md-9">

            <!-- Fila: Nombre + Apellidos + Email -->
            <div class="row g-3 mb-3">
              <div class="col-md-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">Nombre</label>
                <?= $editando
                  ? '<input type="text" name="nombre" class="form-control" value="' . htmlspecialchars($perfil['nombre']) . '">'
                  : '<div class="form-control-plaintext">' . htmlspecialchars($perfil['nombre']) . '</div>' ?>
              </div>
              <div class="col-md-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">Apellido 1</label>
                <?= $editando
                  ? '<input type="text" name="apellido1" class="form-control" value="' . htmlspecialchars($perfil['apellido1']) . '">'
                  : '<div class="form-control-plaintext">' . htmlspecialchars($perfil['apellido1']) . '</div>' ?>
              </div>
              <div class="col-md-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">Apellido 2</label>
                <?= $editando
                  ? '<input type="text" name="apellido2" class="form-control" value="' . htmlspecialchars($perfil['apellido2']) . '">'
                  : '<div class="form-control-plaintext">' . htmlspecialchars($perfil['apellido2']) . '</div>' ?>
              </div>
              <div class="col-md-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">Email</label>
                <div class="form-control-plaintext text-muted"><?= htmlspecialchars($perfil['email']) ?></div>
              </div>
            </div>

            <hr class="my-3">

            <!-- Fila: Dirección + CP + Ciudad + País -->
            <div class="row g-3 mb-2">
              <div class="col-md-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">Dirección</label>
                <?= $editando
                  ? '<input type="text" name="direccion" class="form-control" value="' . htmlspecialchars($perfil['direccion']) . '">'
                  : '<div class="form-control-plaintext">' . htmlspecialchars($perfil['direccion']) . '</div>' ?>
              </div>
              <div class="col-md-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">Código Postal</label>
                <?= $editando
                  ? '<input type="text" name="codigoPostal" class="form-control" value="' . htmlspecialchars($perfil['codigoPostal']) . '">'
                  : '<div class="form-control-plaintext">' . htmlspecialchars($perfil['codigoPostal']) . '</div>' ?>
              </div>
              <div class="col-md-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">Ciudad</label>
                <?= $editando
                  ? '<input type="text" name="ciudad" class="form-control" value="' . htmlspecialchars($perfil['ciudad']) . '">'
                  : '<div class="form-control-plaintext">' . htmlspecialchars($perfil['ciudad']) . '</div>' ?>
              </div>
              <div class="col-md-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">País</label>
                <?= $editando
                  ? '<input type="text" name="pais" class="form-control" value="' . htmlspecialchars($perfil['pais']) . '">'
                  : '<div class="form-control-plaintext">' . htmlspecialchars($perfil['pais']) . '</div>' ?>
              </div>
            </div>

          </div> <!-- /.col-md-9 -->
        </div> <!-- /.row -->

      </form>

      <!-- BOTONES FUERA DEL FORM -->
      <div class="mt-3 text-end">
        <?php if ($editando): ?>
          <a href="?r=perfil/index" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-save"></i> Guardar
          </a>
          <a href="?r=perfil/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
        <?php else: ?>
          <a href="?r=perfil/index&edit=1" class="btn btn-warning rounded-pill px-4">
            <i class="bi bi-pencil-square"></i> Editar Perfil
          </a>
        <?php endif; ?>
      </div>

    </div> <!-- /.wrapper max-width -->

  <?php else: ?>
    <p><strong>Usuario:</strong> <?= htmlspecialchars($perfil['username'] ?? '-') ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($perfil['email'] ?? '-') ?></p>
    <p><strong>Tipo:</strong> <?= htmlspecialchars($perfil['tipo'] ?? '-') ?></p>
  <?php endif; ?>
</div>
