@extends('layouts.app')

@section('title', 'Contacto')

@section('content')

<div class="contacto-page container py-4">

    <section class="contacto-hero mb-5 text-center">
        <h1>Contáctanos</h1>
        <p>
            Envíanos sugerencias, dudas o comentarios para ayudarnos a mejorar OrganizaTEA.
        </p>
    </section>

    <!-- MENSAJE -->
    <div id="mensaje-contacto" class="mb-3 text-center"></div>

    <!-- FORMULARIO -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <section class="contacto-card">
                <form id="form-contacto">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Tu nombre">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" name="email" class="form-control" placeholder="tu@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comentario</label>

                        <textarea
                            name="comentario"
                            id="comentario"
                            class="form-control"
                            rows="5"
                            maxlength="1000"
                            placeholder="Escribe tu mensaje..."
                            required></textarea>

                        <small class="text-muted">
                            <span id="contador">0</span> / 1000 caracteres
                        </small>
                    </div>

                    <button type="submit" class="btn btn-organiza w-100">
                        Enviar mensaje
                    </button>

                </form>
            </section>

        </div>
    </div>

</div>

@endsection