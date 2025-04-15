<div class="container py-4">
    <h2 class="mb-4">Mi perfil</h2>

    <form method="POST" action="?r=perfil/update">
        <div class="card">
            <div class="card-body">
                <?php if ($_SESSION['usuario']['tipo'] === 'particular'): ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?= $datos['nombre'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Primer apellido</label>
                            <input type="text" name="apellido1" class="form-control" value="<?= $datos['apellido1'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Segundo apellido</label>
                            <input type="text" name="apellido2" class="form-control" value="<?= $datos['apellido2'] ?? '' ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control" value="<?= $datos['direccion'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Código postal</label>
                            <input type="text" name="codigoPostal" class="form-control" value="<?= $datos['codigoPostal'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control" value="<?= $datos['ciudad'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">País</label>
                            <input type="text" name="pais" class="form-control" value="<?= $datos['pais'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $datos['email'] ?? '' ?>" required>
                        </div>
                    </div>

                <?php elseif ($_SESSION['usuario']['tipo'] === 'admin'): ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="username" class="form-control" value="<?= $datos['username'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $datos['email'] ?? '' ?>" required>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </form>
</div>
