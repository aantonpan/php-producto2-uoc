<div class="container py-4">
    <!-- Encabezado -->
    <div class="mb-4">
        <h4 class="fw-semibold text-dark mb-0"><i class="bi bi-person-circle"></i> Mi Perfil  
        </h4>
        <p class="text-muted small">Revisa tu información personal</p>
    </div>

    <?php if ($_SESSION['usuario']['tipo'] === 'particular'): ?>
        <?php $editando = isset($_GET['edit']) && $_GET['edit'] === '1'; ?>

        <form method="POST" action="?r=perfil/edit" enctype="multipart/form-data" class="card shadow-sm border-0 p-4 mx-auto" style="max-width: 720px;">

            <!-- Fila principal -->
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <!-- NOMBRE -->
                    <div class="mb-3">
                        <label class="form-label text-muted text-uppercase small fw-semibold">Nombre</label>
                        <?php if ($editando): ?>
                            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($perfil['nombre'] ?? '') ?>">
                        <?php else: ?>
                            <div class="form-control-plaintext"><?= htmlspecialchars($perfil['nombre'] ?? '-') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- APELLIDO 1 -->
                    <div class="mb-3">
                        <label class="form-label text-muted text-uppercase small fw-semibold">Apellido 1</label>
                        <?php if ($editando): ?>
                            <input type="text" name="apellido1" class="form-control" value="<?= htmlspecialchars($perfil['apellido1'] ?? '') ?>">
                        <?php else: ?>
                            <div class="form-control-plaintext"><?= htmlspecialchars($perfil['apellido1'] ?? '-') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- APELLIDO 2 -->
                    <div class="mb-3">
                        <label class="form-label text-muted text-uppercase small fw-semibold">Apellido 2</label>
                        <?php if ($editando): ?>
                            <input type="text" name="apellido2" class="form-control" value="<?= htmlspecialchars($perfil['apellido2'] ?? '') ?>">
                        <?php else: ?>
                            <div class="form-control-plaintext"><?= htmlspecialchars($perfil['apellido2'] ?? '-') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label text-muted text-uppercase small fw-semibold">Email</label>
                        <div class="form-control-plaintext text-muted"><?= htmlspecialchars($perfil['email'] ?? '-') ?></div>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="col-md-4 text-center">
                    <?php if (!empty($perfil['imagen_perfil'])): ?>
                        <img src="uploads/perfiles/<?= htmlspecialchars($perfil['imagen_perfil']) ?>" alt="Perfil" class="img-thumbnail perfil-foto mb-2">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/150" alt="Sin imagen" class="img-thumbnail perfil-foto mb-2">
                    <?php endif; ?>

                    <?php if ($editando): ?>
                        <input type="file" class="form-control form-control-sm" name="imagen_perfil" accept="image/*">
                    <?php endif; ?>
                </div>
            </div>

            <!-- Segunda fila -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label text-muted text-uppercase small fw-semibold">Dirección</label>
                    <?php if ($editando): ?>
                        <input type="text" class="form-control" name="direccion" value="<?= htmlspecialchars($perfil['direccion'] ?? '') ?>">
                    <?php else: ?>
                        <div class="form-control-plaintext"><?= htmlspecialchars($perfil['direccion'] ?? '-') ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-muted text-uppercase small fw-semibold">Código Postal</label>
                    <?php if ($editando): ?>
                        <input type="text" class="form-control" name="codigoPostal" value="<?= htmlspecialchars($perfil['codigoPostal'] ?? '') ?>">
                    <?php else: ?>
                        <div class="form-control-plaintext"><?= htmlspecialchars($perfil['codigoPostal'] ?? '-') ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-muted text-uppercase small fw-semibold">Ciudad</label>
                    <?php if ($editando): ?>
                        <input type="text" class="form-control" name="ciudad" value="<?= htmlspecialchars($perfil['ciudad'] ?? '') ?>">
                    <?php else: ?>
                        <div class="form-control-plaintext"><?= htmlspecialchars($perfil['ciudad'] ?? '-') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- País -->
            <div class="mb-3">
                <label class="form-label text-muted text-uppercase small fw-semibold">País</label>
                <?php if ($editando): ?>
                    <input type="text" class="form-control" name="pais" value="<?= htmlspecialchars($perfil['pais'] ?? '') ?>">
                <?php else: ?>
                    <div class="form-control-plaintext"><?= htmlspecialchars($perfil['pais'] ?? '-') ?></div>
                <?php endif; ?>
            </div>

            <!-- Botones -->
            <div class="mt-3 text-end">
                <?php if ($editando): ?>
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-save"></i> Guardar</button>
                    <a href="?r=perfil/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
                <?php else: ?>
                    <a href="?r=perfil/index&edit=1" class="btn btn-warning rounded-pill px-4"><i class="bi bi-pencil-square"></i> Editar Perfil</a>
                <?php endif; ?>
            </div>
        </form>

    <?php else: ?>
        <!-- Vista para admin u otros -->
        <p><strong>Usuario:</strong> <?= htmlspecialchars($perfil['username'] ?? '-') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($perfil['email'] ?? '-') ?></p>
        <p><strong>Tipo:</strong> <?= htmlspecialchars($perfil['tipo'] ?? '-') ?></p>
    <?php endif; ?>
</div>
