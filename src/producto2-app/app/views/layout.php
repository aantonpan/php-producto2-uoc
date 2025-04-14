<!DOCTYPE html>
<html lang="es">

<!-- FullCalendar CSS & JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>

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
            <?php
            $dashboardLink = '?r=home/index';
            $isLoggedIn = isset($_SESSION['usuario']);
            $isAdmin = $isLoggedIn && $_SESSION['usuario']['tipo'] === 'admin';
            $isParticular = $isLoggedIn && $_SESSION['usuario']['tipo'] === 'particular';

            if ($isParticular) {
                $dashboardLink = '?r=dashboardcliente/index';
            } elseif ($isAdmin) {
                $dashboardLink = '?r=dashboardadmin/index';
            }
            ?>
            <a class="navbar-brand" href="<?= $dashboardLink ?>">TransfersApp</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php if ($isLoggedIn): ?>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        <?php if ($isParticular): ?>
                            <li class="nav-item"><a class="nav-link" href="?r=reserva/index">Mis Reservas</a></li>
                            <li class="nav-item"><a class="nav-link" href="?r=perfil/index">Mi Perfil</a></li>
                        <?php endif; ?>

                        <?php if ($isAdmin): ?>
                            <li class="nav-item"><a class="nav-link" href="?r=reserva/index">Reservas</a></li>
                            <li class="nav-item"><a class="nav-link" href="?r=perfil/index">Mi Perfil</a></li>
                            <li class="nav-item"><a class="nav-link" href="?r=zona/index">Zonas</a></li>
                            <li class="nav-item"><a class="nav-link" href="?r=hotel/index">Hoteles</a></li>
                            <li class="nav-item"><a class="nav-link" href="?r=vehiculo/index">Vehículos</a></li>
                        <?php endif; ?>

                        <li class="nav-item"><a class="nav-link text-danger" href="?r=auth/logout">Cerrar Sesión</a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <main>
        <?php include isset($contenido) ? $contenido : ''; ?>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: <?php echo json_encode($eventos ?? []); ?>, // pasamos eventos PHP → JS
            });

            calendar.render();
        }
    });
    </script>

</body>
</html>
