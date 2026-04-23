@extends('layouts.app')

@section('title', 'Agenda semanal')

@section('content')

<h1 class="mb-4">Agenda semanal</h1>

@if ($user && $user->children->count() > 0)
    <div class="alert alert-info">
        <strong>Niño/a:</strong>
        {{ $user->children->first()->nombre }} {{ $user->children->first()->apellidos }}
    </div>
@endif

<div class="agenda-controles mb-4">
    <div class="agenda-colores-bloque">
        <label class="form-label mb-2"><strong>Color:</strong></label>
        <div class="agenda-paleta">
            <button type="button" class="color-btn" data-color="#ffffff" style="background-color:#ffffff;" title="Sin color"></button>
            <button type="button" class="color-btn" data-color="#3c8dbc" style="background-color:#3c8dbc;" title="Azul"></button>
            <button type="button" class="color-btn" data-color="#63c7b2" style="background-color:#63c7b2;" title="Verde agua"></button>
            <button type="button" class="color-btn" data-color="#ffd166" style="background-color:#ffd166;" title="Amarillo"></button>
            <button type="button" class="color-btn" data-color="#f4978e" style="background-color:#f4978e;" title="Rosa suave"></button>
            <button type="button" class="color-btn" data-color="#cdb4db" style="background-color:#cdb4db;" title="Lila"></button>
            <button type="button" class="color-btn" data-color="#a8dadc" style="background-color:#a8dadc;" title="Turquesa claro"></button>
            <button type="button" class="color-btn" data-color="#bde0fe" style="background-color:#bde0fe;" title="Azul claro"></button>
            <button type="button" class="color-btn" data-color="#d9ed92" style="background-color:#d9ed92;" title="Verde suave"></button>
            <button type="button" class="color-btn" data-color="#ffdab9" style="background-color:#ffdab9;" title="Melocotón"></button>
            <button type="button" class="color-btn" data-color="#e9c46a" style="background-color:#e9c46a;" title="Mostaza suave"></button>
            <button type="button" class="color-btn" data-color="#b8c0ff" style="background-color:#b8c0ff;" title="Lavanda azul"></button>
        </div>
    </div>

    <div class="agenda-botones-bloque">
        <button type="button" id="btn-guardar-agenda" class="btn btn-primary">Guardar cambios</button>
        <button type="button" id="btn-limpiar-celda" class="btn btn-outline-danger">Limpiar celda</button>
    </div>

    <div class="agenda-celda-seleccionada">
        <strong>Celda seleccionada:</strong>
        <span id="celda-seleccionada-texto">Ninguna</span>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered agenda-table align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>Hora</th>
                @foreach ($dias as $dia)
                    <th>{{ $dia }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($horas as $index => $hora)
                <tr>
                    <td class="hora fw-bold bg-light">{{ $hora }}</td>

                    @foreach ($dias as $dia)
                        @php
                            $celdaGuardada = $celdas
                                ->where('dia_semana', $dia)
                                ->where('hora_inicio', $hora . ':00')
                                ->first();
                        @endphp

                        <td contenteditable="true"
                            class="celda-agenda"
                            data-dia="{{ $dia }}"
                            data-hora="{{ $hora }}:00"
                            data-fila="{{ $index + 1 }}"
                            style="background-color: {{ $celdaGuardada->color ?? '#ffffff' }};">
                            {{ $celdaGuardada->contenido ?? '' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="mensaje-agenda" class="mt-3"></div>

@endsection