<?php
$type = $_GET['type'] ?? 'particular';
$rol = ($type === 'admin') ? 'Administrador' : 'Usuario Particular';
$bg = ($type === 'admin') ? 'bg-dark' : 'bg-primary';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-white <?= $bg ?>">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login - <?= $rol ?></h2>

                    <form method="POST" action="?r=auth/login">
                        <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-light">Iniciar sesión</button>
                        </div>
                    </form>

                    <?php if ($type === 'particular'): ?>
                        <div class="mt-3 text-center">
                            ¿No tienes cuenta? <a class="text-white" href="?r=auth/register&type=particular">Regístrate</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
