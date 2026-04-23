@extends('layouts.app')

@section('title', 'Login')

@section('content')

<h1 class="mb-4">Iniciar sesión</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Correo</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-primary">Entrar</button>
</form>

<p class="mt-3">
    <a href="{{ route('register') }}">Crear cuenta</a>
</p>

@endsection