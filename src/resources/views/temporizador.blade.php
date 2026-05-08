@extends('layouts.app')

@section('title', 'Temporizador')

@section('content')

<h1 class="mb-4">Temporizador</h1>

<div id="mensaje-error"></div>

<div class="row">

    {{-- Columna izquierda: formulario --}}
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Crear temporizador</h4>

                <form id="form-temporizador">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Horas</label>
                        <input type="number" name="horas" id="horas" class="form-control" value="0" min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Minutos</label>
                        <input type="number" name="minutos" id="minutos" class="form-control" value="0" min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Segundos</label>
                        <input type="number" name="segundos" id="segundos" class="form-control" value="5" min="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar temporizador</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Columna derecha: lista + círculo en la misma card --}}
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">

                <div class="row align-items-start">

                    {{-- Lista con scroll --}}
                    <div class="col-md-6">
                        <h4 class="mb-3">Temporizadores guardados</h4>
                        <ul class="list-group" id="lista-temporizadores">
                            @forelse ($timers as $timer)
                                <li class="list-group-item d-flex justify-content-between align-items-center timer-item"
                                    data-id="{{ $timer->id }}"
                                    data-nombre="{{ $timer->nombre }}"
                                    data-tiempo="{{ $timer->duracion_segundos }}">
                                    <span>
                                        <strong>{{ $timer->nombre }}</strong><br>
                                        <small class="text-muted">{{ $timer->duracion_segundos }} segundos</small>
                                    </span>
                                    <button type="button"
                                        class="btn btn-danger btn-sm btn-eliminar-timer"
                                        data-id="{{ $timer->id }}">
                                        Eliminar
                                    </button>
                                </li>
                            @empty
                                <li class="list-group-item" id="sin-temporizadores">No hay temporizadores guardados.</li>
                            @endforelse
                        </ul>
                    </div>

                    {{-- Círculo siempre fijo al lado --}}
                    <div class="col-md-6 d-flex flex-column align-items-center">
                        <div id="circulo" class="timer-circle"></div>
                        <p id="tiempo-restante" class="mt-3 fw-bold text-center">Selecciona un temporizador</p>
                        <button id="btn-iniciar" class="btn btn-success mt-2" type="button">Iniciar</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

@endsection