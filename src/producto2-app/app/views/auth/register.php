<?php
$type = $_GET['type'] ?? 'particular';
$rolMap = [
    'admin' => 'Administrador',
    'hotel' => 'Hotel',
    'vehiculo' => 'Conductor',
    'particular' => 'Usuario Particular'
];
$rol = $rolMap[$type] ?? 'Usuario';
$bg = ($type === 'admin') ? 'bg-dark' : 'bg-primary';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    .object-fit-cover {
        object-fit: cover;
    }

    .fade-slide-in {
        animation: fadeSlideIn 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeSlideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>



<div class="position-relative" style="min-height: 100vh; overflow: hidden;">

    <!-- Imagen de fondo -->
    <img src="/img/banner-login-registro.png" alt="Fondo registro"
         class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
         style="z-index: 0; filter: none;">

    <!-- Botón volver a home -->
    <a href="?r=home/index" class="position-absolute top-0 start-0 m-4 text-primary fs-3 z-2">
        <i class="bi bi-arrow-left-circle-fill"></i>
    </a>

    <!-- Formulario alineado a la derecha -->
    <div class="position-relative z-1 d-flex align-items-center justify-content-end" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <div class="card text-white <?= $bg ?> shadow fade-slide-in">
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

                                <div class="mb-3">
                                    <label for="typeSelect" class="form-label">Tipo de usuario</label>
                                    <select class="form-select" id="typeSelect" name="type">
                                        <option value="particular" <?= $type === 'particular' ? 'selected' : '' ?>>Usuario Particular</option>
                                        <!-- <option value="hotel" <?= $type === 'hotel' ? 'selected' : '' ?>>Hotel</option>
                                        <option value="vehiculo" <?= $type === 'vehiculo' ? 'selected' : '' ?>>Conductor</option>
                                        <option value="admin" <?= $type === 'admin' ? 'selected' : '' ?>>Administrador</option> -->
                                    </select>
                                </div>

                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-light">Crear cuenta</button>
                                </div>
                            </form>

                            <div class="mt-3 text-center">
                                ¿Ya tienes cuenta? <a class="text-white fw-bold" href="?r=auth/login&type=<?= $type ?>">Inicia sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php if (isset($_SESSION['error_register'])): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error en el registro',
        text: '<?= $_SESSION['error_register'] ?>',
        confirmButtonColor: '#8e44ad'
    });
</script>
<?php unset($_SESSION['error_register']); endif; ?>
