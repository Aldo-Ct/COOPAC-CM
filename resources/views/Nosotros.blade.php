@extends('layout')

@section('titulo', 'Quiénes Somos - Cooperativa Cabanillas Mañazo Ltda.')
@section('activo-quienes', 'active')

@section('contenido')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <nav class="mb-4">
        <ul class="nav nav-pills gap-2 justify-content-center">
          <li class="nav-item"><a class="btn btn-outline-success" href="#historia">Historia</a></li>
          <li class="nav-item"><a class="btn btn-outline-success" href="#mision-vision">Misión y Visión</a></li>
          <li class="nav-item"><a class="btn btn-outline-success" href="#valores">Valores</a></li>
        </ul>
      </nav>

      <section id="historia" class="mb-5">
        <div class="history-hero text-white text-center rounded-3 px-4 py-5 mb-4">
          <h2 class="fw-bold text-uppercase mb-2">Nuestra Historia</h2>
          <p class="mb-0 small">
            Nacimos para impulsar el bienestar de las familias emprendedoras rurales. Estos son algunos hitos que nos definen.
          </p>
        </div>

        <h3 class="text-center fw-bold text-danger mb-3">Línea de tiempo</h3>

        <div class="timeline-wrap">
          <div class="timeline-card active" data-year="2010">
            <div class="row g-3 align-items-center">
              <div class="col-12 col-md-4 text-center">
                <img src="/IMAGENES/INICIO1.png" class="img-fluid rounded shadow-sm" alt="2010 - Fundación">
              </div>
              <div class="col-12 col-md-8">
                <h4 class="timeline-year">2010</h4>
                <ul class="mb-0">
                  <li><strong>26 de agosto:</strong> Se constituye la Cooperativa de Ahorro y Crédito Cabanillas - Mañazo Ltda.</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="timeline-card" data-year="2019">
            <div class="row g-3 align-items-center">
              <div class="col-12 col-md-4 text-center">
                <img src="/IMAGENES/INICIO2.png" class="img-fluid rounded shadow-sm" alt="2019 - Registro SBS">
              </div>
              <div class="col-12 col-md-8">
                <h4 class="timeline-year">2019</h4>
                <ul class="mb-0">
                  <li><strong>01 de marzo:</strong> La SBS autoriza nuestra inscripción en el Registro de la SACOOP (Oficio N° 8351-2019-SBS).</li>
                  <li>Se nos asigna el Registro <strong>N° 180-2019-REG.COOPAC-SBS</strong> y el <strong>Nivel N° 2</strong> del Esquema Modular.</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="timeline-card" data-year="actualidad">
            <div class="row g-3 align-items-center">
              <div class="col-12 col-md-4 text-center">
                <img src="/IMAGENES/INICIO3.jpg" class="img-fluid rounded shadow-sm" alt="Actualidad">
              </div>
              <div class="col-12 col-md-8">
                <h4 class="timeline-year">Actualidad</h4>
                <ul class="mb-0">
                  <li>Seguimos fortaleciendo el acceso al crédito y el ahorro en nuestra comunidad, con enfoque en familias y emprendimientos rurales.</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="timeline-nav mt-4">
            <button class="t-dot active" data-target="2010">2010</button>
            <button class="t-dot" data-target="2019">2019</button>
            <button class="t-dot" data-target="actualidad">Actualidad</button>
          </div>

          <div class="timeline-axis mt-3">
            <span class="tick active">2010</span>
            <span class="tick">2019</span>
            <span class="tick">Actualidad</span>
          </div>
        </div>
      </section>

      <hr>

      <section id="mision-vision" class="mb-5">
        <div class="mv-hero text-white text-center rounded-3 mb-4">
          <div class="mv-hero-overlay d-flex align-items-center justify-content-center flex-column p-5">
            <h2 class="display-5 fw-bold mb-2">Visión y Misión</h2>
            <div class="small opacity-75">Home → ¿Quiénes somos? → Visión y Misión</div>
          </div>
        </div>

        <div class="row g-4 align-items-start">
          <div class="col-12 col-lg-6">
            <h3 class="h4 fw-bold text-primary mb-2">Nuestra visión</h3>
            <div class="text-secondary fs-6">“Ser una Cooperativa líder en microfinanzas rurales solidarias en la Macro región Sur del Perú”.</div>
          </div>
          <div class="col-12 col-lg-6">
            <h3 class="h4 fw-bold text-primary mb-2">Nuestra misión</h3>
            <div class="text-secondary fs-6">Somos el socio financiero que fomenta y fortalece el bienestar de las familias emprendedoras rurales,
              acercando soluciones simples y transparentes de ahorro y crédito para impulsar sus metas.</div>
          </div>
        </div>
      </section>

      <hr>

      <section id="valores" class="mb-5">
        <div class="text-center mb-3">
          <div class="text-uppercase small text-success fw-semibold">Trabajamos con las mejores personas</div>
          <h2 class="fw-bold" style="letter-spacing:.5px;">Nuestros Valores</h2>
        </div>

        <div class="valores-carousel position-relative">
          <button class="valor-nav btn btn-light shadow-sm" id="valorPrev" aria-label="Anterior">
            <i class="bi bi-chevron-left"></i>
          </button>

          <div class="valores-track" id="valoresTrack">
            <div class="valor-card">
              <div class="valor-icon bg-info-subtle text-info"><i class="bi bi-hand-thumbs-up-fill"></i></div>
              <h5 class="valor-title">Ayuda Mutua</h5>
              <p class="valor-text">Cooperación, reciprocidad y trabajo en equipo entre Colaboradores y Socios para un beneficio mutuo.</p>
            </div>
            <div class="valor-card">
              <div class="valor-icon bg-warning-subtle text-warning"><i class="bi bi-shield-lock-fill"></i></div>
              <h5 class="valor-title">Responsabilidad</h5>
              <p class="valor-text">Actuar con cumplimiento del deber en todos los sentidos.</p>
            </div>
            <div class="valor-card">
              <div class="valor-icon bg-primary-subtle text-primary"><i class="bi bi-people-fill"></i></div>
              <h5 class="valor-title">Democracia</h5>
              <p class="valor-text">Respeto, igualdad de oportunidades, transparencia y participación democrática.</p>
            </div>
            <div class="valor-card">
              <div class="valor-icon bg-success-subtle text-success"><i class="bi bi-people"></i></div>
              <h5 class="valor-title">Igualdad</h5>
              <p class="valor-text">Mismos derechos y trato digno para todas las personas.</p>
            </div>
            <div class="valor-card">
              <div class="valor-icon bg-success-subtle text-success"><i class="bi bi-emoji-smile"></i></div>
              <h5 class="valor-title">Equidad</h5>
              <p class="valor-text">Dar a cada quien lo que le corresponde, reconociendo sus condiciones.</p>
            </div>
            <div class="valor-card">
              <div class="valor-icon bg-danger-subtle text-danger"><i class="bi bi-heart-fill"></i></div>
              <h5 class="valor-title">Solidaridad</h5>
              <p class="valor-text">Unidos para compartir intereses, inquietudes y necesidades.</p>
            </div>
            <div class="valor-card">
              <div class="valor-icon bg-dark-subtle text-dark"><i class="bi bi-check2-circle"></i></div>
              <h5 class="valor-title">Honestidad</h5>
              <p class="valor-text">Actuar conforme a la verdad, la justicia y la razón.</p>
            </div>
            <div class="valor-card">
              <div class="valor-icon bg-info-subtle text-info"><i class="bi bi-eye-fill"></i></div>
              <h5 class="valor-title">Transparencia</h5>
              <p class="valor-text">Información clara y comprensible, sin adornos que generen duda.</p>
            </div>
          </div>

          <button class="valor-nav btn btn-light shadow-sm" id="valorNext" aria-label="Siguiente">
            <i class="bi bi-chevron-right"></i>
          </button>

          <div class="valores-dots text-center mt-3" id="valoresDots"></div>
        </div>
      </section>

      <div class="mt-4 text-center">
        <a href="#historia" class="btn btn-outline-success">Volver arriba</a>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<!-- estilos movidos a public/css/estilos.css -->
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function(){
    const cards = Array.from(document.querySelectorAll('.timeline-card'));
    const dots  = Array.from(document.querySelectorAll('.timeline-nav .t-dot'));
    const ticks = Array.from(document.querySelectorAll('.timeline-axis .tick'));

    function showYear(year){
      cards.forEach(c => c.classList.toggle('active', c.dataset.year === year));
      dots.forEach(d => d.classList.toggle('active', d.dataset.target === year));
      const idx = dots.findIndex(d => d.dataset.target === year);
      ticks.forEach((t, i) => t.classList.toggle('active', i === idx));
    }
    dots.forEach(btn => btn.addEventListener('click', () => showYear(btn.dataset.target)));
  });

  document.addEventListener('DOMContentLoaded', function(){
    const track = document.getElementById('valoresTrack');
    const prev  = document.getElementById('valorPrev');
    const next  = document.getElementById('valorNext');
    const dotsC = document.getElementById('valoresDots');
    if (!track) return;
    const cards = Array.from(track.children);
    const perView = () => Math.max(1, Math.floor(track.clientWidth / cards[0].clientWidth));
    const totalPages = () => Math.max(1, Math.ceil(cards.length / perView()));
    let page = 0;
    function updateDots() {
      const pages = totalPages();
      dotsC.innerHTML = '';
      for (let i = 0; i < pages; i++) {
        const d = document.createElement('span');
        d.style.cssText = 'display:inline-block;width:8px;height:8px;border-radius:999px;margin:0 4px;background:'+(i===page?'#0d5a28':'#cbd5e1');
        d.addEventListener('click', () => goTo(i));
        dotsC.appendChild(d);
      }
    }
    function goTo(p){
      page = Math.max(0, Math.min(p, totalPages()-1));
      const x = page * track.clientWidth;
      track.scrollTo({ left: x, behavior: 'smooth' });
      updateDots();
    }
    prev?.addEventListener('click', () => goTo(page-1));
    next?.addEventListener('click', () => goTo(page+1));
    window.addEventListener('resize', updateDots);
    updateDots();
  });
</script>
@endpush

