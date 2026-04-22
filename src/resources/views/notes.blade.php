@extends('layouts.app')

@section('title', 'Notas')

@section('content')

<h1 class="mb-4">Notas / Observaciones</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('notes.store') }}">
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

<div class="row">
    @if (count($notes) > 0)
        @foreach ($notes as $note)
            <div class="col-md-3 mb-4">
                <div class="note-card">
                    <h5>{{ $note->titulo }}</h5>
                    <p><strong>Fecha:</strong> {{ $note->fecha }}</p>
                    <p>{{ $note->descripcion }}</p>

                    <form method="POST" action="{{ route('notes.destroy', $note->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta nota?')">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p>No hay notas guardadas.</p>
    @endif
</div>

@endsection