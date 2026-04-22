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
                    <a href="{{ route('agenda') }}" class="btn btn-organiza">Empezar con la agenda</a>
                    <a href="{{ route('perfil') }}" class="btn btn-organiza-secundario">Ver perfil</a>
                </div>
            </div>

            <div class="col-md-5 text-center mt-4 mt-md-0">
                <div class="hero-icono">
                    <div class="hero-circulo">
                        <span>OT</span>
                    </div>
                    <p class="mt-3 mb-0 text-muted">Una ayuda visual para organizar el día a día</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-inicio seguimiento-card h-100">
                    <div class="card-body">
                        <div class="icono-card mb-3">📅</div>
                        <h5 class="card-title">Seguimiento</h5>
                        <p class="card-text">
                            Accede a la agenda semanal, las notas u observaciones y el temporizador
                            para organizar rutinas y situaciones del día a día.
                        </p>
                        <a href="{{ route('agenda') }}" class="btn btn-organiza">Ir a seguimiento</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-inicio perfil-card h-100">
                    <div class="card-body">
                        <div class="icono-card mb-3">👤</div>
                        <h5 class="card-title">Perfil</h5>
                        <p class="card-text">
                            Consulta los datos de la cuenta y la información del hijo o hija asociado,
                            todo recogido en un mismo apartado.
                        </p>
                        <a href="{{ route('perfil') }}" class="btn btn-organiza-secundario">Ir a perfil</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-inicio actividades-card h-100">
                    <div class="card-body">
                        <div class="icono-card mb-3">🎯</div>
                        <h5 class="card-title">Actividades</h5>
                        <p class="card-text">
                            Consulta actividades, talleres, reuniones, eventos y otros recursos útiles
                            para familias y niños con TEA.
                        </p>
                        <a href="{{ route('actividades') }}" class="btn btn-organiza-secundario">Ir a actividades</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="zona-extra mb-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h3 class="mb-3">¿Qué podrás encontrar aquí?</h3>
                <ul class="lista-inicio mb-0">
                    <li>Organización semanal mediante agenda visual.</li>
                    <li>Notas y observaciones para registrar cambios o incidencias.</li>
                    <li>Temporizador con apoyo visual para tiempos de espera.</li>
                    <li>Información útil y recursos para familias.</li>
                </ul>
            </div>

            <div class="col-md-6">
                <div class="card-zona-imagenes text-center">
                    <h4 class="mb-3">Zona de imágenes</h4>
                    <p class="mb-3 text-muted">
                        Aquí más adelante puedes poner un carrusel o imágenes informativas
                        sobre la aplicación y sus apartados.
                    </p>
                    <div class="mini-galeria">
                        <div class="mini-bloque">Agenda</div>
                        <div class="mini-bloque">Notas</div>
                        <div class="mini-bloque">Timer</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-inicio text-center">
        <p class="mb-1">© OrganizaTEA</p>
        <p class="mb-0">Proyecto orientado al apoyo y organización familiar.</p>
    </footer>

</div>

@endsection