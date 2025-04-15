<h3 class="mb-4">Mi Perfil</h3>

<?php if ($_SESSION['usuario']['tipo'] === 'particular'): ?>
    <?php $editando = isset($_GET['edit']) && $_GET['edit'] === '1'; ?>

    <form method="POST" action="?r=perfil/edit">
        <!-- Nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <?php if ($editando): ?>
                <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($perfil['nombre'] ?? '') ?>">
            <?php else: ?>
                <div><?= htmlspecialchars($perfil['nombre'] ?? '-') ?></div>
            <?php endif; ?>
        </div>

        <!-- Apellido 1 -->
        <div class="mb-3">
            <label class="form-label">Apellido 1</label>
            <?php if ($editando): ?>
                <input type="text" class="form-control" name="apellido1" value="<?= htmlspecialchars($perfil['apellido1'] ?? '') ?>">
            <?php else: ?>
                <div><?= htmlspecialchars($perfil['apellido1'] ?? '-') ?></div>
            <?php endif; ?>
        </div>

        <!-- Apellido 2 -->
        <div class="mb-3">
            <label class="form-label">Apellido 2</label>
            <?php if ($editando): ?>
                <input type="text" class="form-control" name="apellido2" value="<?= htmlspecialchars($perfil['apellido2'] ?? '') ?>">
            <?php else: ?>
                <div><?= htmlspecialchars($perfil['apellido2'] ?? '-') ?></div>
            <?php endif; ?>
        </div>

        <!-- Dirección -->
        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <?php if ($editando): ?>
                <input type="text" class="form-control" name="direccion" value="<?= htmlspecialchars($perfil['direccion'] ?? '') ?>">
            <?php else: ?>
                <div><?= htmlspecialchars($perfil['direccion'] ?? '-') ?></div>
            <?php endif; ?>
        </div>

        <!-- Código Postal -->
        <div class="mb-3">
            <label class="form-label">Código Postal</label>
            <?php if ($editando): ?>
                <input type="text" class="form-control" name="codigoPostal" value="<?= htmlspecialchars($perfil['codigoPostal'] ?? '') ?>">
            <?php else: ?>
                <div><?= htmlspecialchars($perfil['codigoPostal'] ?? '-') ?></div>
            <?php endif; ?>
        </div>

        <!-- Ciudad -->
        <div class="mb-3">
            <label class="form-label">Ciudad</label>
            <?php if ($editando): ?>
                <input type="text" class="form-control" name="ciudad" value="<?= htmlspecialchars($perfil['ciudad'] ?? '') ?>">
            <?php else: ?>
                <div><?= htmlspecialchars($perfil['ciudad'] ?? '-') ?></div>
            <?php endif; ?>
        </div>

        <!-- País -->
        <div class="mb-3">
            <label class="form-label">País</label>
            <?php if ($editando): ?>
                <input type="text" class="form-control" name="pais" value="<?= htmlspecialchars($perfil['pais'] ?? '') ?>">
            <?php else: ?>
                <div><?= htmlspecialchars($perfil['pais'] ?? '-') ?></div>
            <?php endif; ?>
        </div>

        <!-- Email (solo mostrar) -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <div><?= htmlspecialchars($perfil['email'] ?? '-') ?></div>
        </div>

        <!-- Botones -->
        <div class="mt-4 d-flex gap-2">
            <?php if ($editando): ?>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="?r=perfil/index" class="btn btn-secondary">Cancelar</a>
            <?php else: ?>
                <a href="?r=perfil/index&edit=1" class="btn btn-warning">Editar Perfil</a>
            <?php endif; ?>
        </div>
    </form>

<?php else: ?>
    <p><strong>Usuario:</strong> <?= htmlspecialchars($perfil['username'] ?? '-') ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($perfil['email'] ?? '-') ?></p>
    <p><strong>Tipo:</strong> <?= htmlspecialchars($perfil['tipo'] ?? '-') ?></p>
<?php endif; ?>
