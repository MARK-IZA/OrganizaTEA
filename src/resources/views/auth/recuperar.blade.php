@extends('layouts.app')

@section('title', 'Recuperar contraseña')

@section('content')

<div class="auth-container">
    <div class="auth-card">

        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h1>OrganizaTEA</h1>
            <p>Restablece tu contraseña</p>
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

        <form method="POST" action="{{ route('recuperar.post') }}">
            @csrf

            <div class="mb-3">
                <label>Correo de tu cuenta</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label>Nueva contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirmar nueva contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="auth-btn">Restablecer contraseña</button>
        </form>

        <div class="auth-link">
            <a href="{{ route('login') }}">Volver al login</a>
        </div>

    </div>
</div>

@endsection