@extends('layouts.app')

@section('title', 'Información')

@section('content')

<h1 class="mb-4">Información y recursos</h1>

<div class="info-hero mb-4">
    <h3>Recursos útiles para familias</h3>
    <p>
        En esta sección puedes encontrar asociaciones relacionadas con el TEA,
        enlaces de interés, actividades orientativas y un buscador de colegios,
        centros o asociaciones por ciudad.
    </p>
</div>

<section class="info-section mb-4">
    <h4>Asociaciones TEA</h4>
    <p>
        Algunas asociaciones ofrecen información, orientación familiar, actividades,
        talleres o recursos para personas con TEA y sus familias.
    </p>

    <div class="info-links">
        <a href="https://sumatea.es/" target="_blank">SUMATEA - Sur Madrid TEA</a>
        <a href="https://autismomadrid.es/" target="_blank">Federación Autismo Madrid</a>
        <a href="https://autismo.org.es/" target="_blank">Autismo España</a>
        <a href="https://fespau.es/" target="_blank">FESPAU</a>
        <a href="https://aspergermadrid.eu/" target="_blank">Asperger Madrid</a>
    </div>
</section>

<section class="info-section mb-4">
    <h4>Talleres y actividades</h4>
    <p>
        Las asociaciones suelen publicar charlas, talleres, jornadas, actividades de ocio,
        apoyo familiar y formación. Desde aquí se puede acceder a sus páginas para consultar
        próximas actividades.
    </p>

    <ul class="info-lista">
        <li>Talleres de habilidades sociales.</li>
        <li>Actividades sensoriales o de ocio adaptado.</li>
        <li>Charlas para familias.</li>
        <li>Jornadas, eventos y formación.</li>
    </ul>

    <p class="mb-0">
        Puedes consultar las novedades directamente desde las webs de las asociaciones anteriores.
    </p>
</section>

<section class="info-section mb-4">
    <h4>Buscador de colegios y centros</h4>
    <p>
        Busca colegios, centros educativos, asociaciones o recursos relacionados con el TEA
        introduciendo una palabra clave y una ciudad.
    </p>

    <div class="row">
        <div class="col-md-5 mb-3">
            <label class="form-label">Qué quieres buscar</label>
            <input type="text" id="busqueda-recurso" class="form-control" value="colegio educación especial">
        </div>

        <div class="col-md-5 mb-3">
            <label class="form-label">Ciudad o zona</label>
            <input type="text" id="busqueda-ciudad" class="form-control" value="Madrid">
        </div>

        <div class="col-md-2 mb-3 d-flex align-items-end">
            <button type="button" id="btn-buscar-recursos" class="btn btn-primary w-100">
                Buscar
            </button>
        </div>
    </div>

    <div id="mensaje-recursos" class="mt-3"></div>
    <div id="resultados-recursos" class="mt-3"></div>
</section>

@endsection