<h3 class="mb-4">Mi Perfil</h3>

<?php if ($_SESSION['usuario']['tipo'] === 'particular'): ?>
    <?php $editando = isset($_GET['edit']) && $_GET['edit'] === '1'; ?>

    <form method="POST" action="?r=perfil/edit" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
        <div class="row align-items-start mb-4">
            <div class="col-md-8">
                <!-- NOMBRE -->
                <div class="mb-2">
                    <label class="form-label">Nombre</label>
                    <?php if ($editando): ?>
                        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($perfil['nombre'] ?? '') ?>">
                    <?php else: ?>
                        <div><strong><?= htmlspecialchars($perfil['nombre'] ?? '-') ?></strong></div>
                    <?php endif; ?>
                </div>

                <!-- APELLIDO 1 -->
                <div class="mb-2">
                    <label class="form-label">Apellido 1</label>
                    <?php if ($editando): ?>
                        <input type="text" name="apellido1" class="form-control" value="<?= htmlspecialchars($perfil['apellido1'] ?? '') ?>">
                    <?php else: ?>
                        <div><strong><?= htmlspecialchars($perfil['apellido1'] ?? '-') ?></strong></div>
                    <?php endif; ?>
                </div>

                <!-- APELLIDO 2 -->
                <div class="mb-2">
                    <label class="form-label">Apellido 2</label>
                    <?php if ($editando): ?>
                        <input type="text" name="apellido2" class="form-control" value="<?= htmlspecialchars($perfil['apellido2'] ?? '') ?>">
                    <?php else: ?>
                        <div><strong><?= htmlspecialchars($perfil['apellido2'] ?? '-') ?></strong></div>
                    <?php endif; ?>
                </div>

                <!-- EMAIL (SOLO LECTURA) -->
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <div class="text-muted"><?= htmlspecialchars($perfil['email'] ?? '-') ?></div>
                </div>
            </div>

            <!-- IMAGEN -->
            <div class="col-md-4 text-center">
                <?php if (!empty($perfil['imagen_perfil'])): ?>
                    <img src="uploads/perfiles/<?= htmlspecialchars($perfil['imagen_perfil']) ?>" alt="Perfil" class="img-thumbnail rounded-circle" style="max-width: 130px;">
                <?php else: ?>
                    <img src="https://via.placeholder.com/130" alt="Sin imagen" class="img-thumbnail rounded-circle">
                <?php endif; ?>

                <?php if ($editando): ?>
                    <input type="file" class="form-control mt-2" name="imagen_perfil" accept="image/*">
                <?php endif; ?>
            </div>
        </div>

        <!-- FILA: Dirección, Código Postal, Ciudad -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Dirección</label>
                <?php if ($editando): ?>
                    <input type="text" class="form-control" name="direccion" value="<?= htmlspecialchars($perfil['direccion'] ?? '') ?>">
                <?php else: ?>
                    <div><?= htmlspecialchars($perfil['direccion'] ?? '-') ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <label class="form-label">Código Postal</label>
                <?php if ($editando): ?>
                    <input type="text" class="form-control" name="codigoPostal" value="<?= htmlspecialchars($perfil['codigoPostal'] ?? '') ?>">
                <?php else: ?>
                    <div><?= htmlspecialchars($perfil['codigoPostal'] ?? '-') ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <label class="form-label">Ciudad</label>
                <?php if ($editando): ?>
                    <input type="text" class="form-control" name="ciudad" value="<?= htmlspecialchars($perfil['ciudad'] ?? '') ?>">
                <?php else: ?>
                    <div><?= htmlspecialchars($perfil['ciudad'] ?? '-') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- PAÍS -->
        <div class="mb-3">
            <label class="form-label">País</label>
            <?php if ($editando): ?>
                <input type="text" class="form-control" name="pais" value="<?= htmlspecialchars($perfil['pais'] ?? '') ?>">
            <?php else: ?>
                <div><?= htmlspecialchars($perfil['pais'] ?? '-') ?></div>
            <?php endif; ?>
        </div>

        

        <!-- BOTONES -->
        <div class="mt-4">
            <?php if ($editando): ?>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar</button>
                <a href="?r=perfil/index" class="btn btn-secondary">Cancelar</a>
            <?php else: ?>
                <a href="?r=perfil/index&edit=1" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar Perfil</a>
            <?php endif; ?>
        </div>
    </form>

<?php else: ?>
    <!-- Vista para admin u otros -->
    <p><strong>Usuario:</strong> <?= htmlspecialchars($perfil['username'] ?? '-') ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($perfil['email'] ?? '-') ?></p>
    <p><strong>Tipo:</strong> <?= htmlspecialchars($perfil['tipo'] ?? '-') ?></p>
<?php endif; ?>
