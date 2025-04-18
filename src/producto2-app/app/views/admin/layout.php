<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Tu CSS personalizado -->
  <link rel="stylesheet" href="/css/style.css">

  <style>
    body {
      overflow-x: hidden;
      background-color: #f8f9fa;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      padding: 1rem;
      background-color: #212529;
      color: #fff;
    }
    .sidebar .nav-link {
      color: #ccc;
      font-weight: 500;
      padding: 0.6rem 1rem;
      border-radius: 8px;
    }
    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
      background-color: #343a40;
      color: #fff !important;
    }
    .sidebar .logo {
      font-size: 1.3rem;
      font-weight: bold;
      margin-bottom: 2rem;
      color: #fff;
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
  <div class="sidebar">
    <div class="logo">
      <i class="bi bi-layout-sidebar"></i> AdminPanel
    </div>
    <ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link" href="?r=dashboardadmin/index"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="?r=usuarioadmin/index"><i class="bi bi-people"></i> Usuarios</a></li>
      <li class="nav-item"><a class="nav-link" href="?r=reservaadmin/index"><i class="bi bi-journal-check"></i> Reservas</a></li>
      <li class="nav-item"><a class="nav-link" href="?r=perfil/index"><i class="bi bi-person"></i> Perfiles</a></li>
      <li class="nav-item"><a class="nav-link" href="?r=zonaadmin/index"><i class="bi bi-geo"></i> Zonas</a></li>
      <li class="nav-item"><a class="nav-link" href="?r=hoteladmin/index"><i class="bi bi-building"></i> Hoteles</a></li>
      <li class="nav-item"><a class="nav-link" href="?r=vehiculoadmin/index"><i class="bi bi-truck"></i> Vehículos</a></li>
      <li class="nav-item mt-4"><a class="nav-link text-danger" href="?r=auth/logout"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
    </ul>
  </div>

  <div class="content">
    <?php include isset($contenido) ? $contenido : ''; ?>
  </div>
</body>
</html>
