<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'OrganizaTEA')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

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

                <a class="btn-nav-organiza" href="{{ route('contacto') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Contacto</span>
                </a>
            </div>
        </div>
    </nav>
    @endauth

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="footer-organiza mt-5">
        <div class="container py-5">

            <div class="row gy-4">

                <div class="col-md-4">
                    <div class="footer-brand">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo OrganizaTEA" class="footer-logo">
                        <h5>OrganizaTEA</h5>
                    </div>

                    <p class="footer-texto">
                        Aplicación web orientada al apoyo y organización diaria de familias
                        con niños y niñas con TEA.
                    </p>
                </div>

                <div class="col-md-4">
                    <h5>Sobre la aplicación</h5>

                    <p class="footer-texto">
                        OrganizaTEA nace como un proyecto orientado a facilitar la organización
                        diaria de familias con niños y niñas con TEA, utilizando herramientas visuales
                        como agendas, notas y temporizadores.
                    </p>

                    <p class="footer-texto mb-0">
                        El objetivo es mejorar la planificación, la comunicación y la autonomía
                        en el día a día.
                    </p>
                </div>

                <div class="col-md-4">
                    <h5>Síguenos</h5>

                    <p class="footer-texto">
                        Puedes encontrar más información y novedades en nuestras redes sociales.
                    </p>

                    <div class="footer-redes">
                        <a href="https://www.instagram.com/organizatea_oficial/" target="_blank" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="https://www.facebook.com/profile.php?id=61588972144592" target="_blank" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </div>
                </div>

            </div>

            <hr class="footer-linea">

            <div class="footer-bottom text-center">
                <p class="mb-1">OrganizaTEA · Proyecto TFG DAW</p>
                <p class="mb-0">© {{ date('Y') }} OrganizaTEA · Todos los derechos reservados</p>
            </div>

        </div>
    </footer>

</body>

</html>