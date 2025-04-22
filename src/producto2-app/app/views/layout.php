<?php
if (!empty($_GET['modal'])) {
    include $contenido;
    exit;
}

$esHome = isset($_GET['r']) && $_GET['r'] === 'home/index';
$isLoggedIn = isset($_SESSION['usuario']);
$isAdmin = $isLoggedIn && $_SESSION['usuario']['tipo'] === 'admin';
$isParticular = $isLoggedIn && $_SESSION['usuario']['tipo'] === 'particular';

if ($isParticular) {
    require_once __DIR__ . '/../core/db.php';
    global $db;
    $stmt = $db->prepare("SELECT * FROM transfer_notificaciones WHERE id_usuario = ? AND leido = 0 ORDER BY creada_en DESC");
    $stmt->execute([$_SESSION['usuario']['id']]);
    $notificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $notifCount = count($notificaciones);

    $stmt = $db->prepare("SELECT imagen_perfil FROM transfer_viajeros WHERE id_usuario = ?");
    $stmt->execute([$_SESSION['usuario']['id']]);
    $perfilTopbar = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TransfersApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            color: white !important;
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
        .topbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 60px;
            background-color: transparent;
            z-index: 1050;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 2rem;
            padding-top: 3rem;
        }
        .topbar .dropdown-toggle::after {
            display: none;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                width: 100%;
            }
            .content {
                margin-left: 0;
                padding-top: 4rem;
            }
            .topbar {
                left: 0;
            }
        }
    </style>
</head>
<body>
<?php if (!$esHome && $isLoggedIn): ?>
    <?php if ($isParticular): ?>
        <div class="topbar">
            <div class="dropdown">
                <button class="btn btn-outline-secondary position-relative" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell-fill"></i>
                    <span id="notificacion-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="min-width: 300px;">
                    <li class="dropdown-header">Notificaciones</li>
                    <li><span class="dropdown-item-text text-muted">Cargando...</span></li>
                </ul>
            </div>
            <a href="?r=perfil/index">
                <img src="<?= htmlspecialchars($perfilTopbar['imagen_perfil'] ?? 'https://via.placeholder.com/40') ?>" alt="Perfil" class="rounded-circle ms-3" style="width: 40px; height: 40px; object-fit: cover;">
            </a>
        </div>
    <?php endif; ?>
    <div class="sidebar <?= $isAdmin ? 'bg-dark text-white' : 'bg-white' ?>">
        <div class="logo text-<?= $isAdmin ? 'white' : 'primary' ?>">
            <i class="bi bi-layout-sidebar"></i> TransfersApp
        </div>
        <ul class="nav flex-column">
            <?php if ($isParticular): ?>
                <li class="nav-item"><a class="nav-link text-primary" href="?r=dashboardcliente/index"><i class="bi bi-calendar-event"></i> Calendario</a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="?r=reserva/index"><i class="bi bi-journal-check"></i> Reservas</a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="?r=perfil/index"><i class="bi bi-person"></i> Mi Perfil</a></li>
            <?php elseif ($isAdmin): ?>
                <li class="nav-item"><a class="nav-link text-white" href="?r=dashboardadmin/index"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=usuarioadmin/index"><i class="bi bi-people"></i> Usuarios</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=reservaadmin/index"><i class="bi bi-journal-check"></i> Reservas</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=zonaadmin/index"><i class="bi bi-geo"></i> Zonas</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=hoteladmin/index"><i class="bi bi-building"></i> Hoteles</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=vehiculoadmin/index"><i class="bi bi-truck"></i> Vehículos</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=precioadmin/index"><i class="bi bi-cash-coin"></i> Precios</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=tiporeservaadmin/index"><i class="bi bi-tags"></i> Tipos de reserva</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="?r=perfil/index"><i class="bi bi-person"></i> Mi perfil</a></li>
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

<script>
function cargarNotificaciones() {
    fetch('/api_notificaciones.php')
        .then(res => res.json())
        .then(data => {
            const badge = document.getElementById('notificacion-badge');
            const dropdown = document.querySelector('.dropdown-menu');

            if (badge) {
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
            }

            let html = '<li class="dropdown-header">Notificaciones</li>';
            if (data.count === 0) {
                html += '<li><span class="dropdown-item-text text-muted">Sin notificaciones</span></li>';
            } else {
                data.notificaciones.forEach(n => {
                    html += `<li>
                        <a href="#"
                           class="dropdown-item d-flex justify-content-between align-items-center marcar-leida"
                           data-id="${n.id}">
                            <span>${n.mensaje}</span>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </a>
                    </li>`;
                });
            }

            if (dropdown) dropdown.innerHTML = html;
        });
}

// Al cargar
document.addEventListener('DOMContentLoaded', () => {
    cargarNotificaciones();

    // Manejar clicks en notificaciones
    document.body.addEventListener('click', function (e) {
        if (e.target.closest('.marcar-leida')) {
            e.preventDefault();
            const id = e.target.closest('.marcar-leida').dataset.id;

            fetch(`/marcar_leida.php?id=${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'ok') {
                        cargarNotificaciones(); // Vuelve a actualizar la UI
                        window.location.href = '?r=reserva/index'; // Redirige si quieres
                    }
                });
        }
    });
});

// También recarga cada 30s
setInterval(cargarNotificaciones, 30000);
</script>

</body>
</html>
