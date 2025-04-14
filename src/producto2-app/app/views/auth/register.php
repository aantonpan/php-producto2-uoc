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
                    <h2 class="card-title text-center mb-4">Registro - <?= $rol ?></h2>

                    <form method="POST" action="?r=auth/register">
                        <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">

                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-light">Crear cuenta</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        ¿Ya tienes cuenta? <a class="text-white" href="?r=auth/login&type=particular">Inicia sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
