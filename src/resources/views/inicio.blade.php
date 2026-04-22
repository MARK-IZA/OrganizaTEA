@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="py-4">

    <div class="hero-inicio">
        <h1 class="mb-3">Bienvenido a OrganizaTEA</h1>
        <p class="mb-2">
            OrganizaTEA es una aplicación pensada para ayudar a las familias a organizar
            mejor el seguimiento diario de niños y niñas con TEA.
        </p>
        <p class="mb-0">
            Desde esta web podrás acceder a apartados como seguimiento, perfil y actividades,
            todo desde una forma sencilla y visual.
        </p>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card card-inicio h-100">
                <div class="card-body">
                    <h5 class="card-title">Seguimiento</h5>
                    <p class="card-text">
                        En este apartado podrás acceder a la agenda semanal, las notas u observaciones
                        y el temporizador.
                    </p>
                    <a href="{{ route('agenda') }}" class="btn btn-organiza">Ir a agenda</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card card-inicio h-100">
                <div class="card-body">
                    <h5 class="card-title">Perfil</h5>
                    <p class="card-text">
                        Aquí podrás consultar los datos de la cuenta y la información
                        del hijo o hija asociado.
                    </p>
                    <a href="{{ route('perfil') }}" class="btn btn-organiza-secundario">Ir a perfil</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card card-inicio h-100">
                <div class="card-body">
                    <h5 class="card-title">Actividades</h5>
                    <p class="card-text">
                        En esta sección podrás ver actividades, talleres y otros recursos útiles
                        para las familias.
                    </p>
                    <a href="{{ route('actividades') }}" class="btn btn-organiza-secundario">Ir a actividades</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-zona-imagenes text-center mb-4">
        <h4 class="mb-3">Zona de imágenes</h4>
        <p class="mb-0 text-muted">
            Aquí más adelante puedes poner un carrusel o imágenes informativas sobre la aplicación.
        </p>
    </div>

    <footer class="border-top pt-3 mt-4 text-center footer-inicio">
        <p class="mb-1">© OrganizaTEA</p>
        <p class="mb-0">Redes sociales y más información en el pie de página.</p>
    </footer>

</div>

@endsection