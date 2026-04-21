@extends('layouts.app')

@section('title', 'Registro')

@section('content')

<h1 class="mb-4">Registro</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register.post') }}">
    @csrf

    <h2 class="mt-4">Datos del padre/madre</h2>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Correo</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <h2 class="mt-4">Datos del hijo/a</h2>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="child_nombre" class="form-control" value="{{ old('child_nombre') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="child_apellidos" class="form-control" value="{{ old('child_apellidos') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha de nacimiento</label>
        <input type="date" name="child_fecha_nacimiento" class="form-control" value="{{ old('child_fecha_nacimiento') }}">
    </div>

    <button class="btn btn-primary">Registrarse</button>
</form>

<p class="mt-3">
    <a href="{{ route('login') }}">Ya tengo cuenta</a>
</p>

@endsection