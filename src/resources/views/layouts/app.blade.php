<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'OrganizaTEA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @auth
    <nav class="border-bottom bg-white py-3">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- LOGO -->
            <a class="fw-bold fs-2 text-dark text-decoration-none" href="{{ route('dashboard') }}">
                ORGANIZATEA
            </a>

            <!-- MENÚ -->
            <div class="d-flex align-items-center gap-2">

                <!-- Seguimiento -->
                <div class="dropdown">
                    <button class="btn btn-outline-dark rounded-pill px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Seguimiento
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Notas / observaciones</a></li>
                        <li><a class="dropdown-item" href="{{ route('agenda') }}">Diario semanal / Calendario / Agenda semanal</a></li>
                        <li><a class="dropdown-item" href="#">Temporizador para niños con TEA</a></li>
                    </ul>
                </div>

                <!-- Perfil -->
                <a class="btn btn-outline-dark px-4" href="#">Perfil</a>

                <!-- Actividades -->
                <a class="btn btn-outline-dark px-4" href="#">Actividades</a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                </form>

            </div>
        </div>
    </nav>
    @endauth

    <!-- CONTENIDO -->
    <main class="container mt-4">
        @yield('content')
    </main>

</body>
</html>