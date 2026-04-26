@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="auth-container">
    <div class="auth-card">

        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h1>OrganizaTEA</h1>
            <p>Accede a tu cuenta</p>
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

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label>Correo</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="auth-btn">Entrar</button>
        </form>

        <div class="auth-link">
            <a href="{{ route('register') }}">Crear cuenta</a>
        </div>

    </div>
</div>

@endsection