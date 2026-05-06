@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="py-4">

    <section class="hero-inicio">
        <div class="row align-items-center">
            <div class="col-md-7">
                <span class="badge-inicio mb-3 d-inline-block">Organización y apoyo familiar</span>

                <h1 class="mb-3">Bienvenido a OrganizaTEA</h1>

                <p class="mb-3">
                    OrganizaTEA es una aplicación pensada para ayudar a las familias a organizar
                    el seguimiento diario de niños y niñas con TEA de una forma clara, visual y sencilla.
                </p>

                <p class="mb-4">
                    Desde esta web podrás consultar la agenda semanal, guardar notas u observaciones,
                    utilizar un temporizador visual y acceder a información útil para las familias.
                </p>

                <div class="d-flex gap-2 flex-wrap">
                    @auth
                        <a href="{{ route('agenda') }}" class="btn btn-organiza">Empezar con la agenda</a>
                        <a href="{{ route('informacion') }}" class="btn btn-organiza-secundario">Ver recursos</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-organiza">Crear cuenta gratis</a>
                        <a href="{{ route('login') }}" class="btn btn-organiza-secundario">Iniciar sesión</a>
                    @endauth
                </div>
            </div>

            <div class="col-md-5 text-center mt-4 mt-md-0">
                <div class="hero-icono">
                    <div class="hero-logo-contenedor">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo OrganizaTEA" class="hero-logo-img">
                    </div>
                    <p class="mt-3 mb-0 text-muted">Una ayuda visual para organizar el día a día</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <h3 class="titulo-seccion-inicio mb-4">Apartados principales</h3>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-inicio seguimiento-card h-100">
                    <div class="card-body">
                        <div class="icono-card mb-3">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h5 class="card-title">Agenda semanal</h5>
                        <p class="card-text">
                            Organiza la semana por días y horas, añadiendo rutinas,
                            actividades, colores y cambios importantes.
                        </p>
                        @auth
                            <a href="{{ route('agenda') }}" class="btn btn-organiza">Ir a agenda</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-organiza">Acceder</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-inicio notas-card h-100">
                    <div class="card-body">
                        <div class="icono-card mb-3">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h5 class="card-title">Notas / observaciones</h5>
                        <p class="card-text">
                            Registra observaciones, incidencias, alimentación, conducta
                            o cualquier información importante del día a día.
                        </p>
                        @auth
                            <a href="{{ route('notes') }}" class="btn btn-organiza-secundario">Ir a notas</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-organiza-secundario">Acceder</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-inicio temporizador-card h-100">
                    <div class="card-body">
                        <div class="icono-card mb-3">
                            <i class="bi bi-stopwatch"></i>
                        </div>
                        <h5 class="card-title">Temporizador</h5>
                        <p class="card-text">
                            Utiliza un temporizador visual para representar tiempos de espera,
                            rutinas o actividades de forma sencilla.
                        </p>
                        @auth
                            <a href="{{ route('temporizador') }}" class="btn btn-organiza-secundario">Ir a temporizador</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-organiza-secundario">Acceder</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-inicio perfil-card h-100">
                    <div class="card-body">
                        <div class="icono-card mb-3">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <h5 class="card-title">Perfil familiar</h5>
                        <p class="card-text">
                            Consulta los datos de la cuenta y la información del hijo o hija
                            asociado.
                        </p>
                        @auth
                            <a href="{{ route('perfil') }}" class="btn btn-organiza-secundario">Ir a perfil</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-organiza-secundario">Acceder</a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-inicio informacion-card h-100">
                    <div class="card-body">
                        <div class="icono-card mb-3">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h5 class="card-title">Información y recursos</h5>
                        <p class="card-text">
                            Accede a asociaciones, artículos, vídeos y un buscador externo
                            de colegios, centros y recursos relacionados con el TEA.
                        </p>
                        @auth
                            <a href="{{ route('informacion') }}" class="btn btn-organiza-secundario">Ir a información</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-organiza-secundario">Acceder</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="zona-extra mb-5">
        <div class="row align-items-center g-4">
            <div class="col-md-5">
                <h3 class="mb-3">¿Qué podrás encontrar aquí?</h3>
                <ul class="lista-inicio mb-0">
                    <li>Organización semanal mediante una agenda visual.</li>
                    <li>Notas y observaciones para registrar información importante.</li>
                    <li>Temporizador visual para apoyar rutinas y tiempos de espera.</li>
                    <li>Perfil familiar con datos básicos de la cuenta.</li>
                    <li>Información útil, asociaciones, vídeos y buscador de centros.</li>
                </ul>
            </div>

            <div class="col-md-7">
                <section class="inicio-carrusel-section">
                    <h3 class="mb-3">Organización, apoyo y recursos</h3>
                    <p class="mb-4">
                        Imágenes representativas sobre familias, rutinas, asociaciones y apoyo relacionado con el TEA.
                    </p>

                    <div id="carruselInicio" class="carousel slide carrusel-inicio" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="3"></button>
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/inicio/foto.Inicio1.jpg') }}" class="d-block w-100 carrusel-img" alt="Familia">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/inicio/ImagenInicio3.jpg') }}" class="d-block w-100 carrusel-img" alt="Rutina visual">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/inicio/imagesInicio4.png') }}" class="d-block w-100 carrusel-img" alt="Apoyo TEA">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/inicio/SUMATEAInicio2.jpg') }}" class="d-block w-100 carrusel-img" alt="SUMATEA">
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carruselInicio" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carruselInicio" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section class="inicio-apoyo mt-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3>Apoyo para la organización diaria</h3>
                <p>
                    OrganizaTEA busca facilitar el día a día de las familias mediante herramientas sencillas,
                    visuales y fáciles de utilizar, como la agenda semanal, las notas, el temporizador
                    y la sección de información.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <div class="inicio-apoyo-icono">
                    <i class="bi bi-heart-pulse"></i>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection