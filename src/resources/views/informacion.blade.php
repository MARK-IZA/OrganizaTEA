@extends('layouts.app')

@section('title', 'Información')

@section('content')

<h1 class="mb-4">Información y recursos</h1>

<div class="card mb-4">
    <div class="card-body">
        <h4>Asociaciones TEA</h4>
        <p>
            En esta sección se recopilan recursos y asociaciones relacionadas con el Trastorno del Espectro Autista.
        </p>

        <ul>
            <li><a href="https://autismo.org.es/" target="_blank">Autismo España</a></li>
            <li><a href="https://autismomadrid.es/" target="_blank">Federación Autismo Madrid</a></li>
            <li><a href="https://fespau.es/" target="_blank">FESPAU</a></li>
        </ul>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h4>Talleres y actividades</h4>
        <p>
            Las asociaciones suelen organizar charlas, talleres, reuniones familiares y actividades adaptadas.
            Esta sección sirve como punto de acceso a información útil para las familias.
        </p>

        <ul>
            <li>Talleres de habilidades sociales</li>
            <li>Actividades sensoriales</li>
            <li>Charlas para familias</li>
            <li>Eventos organizados por asociaciones</li>
        </ul>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h4>Buscador de colegios y centros</h4>
        <p>
            Busca colegios, centros educativos o asociaciones introduciendo una palabra clave y una ciudad.
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
    </div>
</div>

@endsection