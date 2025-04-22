<?php $editando = isset($_GET['edit']) && $_GET['edit'] === '1'; ?>

<div class="container py-4">
  <h2 class="mb-4 d-flex align-items-center gap-2 <?= $_SESSION['usuario']['tipo'] === 'admin' ? 'text-dark' : '' ?>">
    <i class="bi bi-person"></i> Mi Perfil
  </h2>

  <?php if (!empty($perfil)): ?>
    <div style="max-width: 960px;" class="mx-auto">
      <form method="POST" action="?r=perfil/edit" enctype="multipart/form-data" class="card shadow-sm border-0 p-4">
        <div class="row align-items-start g-4">
          <!-- Imagen de perfil -->
          <div class="col-md-3 text-center d-flex flex-column align-items-center">
            <img id="preview-perfil"
                 src="<?= !empty($perfil['imagen_perfil']) ? htmlspecialchars($perfil['imagen_perfil']) : 'https://via.placeholder.com/150' ?>"
                 alt="Perfil"
                 class="img-thumbnail perfil-foto mb-2 rounded-circle"
                 style="width: 150px; height: 150px; object-fit: cover;">

            <?php if ($editando): ?>
              <input type="file"
                     class="form-control form-control-sm mt-2"
                     name="imagen_perfil"
                     id="imagen_perfil"
                     accept="image/*"
                     onchange="previewImagen(this)">
            <?php endif; ?>
          </div>

          <!-- Información personal -->
          <div class="col-md-9">
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
                <?= $editando
                  ? '<input type="email" name="email" class="form-control" value="' . htmlspecialchars($_SESSION['usuario']['email']) . '">' 
                  : '<div class="form-control-plaintext text-muted">' . htmlspecialchars($_SESSION['usuario']['email']) . '</div>' ?>
              </div>
            </div>

            <hr class="my-3">

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

            <?php if ($editando): ?>
              <hr class="my-3">
              <div class="row g-3 mb-2">
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
          </div>
        </div>

        <?php if ($editando): ?>
          <div class="mt-3 text-end">
            <button type="submit" class="btn btn-primary rounded-pill px-4">
              <i class="bi bi-save"></i> Guardar
            </button>
            <a href="?r=perfil/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
          </div>
        <?php endif; ?>
      </form>

      <?php if (!$editando): ?>
        <div class="mt-3 text-end">
          <a href="?r=perfil/index&edit=1" class="btn btn-warning rounded-pill px-4">
            <i class="bi bi-pencil-square"></i> Editar Perfil
          </a>
        </div>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <p><strong>Usuario:</strong> <?= htmlspecialchars($_SESSION['usuario']['username'] ?? '-') ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['usuario']['email'] ?? '-') ?></p>
    <p><strong>Tipo:</strong> <?= htmlspecialchars($_SESSION['usuario']['tipo'] ?? '-') ?></p>
  <?php endif; ?>

  <?php if ($editando): ?>
    <script>
      function previewImagen(input) {
        const file = input.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            document.getElementById('preview-perfil').src = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      }
    </script>
  <?php endif; ?>
</div>

<?php if (isset($_SESSION['success_perfil'])): ?>
<script>
Swal.fire({
  icon: 'success',
  title: '¡Perfil actualizado!',
  text: '<?= $_SESSION['success_perfil'] ?>',
  confirmButtonColor: '#8e44ad'
});
</script>
<?php unset($_SESSION['success_perfil']); endif; ?>

<?php if (isset($_SESSION['error_perfil'])): ?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Error',
  text: '<?= $_SESSION['error_perfil'] ?>',
  confirmButtonColor: '#8e44ad'
});
</script>
<?php unset($_SESSION['error_perfil']); endif; ?>
