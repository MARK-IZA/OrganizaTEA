@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<div class="py-4">
    <div class="card perfil-card-principal">
        <div class="card-body p-4">
            <h1 class="mb-2 perfil-titulo">Perfil de {{ $user->name }}</h1>
            <p class="mb-4 perfil-subtitulo">
                Aquí puedes consultar los datos de tu cuenta y la información del hijo o hija asociado.
            </p>

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <h5 class="mb-3">Datos de la cuenta</h5>
                        <p><strong>Nombre:</strong> {{ $user->name }}</p>
                        <p><strong>Correo:</strong> {{ $user->email }}</p>
                        <p class="mb-0"><strong>Apellidos:</strong> {{ $user->apellidos }}</p>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <h5 class="mb-3">Hijos asociados</h5>

                        @if ($user->children->isEmpty())
                            <p class="mb-0">No hay hijos registrados.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($user->children as $child)
                                    <li class="list-group-item hijo-item">
                                        <strong>{{ $child->nombre }} {{ $child->apellidos }}</strong><br>
                                        <span>Fecha de nacimiento: {{ $child->fecha_nacimiento }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-cerrar-perfil">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection