@extends('layouts.app')

@section('title', 'Notas')

@section('content')

<h1 class="mb-4">Notas / Observaciones</h1>

<div id="mensaje-notas" class="mb-3"></div>

<div class="card mb-4">
    <div class="card-body">
        <form id="form-nota">
            @csrf

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Añadir nota</button>
        </form>
    </div>
</div>

<div class="row" id="lista-notas">
    @if (count($notes) > 0)
        @foreach ($notes as $note)
            <div class="col-md-4 mb-4 nota-item"
                 data-id="{{ $note->id }}"
                 data-titulo="{{ $note->titulo }}"
                 data-fecha="{{ $note->fecha }}"
                 data-descripcion="{{ $note->descripcion }}">
                <div class="note-card">
                    <h5 class="nota-titulo">{{ $note->titulo }}</h5>
                    <p><strong>Fecha:</strong> <span class="nota-fecha">{{ $note->fecha ?? 'Sin fecha' }}</span></p>
                    <p class="nota-descripcion">{{ $note->descripcion }}</p>

                    <div class="note-actions">
                        <button type="button"
                                class="btn btn-warning btn-sm btn-editar-nota"
                                data-id="{{ $note->id }}">
                            Editar
                        </button>

                        <button type="button"
                                class="btn btn-danger btn-sm btn-eliminar-nota"
                                data-id="{{ $note->id }}">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p id="sin-notas">No hay notas guardadas.</p>
    @endif
</div>

@endsection