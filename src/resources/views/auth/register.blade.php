@extends('layouts.app')

@section('title', 'Registro')

@section('content')

<div class="auth-container">
    <div class="auth-card auth-card-register">

        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h1>Crear cuenta</h1>
            <p>Organiza el día a día de tu hijo/a</p>
        </div>

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

            <div class="auth-section-title">Datos del padre/madre</div>

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Apellidos</label>
                <input type="text" name="apellidos" class="form-control">
            </div>

            <div class="mb-3">
                <label>Correo</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="auth-section-title">Datos del hijo/a</div>

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="child_nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Apellidos</label>
                <input type="text" name="child_apellidos" class="form-control">
            </div>

            <div class="mb-3">
                <label>Fecha de nacimiento</label>
                <input type="date" name="child_fecha_nacimiento" class="form-control">
            </div>

            <button class="auth-btn">Registrarse</button>
        </form>

        <div class="auth-link">
            <a href="{{ route('login') }}">Ya tengo cuenta</a>
        </div>

    </div>
</div>

@endsection