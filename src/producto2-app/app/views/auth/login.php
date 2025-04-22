<?php
$type = $_GET['type'] ?? 'particular';
$rol = ($type === 'admin') ? 'Administrador' : 'Usuario Particular';
$bg = ($type === 'admin') ? 'bg-dark' : 'bg-primary';
?>

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
    <a href="?r=home/index" class="position-absolute top-0 start-0 m-4 text-primary fs-3 z-2">
        <i class="bi bi-arrow-left-circle-fill"></i>
    </a>



    <!-- Imagen de fondo -->
    <img src="/img/banner-login-registro.png" alt="Fondo login" 
         class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" 
         style="z-index: 0; filter: none;">

    <!-- Contenido del formulario alineado a la derecha -->
    <div class="position-relative z-1 d-flex align-items-center justify-content-end" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <div class="card text-white <?= $bg ?> shadow fade-slide-in">
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
    </div>

</div>
<?php if (isset($_SESSION['error_login'])): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?= $_SESSION['error_login'] ?>',
        confirmButtonColor: '#8e44ad'
    });
</script>
<?php unset($_SESSION['error_login']); endif; ?>

<?php if (isset($_SESSION['success_register'])): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Registro exitoso!',
        text: '<?= $_SESSION['success_register'] ?>',
        confirmButtonColor: '#8e44ad'
    });
</script>
<?php unset($_SESSION['success_register']); endif; ?>
