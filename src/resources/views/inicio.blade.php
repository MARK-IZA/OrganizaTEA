@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="py-4">

    <h1 class="mb-4">Bienvenido a OrganizaTEA</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p>
                OrganizaTEA es una aplicación pensada para ayudar a las familias a organizar mejor
                el seguimiento diario de niños y niñas con TEA.
            </p>

            <p class="mb-0">
                Desde esta web podrás acceder a apartados como el seguimiento, el perfil
                y las actividades.
            </p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Seguimiento</h5>
                    <p class="card-text">
                        En este apartado podrás acceder a la agenda semanal, las notas u observaciones
                        y el temporizador.
                    </p>
                    <a href="{{ route('agenda') }}" class="btn btn-primary">Ir a agenda</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Perfil</h5>
                    <p class="card-text">
                        Aquí podrás consultar los datos de la cuenta y la información del hijo o hija asociado.
                    </p>
                    <a href="{{ route('perfil') }}" class="btn btn-outline-dark">Ir a perfil</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Actividades</h5>
                    <p class="card-text">
                        En esta sección podrás ver actividades, talleres y otros recursos útiles.
                    </p>
                    <a href="#" class="btn btn-outline-secondary">Próximamente</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body text-center">
            <h5 class="mb-3">Zona de imágenes</h5>
            <p class="text-muted mb-0">
                Aquí más adelante puedes poner un carrusel o imágenes informativas.
            </p>
        </div>
    </div>

    <footer class="border-top pt-3 mt-4 text-center text-muted">
        <p class="mb-1">© OrganizaTEA</p>
        <p class="mb-0">Redes sociales y más información en el pie de página.</p>
    </footer>

</div>

@endsection