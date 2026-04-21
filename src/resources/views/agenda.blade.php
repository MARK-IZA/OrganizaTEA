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
            @foreach ($horas as $hora)
                <tr>
                    <td class="hora fw-bold bg-light">{{ $hora }}</td>
                    @foreach ($dias as $dia)
                        <td contenteditable="true"></td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection