@extends('layouts.app')

@section('title', 'Actividades')

@section('content')

<div class="py-4">
    <h1 class="mb-4">Actividades / Información</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-3">
                En esta sección se podrá consultar información sobre actividades organizadas
                por asociaciones, charlas, talleres, reuniones y eventos relacionados con niños y niñas con TEA.
            </p>

            <p class="mb-3">
                También se podrá incluir información sobre centros y colegios según la ciudad,
                para facilitar a las familias la búsqueda de recursos útiles.
            </p>

            <p class="mb-0">
                Más adelante esta parte se podrá ampliar con filtros por ciudad,
                categorías y búsqueda de actividades.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="mb-3">Actividades</h4>
                    <ul class="mb-0">
                        <li>Charlas</li>
                        <li>Talleres</li>
                        <li>Reuniones</li>
                        <li>Eventos</li>
                        <li>Actividades organizadas por asociaciones</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="mb-3">Colegios y centros</h4>
                    <p>
                        En esta parte se podrá implementar en el futuro un filtro por ciudad
                        para mostrar colegios o centros relacionados con TEA.
                    </p>

                    <select class="form-select mb-3" disabled>
                        <option selected>Seleccionar ciudad (próximamente)</option>
                    </select>

                    <button class="btn btn-outline-secondary" disabled>
                        Buscar centros
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection