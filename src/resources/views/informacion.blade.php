@extends('layouts.app')

@section('title', 'Información')

@section('content')

<h1 class="mb-4">Información y recursos</h1>

<div class="info-hero mb-4">
    <h3>Recursos útiles para familias</h3>
    <p>
        En esta sección puedes encontrar asociaciones relacionadas con el TEA,
        enlaces de interés, actividades orientativas y un buscador de colegios,
        centros o asociaciones por ciudad.
    </p>
</div>

<section class="info-section mb-4">
    <h4>Asociaciones TEA</h4>
    <p>
        Algunas asociaciones ofrecen información, orientación familiar y recursos para personas con TEA y sus familias.
    </p>

    <div class="info-links">
        <a href="https://sumatea.es/" target="_blank">SUMATEA - Sur Madrid TEA</a>
        <a href="https://autismomadrid.es/" target="_blank">Federación Autismo Madrid</a>
        <a href="https://autismo.org.es/" target="_blank">Autismo España</a>
        <a href="https://fespau.es/" target="_blank">FESPAU</a>
        <a href="https://aspergermadrid.eu/" target="_blank">Asperger Madrid</a>
    </div>
</section>

<section class="info-section mb-4">
    <h4>Artículos y vídeos recomendados</h4>
    <p>
        En este apartado se recopilan artículos, guías y vídeos que pueden servir de ayuda
        a las familias para conocer mejor el TEA y encontrar recursos de apoyo.
    </p>

    <div class="recursos-info-lista mb-4">

        <div class="recurso-info-item">
            <h5>¿Qué es el autismo?</h5>
            <p>Información general sobre el Trastorno del Espectro Autista.</p>
            <a href="https://autismo.org.es/el-autismo/que-es-el-autismo/" target="_blank" class="btn btn-organiza-secundario btn-sm">
                Leer artículo
            </a>
        </div>

        <div class="recurso-info-item">
            <h5>Señales tempranas del autismo</h5>
            <p>PDF informativo en español sobre señales del autismo y detección temprana.</p>
            <a href="https://www.cdc.gov/spanish/mediosdecomunicacion/pdf/ASD-Learn-the-Signs-of-Autism-Spanish.pdf" target="_blank" class="btn btn-organiza-secundario btn-sm">
                Ver PDF
            </a>
        </div>

        <div class="recurso-info-item">
            <h5>Guía práctica sobre autismo</h5>
            <p>Guía práctica con información amplia sobre autismo, diagnóstico y apoyo.</p>
            <a href="https://autismo.org.es/wp-content/uploads/2020/09/guia_practica_de_escap_para_el_autismo.pdf" target="_blank" class="btn btn-organiza-secundario btn-sm">
                Ver guía
            </a>
        </div>

    </div>

    <h5 class="mb-3">Vídeos informativos</h5>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="video-info">
                <iframe src="https://www.youtube.com/embed/OqOF5XIqcI0"
                        title="Vídeo informativo sobre TEA"
                        allowfullscreen>
                </iframe>
            </div>
            <p class="mt-2 mb-0"><strong>Serie TEA - La aventura del saber</strong></p>
        </div>

        <div class="col-md-6 mb-4">
            <div class="video-info">
                <iframe src="https://www.youtube.com/embed/anZSCyIJVEA"
                        title="Entrevista sobre trastorno del espectro autista"
                        allowfullscreen>
                </iframe>
            </div>
            <p class="mt-2 mb-0"><strong>Hablamos sobre el Trastorno del Espectro Autista</strong></p>
        </div>

        <div class="col-md-6 mb-4">
            <div class="video-info">
                <iframe src="https://www.youtube.com/embed/n5dRk0vateA"
                        title="Estrategias para familias en atención temprana"
                        allowfullscreen>
                </iframe>
            </div>
            <p class="mt-2 mb-0"><strong>Estrategias para trabajar junto a familias</strong></p>
        </div>

        <div class="col-md-6 mb-4">
            <div class="video-info">
                <iframe src="https://www.youtube.com/embed/KOsoBC2L3IU"
                        title="Qué es el autismo"
                        allowfullscreen>
                </iframe>
            </div>
            <p class="mt-2 mb-0"><strong>¿Qué es el autismo?</strong></p>
        </div>
    </div>
</section>

<section class="info-section mb-4">
    <h4>Buscador de colegios y centros</h4>
    <p>
        Busca colegios, centros educativos, asociaciones o recursos relacionados con el TEA
        introduciendo una palabra clave y una ciudad.
    </p>

    <div class="row">
        <div class="col-md-5 mb-3">
            <label class="form-label">Qué quieres buscar</label>
            <input type="text" id="busqueda-recurso" class="form-control" value="colegio educación especial">
        </div>

        <div class="col-md-5 mb-3">
            <label class="form-label">Ciudad o zona</label>
            <input type="text" id="busqueda-ciudad" class="form-control" value="Madrid">
        </div>

        <div class="col-md-2 mb-3 d-flex align-items-end">
            <button type="button" id="btn-buscar-recursos" class="btn btn-primary w-100">
                Buscar
            </button>
        </div>
    </div>

    <div id="mensaje-recursos" class="mt-3"></div>
    <div id="resultados-recursos" class="mt-3"></div>
</section>

@endsection