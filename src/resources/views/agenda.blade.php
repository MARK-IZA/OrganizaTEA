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

<div class="mb-3">
    <label for="color-agenda" class="form-label"><strong>Color de la actividad:</strong></label>
    <input type="color" id="color-agenda" value="#3c8dbc">
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
                            style="background-color: {{ $celdaGuardada->color ?? '' }};">
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