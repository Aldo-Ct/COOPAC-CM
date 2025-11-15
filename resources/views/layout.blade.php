<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titulo', 'Cooperativa Cabanillas Mañazo Ltda.')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          crossorigin="anonymous">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Tus estilos globales -->
    <link rel="stylesheet" href="/css/estilos.css">

  {{-- Stacks para hojas de estilo específicas de vistas --}}
  @stack('styles')

    <!-- Favicons -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  </head>

  <body class="bg-light">

    {{-- ───────── BARRA SUPERIOR NEGRA ───────── --}}
    <div class="container-fluid bg-dark text-white text-center py-2">
      <h6 class="mb-0 fw-bold">
        Cooperativa de Ahorro y Crédito Cabanillas Mañazo Ltda.
      </h6>
    </div>

    {{-- ───────── COLLAGE / BANNER INSTITUCIONAL ───────── --}}
    <div class="banner-collage"></div>

    {{-- ───────── NAVBAR PRINCIPAL ───────── --}}
    <nav class="navbar navbar-expand-lg" data-bs-theme="dark">
      <div class="navbar-bg"></div>

      <div class="container-fluid navbar-content">
        <a class="navbar-brand d-flex align-items-center" href="/">
          <img src="/IMAGENES/logo.png" width="250" alt="Logo Cooperativa">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
          aria-expanded="false" aria-label="Abrir menú">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-links-wrap">
            <li class="nav-item">
              <a class="nav-link nav-chip @yield('activo-inicio')" href="/">Inicio</a>
            </li>

            <li class="nav-item">
              <a class="nav-link nav-chip @yield('activo-noticias')" href="{{ route('noticias') }}">Noticias</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link nav-chip dropdown-toggle @yield('activo-quienes')"
                 href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Quiénes somos
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="{{ route('quienes') }}#historia">Historia</a></li>
                <li><a class="dropdown-item" href="{{ route('quienes') }}#mision-vision">Misión y Visión</a></li>
                <li><a class="dropdown-item" href="{{ route('quienes') }}#valores">Valores</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link nav-chip dropdown-toggle @yield('activo-creditos')"
                 href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Servicios
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li>
                  <a class="dropdown-item @yield('activo-simulador')" href="{{ route('simulador') }}">
                    Simulador de Créditos
                  </a>
                </li>
                <li><a class="dropdown-item" href="{{ route('servicios.ahorro') }}">Ahorro</a></li>
                <li><a class="dropdown-item" href="{{ route('servicios.creditos') }}">Créditos</a></li>
                <li><a class="dropdown-item" href="{{ route('servicios.complementarios') }}">Servicios Complementarios</a></li>
                <li><a class="dropdown-item" href="{{ route('servicios.beneficios') }}">Beneficios</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link nav-chip dropdown-toggle @yield('activo-beneficios')"
                 href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Beneficios
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Ventajas de ser socio</a></li>
                <li><a class="dropdown-item" href="#">Programas especiales</a></li>
                <li><a class="dropdown-item" href="#">Campañas</a></li>
              </ul>
            </li>
          </ul>

          <form class="d-flex ms-3 align-items-center search-wrap" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
          </form>
        </div>
      </div>
    </nav>

    {{-- ───────── BANNER WHATSAPP VERDE ───────── --}}
    <div class="w-100 p-2 text-white bg-success border border-warning rounded-0 text-center">
      <h6 class="mb-0">
        Pide tu Crédito de consumo por WhatsApp de forma rápida y segura.
        <a href="https://wa.me/51956060634" class="text-warning fw-bold text-decoration-none" target="_blank">
          Solicitar
        </a>
      </h6>
    </div>

    {{-- ───────── CONTENIDO VARIABLE DE CADA PÁGINA ───────── --}}
    @yield('contenido')

    {{-- ───────── FOOTER ───────── --}}
     <!-- FOOTER -->
    <footer class="site-footer mt-5">
      <div class="container py-5">
        <div class="row gy-4">

          <!-- Columna 1: logo + slogan -->
          <div class="col-12 col-md-4">
            <div class="d-flex align-items-start footer-brand">
              <img src="/IMAGENES/logo.png" alt="Cooperativa Cabanillas Mañazo" class="footer-logo me-3">
              <div class="text-white small">
                <h6 class="mb-1 text-white fw-semibold">Cooperativa Cabanillas Mañazo Ltda.</h6>
                <p class="mb-2 opacity-75">
                  Líder en microfinanzas rurales.
                </p>
                <span class="badge bg-success-subtle text-success-emphasis footer-badge">
                  +15 años contigo
                </span>
              </div>
            </div>
          </div>

          <!-- Columna 2: enlaces -->
          <div class="col-6 col-md-2">
            <h6 class="footer-title">Enlaces</h6>
            <ul class="list-unstyled footer-links">
              <li><a href="/">Inicio</a></li>
              <li><a href="#">Quiénes Somos</a></li>
              <li><a href="#">Créditos</a></li>
              <li><a href="#">Ahorros</a></li>
              <li><a href="#">Contáctanos</a></li>
            </ul>
          </div>

          <!-- Columna 3: contacto -->
          <div class="col-6 col-md-3">
            <h6 class="footer-title">Contáctanos</h6>
            <ul class="list-unstyled footer-contact">
              <li>
                <i class="bi bi-geo-alt-fill"></i>
                <span>Jr. San Román N° 209<br>Cabanillas - Puno</span>
              </li>
              <li>
                <i class="bi bi-telephone-fill"></i>
                <span>(+51) 000 000 000</span>
              </li>
              <li>
                <i class="bi bi-envelope-fill"></i>
                <span>informes@coopcabanillas.pe</span>
              </li>
            </ul>
          </div>

          <!-- Columna 4: redes -->
          <div class="col-12 col-md-3">
            <h6 class="footer-title">Síguenos</h6>
            <div class="d-flex flex-wrap gap-2 footer-social">
              <a class="social-circle" href="https://www.facebook.com/cabanillasmaniazo/photos?locale=es_LA" aria-label="Facebook">
                <i class="bi bi-facebook"></i>
              </a>
              <a class="social-circle" href="#" aria-label="Instagram">
                <i class="bi bi-instagram"></i>
              </a>
              <a class="social-circle" href="#" aria-label="WhatsApp">
                <i class="bi bi-whatsapp"></i>
              </a>
              <a class="social-circle" href="#" aria-label="YouTube">
                <i class="bi bi-youtube"></i>
              </a>
            </div>

            <div class="mt-3 small text-white-50 footer-cert">
              <i class="bi bi-shield-check text-warning me-1"></i>
              Supervisados por la SBS
            </div>
          </div>
        </div>
      <div class="container py-4 text-center text-white-50 small">
        © <span id="year"></span> Cooperativa Cabanillas Mañazo Ltda.
        · Todos los derechos reservados.
      </div>
      {{-- BOTÓN CENTRAL DE ACCESO PRIVADO --}}
<div class="acceso-privado">
    @guest
        <a href="{{ route('login') }}" class="btn-acceso">
            <i class="bi bi-shield-lock-fill"></i> Acceso Privado
        </a>
    @else
        <a href="{{ route('panel') }}" class="btn-acceso">
            <i class="bi bi-speedometer2"></i> Ir al Dashboard
        </a>
    @endguest
</div>

    </footer>

    {{-- BOTÓN WHATSAPP FLOTANTE (si ya lo definiste en estilos.css) --}}
    <a href="https://wa.me/51900000000"
      class="whatsapp-float"
      target="_blank"
      aria-label="Chat por WhatsApp">
      <i class="bi bi-whatsapp"></i>
    </a>

    {{-- Scripts globales --}}
    <script>
      document.getElementById('year').textContent = new Date().getFullYear();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>

    {{-- Scripts específicos de cada página si necesita --}}
  @stack('scripts')

@if(isset($anuncios_modal) && $anuncios_modal->count() > 0)
<div id="modal-comunicativo" class="modal-comunicativo-overlay" style="display: none;">
    <div class="modal-comunicativo-content">
        <button id="modal-comunicativo-close" class="modal-comunicativo-close">&times;</button>
        <div id="carouselAnuncios" class="carousel slide" data-bs-ride="carousel" @if($anuncios_modal->count() > 1) data-bs-interval="3000" @else data-bs-interval="false" @endif>
            <div class="carousel-inner">
                @foreach($anuncios_modal as $index => $anuncio)
                    <div class="carousel-item @if($index == 0) active @endif">
                        @if($anuncio->titulo)
                            <h5 class="text-center p-3">{{ $anuncio->titulo }}</h5>
                        @endif
                        <img src="{{ $anuncio->imagen_url }}" class="d-block w-100" alt="{{ $anuncio->titulo }}">
                    </div>
                @endforeach
            </div>
            @if($anuncios_modal->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselAnuncios" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselAnuncios" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-comunicativo');
    const closeModal = document.getElementById('modal-comunicativo-close');

    if (modal) {
        modal.style.display = 'flex'; // Show modal on every load

        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Close modal on overlay click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    }
});
</script>
@endif

  </body>
</html>

