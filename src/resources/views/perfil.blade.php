@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<h1 class="mb-4">Perfil familiar</h1>

<div class="row">

    <div class="col-md-6 mb-4">
        <div class="perfil-card">
            <h4>Datos de la cuenta</h4>

            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Apellidos:</strong> {{ $user->apellidos }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="perfil-card">
            <h4>Datos del niño/a</h4>

            @if ($user->children->isNotEmpty())
                @php
                    $child = $user->children->first();
                    $edad = $child->fecha_nacimiento
                        ? \Carbon\Carbon::parse($child->fecha_nacimiento)->age
                        : null;
                @endphp

                <p><strong>Nombre:</strong> {{ $child->nombre }}</p>
                <p><strong>Apellidos:</strong> {{ $child->apellidos }}</p>
                <p><strong>Fecha nacimiento:</strong> {{ $child->fecha_nacimiento }}</p>

                @if ($edad)
                    <p><strong>Edad:</strong> {{ $edad }} años</p>
                @endif
            @else
                <p>No hay datos del niño/a.</p>
            @endif
        </div>
    </div>

    <div class="col-12 mb-4">
        <div class="perfil-card perfil-resumen">
            <h4>Resumen de actividad</h4>

            <div class="resumen-contenido">
                <div class="resumen-item">
                    <div class="resumen-icono">
                        <i class="bi bi-journal-text"></i>
                    </div>

                    <h5>{{ $notas }}</h5>
                    <p>Notas registradas</p>
                </div>

                <div class="resumen-item">
                    <div class="resumen-icono">
                        <i class="bi bi-stopwatch"></i>
                    </div>

                    <h5>{{ $temporizadores }}</h5>
                    <p>Temporizadores creados</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 text-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-cerrar-perfil">
                Cerrar sesión
            </button>
        </form>
    </div>

</div>

@endsection