<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'OrganizaTEA')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    @auth
        <nav class="navbar-organiza">
            <div class="container navbar-contenido">
                <a class="logo-organiza" href="{{ route('inicio') }}">
                    <img src="{{ asset('images/logo.png') }}" class="logo-img" alt="Logo OrganizaTEA">
                    <span class="logo-texto">ORGANIZATEA</span>
                </a>

                <div class="menu-organiza">
                    <a class="btn-nav-organiza" href="{{ route('inicio') }}">
                        <i class="bi bi-house-door"></i>
                        <span>Inicio</span>
                    </a>

                    <div class="dropdown">
                        <button class="btn-nav-organiza dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-grid"></i>
                            <span>Seguimiento</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-organiza">
                            <li>
                                <a class="dropdown-item" href="{{ route('notes') }}">
                                    <i class="bi bi-journal-text"></i> Notas / observaciones
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('agenda') }}">
                                    <i class="bi bi-calendar-check"></i> Agenda semanal
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('temporizador') }}">
                                    <i class="bi bi-stopwatch"></i> Temporizador
                                </a>
                            </li>
                        </ul>
                    </div>

                    <a class="btn-nav-organiza" href="{{ route('perfil') }}">
                        <i class="bi bi-person-circle"></i>
                        <span>Perfil</span>
                    </a>

                    <a class="btn-nav-organiza" href="{{ route('informacion') }}">
                        <i class="bi bi-lightbulb"></i>
                        <span>Información</span>
                    </a>
                </div>
            </div>
        </nav>
    @endauth

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="footer-organiza">
        <div class="container text-center">
            <p class="mb-1">OrganizaTEA · Proyecto TFG DAW</p>
            <p class="mb-0">Aplicación web orientada al apoyo y organización familiar</p>
        </div>
    </footer>

</body>

</html>