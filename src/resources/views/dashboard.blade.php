@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 class="mb-4">Bienvenido, {{ $user->name }}</h1>

<div class="card mb-3">
    <div class="card-body">
        <p><strong>Correo:</strong> {{ $user->email }}</p>
        <p><strong>Apellidos:</strong> {{ $user->apellidos }}</p>
    </div>
</div>

<h2 class="mt-4">Hijos asociados</h2>

@if ($user->children->isEmpty())
    <p>No hay hijos registrados.</p>
@else
    <ul class="list-group mb-3">
        @foreach ($user->children as $child)
            <li class="list-group-item">
                {{ $child->nombre }} {{ $child->apellidos }} - {{ $child->fecha_nacimiento }}
            </li>
        @endforeach
    </ul>
@endif

@endsection