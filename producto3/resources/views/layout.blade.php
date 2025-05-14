<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TransfersApp - @yield('title', 'Inicio')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
    <style>
        body { overflow-x: hidden; }
        /* tus estilos custom aquí */
    </style>
</head>
<body>

    @auth
        @php
            $user = Auth::user();
            $isAdmin = $user->tipo === 'admin';
            $isParticular = $user->tipo === 'particular';
        @endphp

        @if ($isParticular)
            @include('partials.topbar')
        @endif

        <div class="sidebar {{ $isAdmin ? 'bg-dark text-white' : 'bg-white' }}">
            <div class="logo text-{{ $isAdmin ? 'white' : 'primary' }}">
                <i class="bi bi-layout-sidebar"></i> TransfersApp
            </div>
            <ul class="nav flex-column">
                @if ($isParticular)
                    <li class="nav-item"><a class="nav-link text-primary" href="{{ route('dashboard.particular') }}"><i class="bi bi-calendar-event"></i> Calendario</a></li>
                    <li class="nav-item"><a class="nav-link text-primary" href="{{ route('reserva.index') }}"><i class="bi bi-journal-check"></i> Reservas</a></li>
                    <li class="nav-item"><a class="nav-link text-primary" href="{{ route('perfil.index') }}"><i class="bi bi-person"></i> Mi Perfil</a></li>
                @elseif ($isAdmin)
                    <!-- Repite lo mismo para admin con rutas correctas -->
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.admin') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    <!-- ... resto de enlaces -->
                @endif
                <li class="nav-item mt-4"><a class="nav-link text-danger" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
            </ul>
        </div>

        <div class="content">
            @yield('content')
        </div>

    @else
        <main>
            @yield('content')
        </main>
    @endauth

    @stack('scripts')
</body>
</html>
