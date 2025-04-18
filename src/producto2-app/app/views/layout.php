<?php
if (!empty($_GET['modal'])) {
    include $contenido;
    exit;
}

$esHome = isset($_GET['r']) && $_GET['r'] === 'home/index';
$isLoggedIn = isset($_SESSION['usuario']);
$isAdmin = $isLoggedIn && $_SESSION['usuario']['tipo'] === 'admin';
$isParticular = $isLoggedIn && $_SESSION['usuario']['tipo'] === 'particular';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TransfersApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- FullCalendar (versión global para uso directo en el navegador) -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js" defer></script>

    <!-- Tu CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <style>
        body { overflow-x: hidden; }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 1rem;
            z-index: 1040;
        }
        .sidebar .nav-link {
            font-weight: 500;
            padding: 0.6rem 1rem;
            border-radius: 8px;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: var(--bs-primary);
            color: #fff !important;
        }
        .sidebar .logo {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }
        .content {
            margin-left: 250px;
            padding: 2rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                width: 100%;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<?php if (!$esHome && $isLoggedIn): ?>
    <div class="sidebar <?= $isAdmin ? 'bg-dark text-white' : 'bg-white' ?>">
        <div class="logo text-<?= $isAdmin ? 'white' : 'primary' ?>">
            <i class="bi bi-layout-sidebar"></i> TransfersApp
        </div>
        <ul class="nav flex-column">
            <?php if ($isParticular): ?>
                <li class="nav-item"><a class="nav-link text-<?= $isParticular ? 'primary' : 'white' ?>" href="?r=dashboardcliente/index"><i class="bi bi-calendar-event"></i> Calendario</a></li>
                <li class="nav-item"><a class="nav-link text-<?= $isParticular ? 'primary' : 'white' ?>" href="?r=reserva/index"><i class="bi bi-journal-check"></i> Reservas</a></li>
                <li class="nav-item"><a class="nav-link text-<?= $isParticular ? 'primary' : 'white' ?>" href="?r=perfil/index"><i class="bi bi-person"></i> Mi Perfil</a></li>
            <?php elseif ($isAdmin): ?>
                <li class="nav-item"><a class="nav-link text-white" href="?r=dashboardadmin/index"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=usuario/index"><i class="bi bi-people"></i> Usuarios</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=reserva/index"><i class="bi bi-journal-check"></i> Reservas</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=perfil/index"><i class="bi bi-person"></i> Perfiles</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=zona/index"><i class="bi bi-geo"></i> Zonas</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=hotel/index"><i class="bi bi-building"></i> Hoteles</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=vehiculo/index"><i class="bi bi-truck"></i> Vehículos</a></li>
            <?php endif; ?>
            <li class="nav-item mt-4"><a class="nav-link text-danger" href="?r=auth/logout"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
        </ul>
    </div>

    <div class="content">
        <?php include isset($contenido) ? $contenido : ''; ?>
    </div>
<?php else: ?>
    <main>
        <?php include isset($contenido) ? $contenido : ''; ?>
    </main>
<?php endif; ?>

</body>
</html>
