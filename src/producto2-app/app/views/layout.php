<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Eventos</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="?r=home/index">TransfersApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <?php if (isset($_SESSION['usuario'])): ?>
                        <!-- Usuario logueado -->
                        <li class="nav-item"><a class="nav-link" href="?r=evento/index">Eventos</a></li>
                        <li class="nav-item"><a class="nav-link" href="?r=reserva/index">Reservas</a></li>
                        <li class="nav-item"><a class="nav-link" href="?r=perfil/index">Mi Perfil</a></li>

                        <!-- Solo admins podrían ver estas (añade validación más adelante) -->
                        <li class="nav-item"><a class="nav-link" href="?r=zona/index">Zonas</a></li>
                        <li class="nav-item"><a class="nav-link" href="?r=hotel/index">Hoteles</a></li>
                        <li class="nav-item"><a class="nav-link" href="?r=vehiculo/index">Vehículos</a></li>

                        <!-- Logout -->
                        <li class="nav-item"><a class="nav-link text-danger" href="?r=auth/logout">Cerrar Sesión</a></li>

                    <?php else: ?>
                        <!-- Usuario NO logueado -->
                        <li class="nav-item"><a class="nav-link" href="?r=auth/login&type=particular">Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="?r=auth/register&type=particular">Registrarse</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php include isset($contenido) ? $contenido : ''; ?>
    </main>

</body>
</html>
