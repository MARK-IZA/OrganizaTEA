@extends('layouts.app')

@section('title', 'Temporizador')

@section('content')

<h1 class="mb-4">Temporizador</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-5">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="mb-3">Crear temporizador</h4>

                <form method="POST" action="{{ route('temporizador.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Horas</label>
                        <input type="number" name="horas" class="form-control" value="{{ old('horas', 0) }}" min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Minutos</label>
                        <input type="number" name="minutos" class="form-control" value="{{ old('minutos', 0) }}" min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Segundos</label>
                        <input type="number" name="segundos" class="form-control" value="{{ old('segundos', 5) }}" min="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar temporizador</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="mb-3">Temporizadores guardados</h4>

            @if (count($timers) > 0)
    <ul class="list-group">
        @foreach ($timers as $timer)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $timer->nombre }}</strong> - {{ $timer->duracion_segundos }} segundos
                </span>

                <form method="POST" action="{{ route('temporizador.destroy', $timer->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este temporizador?')">
                        Eliminar
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>No hay temporizadores guardados.</p>
@endif
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="timer-circle"></div>
        </div>
    </div>
</div>

@endsection