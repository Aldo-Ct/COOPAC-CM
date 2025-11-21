@extends('layout')

@section('titulo', 'Nosotros - Cooperativa Cabanillas Mañazo Ltda.')
@section('activo-quienes', 'active')

@section('contenido')
<section class="py-5 bg-white reveal-section" id="quienes-somos">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <p class="text-uppercase text-success fw-bold small mb-2">Cooperativa de Ahorro y Crédito</p>
        <h2 class="fw-bold mb-3">Quiénes somos</h2>
        <p>Somos la Cooperativa de Ahorro y Crédito Cabanillas Mañazo Ltda., una institución financiera de carácter cooperativo que desde el 26 de agosto de 2010 brinda servicios de ahorro y crédito a las familias emprendedoras rurales de la macro región sur del Perú.</p>
        <p>Nuestra sede central se encuentra en el Jr. San Román N.° 209, distrito de Cabanillas, provincia de San Román, región Puno.</p>
        <p>Somos una persona jurídica de derecho privado, de capital variable, sin fines de lucro, de duración indefinida y responsabilidad limitada, con número ilimitado de socios, en función de nuestro patrimonio y las aportaciones suscritas y pagadas.</p>
        <p>Hoy reunimos a más de diez mil socios entre personas naturales y jurídicas, consolidándonos como una de las cooperativas líderes en microfinanzas rurales solidarias en la macro región sur del país.</p>
      </div>
      <div class="col-lg-6">
        <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow">
          <img src="/IMAGENES/INICIO3.jpg" class="img-fluid object-fit-cover" alt="Cooperativa Cabanillas Mañazo">
        </div>
      </div>
    </div>
  </div>
</section>
    <hr>

<section class="py-5 bg-light reveal-section" id="historia">
  <div class="container">
    <div class="row g-4">
      <div class="col-12 col-lg-5">
        <p class="text-uppercase text-success fw-bold small mb-2">Nuestra historia</p>
        <h2 class="fw-bold">Más de una década sembrando inclusión financiera</h2>
      </div>
      <div class="col-12 col-lg-7">
        <p>La Cooperativa de Ahorro y Crédito Cabanillas Mañazo Ltda. nace el 26 de agosto de 2010, cuando un grupo de hombres y mujeres de la zona rural altiplánica decidió organizarse bajo el modelo cooperativo para atender sus necesidades de financiamiento en actividades como la pequeña agricultura, la ganadería, la artesanía y otros emprendimientos del medio rural.</p>
        <p>Esta iniciativa surge como respuesta a la falta de inclusión financiera que afectaba a muchas familias del campo y la ciudad, convirtiéndose en una herramienta concreta para vencer la pobreza, mejorar la calidad de vida y construir una sociedad más justa, equitativa, fraterna, solidaria e inclusiva.</p>
        <p>A lo largo de estos años, la Cooperativa ha mostrado un crecimiento sostenido en número de socios, aportes, ahorros y cartera de créditos, consolidando un modelo de microfinanzas rurales que combina inclusión social, educación cooperativa y gestión responsable de los recursos.</p>
      </div>
    </div>
  </div>
</section>
    <hr>

<section class="py-5 mission-vision-section reveal-section" id="mision-vision">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-7 pe-lg-5">
        <p class="text-success text-uppercase fw-bold small mb-2">Lo que nos guía</p>
        <h2 class="fw-bold mb-3">Misión y Visión</h2>
        <p class="mb-4 text-muted">Como cooperativa, trabajamos con cercanía y compromiso para que el ahorro y el crédito lleguen a cada familia emprendedora. Nuestras metas están alineadas con el desarrollo territorial y el fortalecimiento del movimiento cooperativo.</p>
        <div class="row g-3 align-items-start">
          <div class="col-md-6">
            <div class="mv-pill bg-white border border-success-subtle rounded-4 p-4 h-100">
              <div class="icon-circle text-success mb-3"><i class="bi bi-heart-pulse"></i></div>
              <h3 class="h5 fw-bold text-success">Misión</h3>
              <p class="mb-2">“Somos el socio financiero que fomenta y fortalece el bienestar de las familias emprendedoras rurales”.</p>
              <ul class="small text-muted ps-3 mb-0">
                <li>Promoción del ahorro responsable.</li>
                <li>Créditos solidarios y oportunos.</li>
                <li>Acompañamiento educativo permanente.</li>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mv-pill bg-white border border-success-subtle rounded-4 p-4 h-100">
              <div class="icon-circle text-success mb-3"><i class="bi bi-stars"></i></div>
              <h3 class="h5 fw-bold text-success">Visión</h3>
              <p class="mb-2">“Ser una Cooperativa líder en microfinanzas rurales solidarias en la Macro región Sur del Perú”.</p>
              <ul class="small text-muted ps-3 mb-0">
                <li>Cobertura regional con enfoque rural.</li>
                <li>Innovación y transformación digital responsable.</li>
                <li>Gestión transparente y sostenible.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="mv-illustration rounded-4 shadow-sm overflow-hidden">
          <img src="/IMAGENES/INICIO1.png" class="img-fluid object-fit-cover" alt="Equipo cooperativo">
        </div>
        <div class="d-flex gap-3 mt-4">
          <div class="stat-card flex-fill">
            <h4 class="text-success fw-bold mb-0">+10k</h4>
            <p class="mb-0 small text-muted">Personas socias vinculadas</p>
          </div>
          <div class="stat-card flex-fill">
            <h4 class="text-success fw-bold mb-0">5 agencias</h4>
            <p class="mb-0 small text-muted">Presencia en la macro región sur</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <hr>

<section class="py-5 bg-light" id="valores-principios">
  <div class="container">
    <div class="text-center mb-4">
      <p class="text-success text-uppercase fw-bold small">Trabajamos con las mejores personas</p>
      <h2 class="fw-bold">Nuestros Valores</h2>
    </div>

    <div class="valores-carousel position-relative mb-5">
      <button class="valor-nav btn btn-light shadow-sm" id="valorPrev" aria-label="Anterior">
        <i class="bi bi-chevron-left"></i>
      </button>
      <div class="valores-track" id="valoresTrack">
        <div class="valor-card text-center">
          <div class="valor-icon bg-info-subtle text-info"><i class="bi bi-hand-thumbs-up-fill"></i></div>
          <h5 class="valor-title">Ayuda mutua</h5>
          <p class="valor-text">Cooperación, trabajo en equipo y apoyo recíproco entre socios.</p>
        </div>
        <div class="valor-card text-center">
          <div class="valor-icon bg-warning-subtle text-warning"><i class="bi bi-lightbulb-fill"></i></div>
          <h5 class="valor-title">Responsabilidad</h5>
          <p class="valor-text">Cumplimos nuestros compromisos con ética y disciplina.</p>
        </div>
        <div class="valor-card text-center">
          <div class="valor-icon bg-primary-subtle text-primary"><i class="bi bi-people-fill"></i></div>
          <h5 class="valor-title">Democracia</h5>
          <p class="valor-text">Participación, igualdad de oportunidades y decisiones colectivas.</p>
        </div>
        <div class="valor-card text-center">
          <div class="valor-icon bg-success-subtle text-success"><i class="bi bi-person-lines-fill"></i></div>
          <h5 class="valor-title">Igualdad</h5>
          <p class="valor-text">Mismos derechos y trato digno para todas las personas.</p>
        </div>
        <div class="valor-card text-center">
              <div class="valor-icon bg-success-subtle text-success"><i class="bi bi-emoji-smile"></i></div>
              <h5 class="valor-title">Equidad</h5>
              <p class="valor-text">Dar a cada quien lo que le corresponde, reconociendo sus condiciones.</p>
            </div>
        <div class="valor-card text-center">
          <div class="valor-icon bg-danger-subtle text-danger"><i class="bi bi-heart-fill"></i></div>
          <h5 class="valor-title">Solidaridad</h5>
          <p class="valor-text">Unidos para compartir intereses, inquietudes y necesidades.</p>
        </div>
        <div class="valor-card text-center">
          <div class="valor-icon bg-dark-subtle text-dark"><i class="bi bi-shield-check"></i></div>
          <h5 class="valor-title">Honestidad</h5>
          <p class="valor-text">Actuamos con transparencia, verdad y justicia.</p>
        </div>
        <div class="valor-card text-center">
          <div class="valor-icon bg-secondary-subtle text-secondary"><i class="bi bi-eye-fill"></i></div>
          <h5 class="valor-title">Transparencia</h5>
          <p class="valor-text">Información clara, accesible y confiable.</p>
        </div>
        <div class="valor-card text-center">
          <div class="valor-icon bg-primary-subtle text-primary"><i class="bi bi-people"></i></div>
          <h5 class="valor-title">Responsabilidad social</h5>
          <p class="valor-text">Compromiso permanente con nuestra comunidad.</p>
        </div>
      </div>
      <button class="valor-nav btn btn-light shadow-sm" id="valorNext" aria-label="Siguiente">
        <i class="bi bi-chevron-right"></i>
      </button>
    </div>

    <div class="row principios-block g-4 align-items-center">
      <div class="col-lg-5">
        <div class="principios-intro h-100 p-4 p-lg-5 rounded-4 shadow-sm reveal-section">
          <span class="badge bg-success-subtle text-success text-uppercase fw-semibold mb-3">Principios</span>
          <h3 class="fw-bold mb-3">Nuestros principios cooperativos</h3>
          <p class="mb-4 text-muted">El modelo cooperativo se basa en reglas de convivencia y gestión que garantizan la participación activa de cada socio, la transparencia y el compromiso con el desarrollo local.</p>
          <ul class="list-unstyled text-success mb-0">
            <li class="d-flex align-items-start gap-2 mb-2">
              <i class="bi bi-check2-circle"></i>
              <span>Gobernanza democrática y cercana.</span>
            </li>
            <li class="d-flex align-items-start gap-2 mb-2">
              <i class="bi bi-check2-circle"></i>
              <span>Educación financiera permanente.</span>
            </li>
            <li class="d-flex align-items-start gap-2">
              <i class="bi bi-check2-circle"></i>
              <span>Impacto directo en la comunidad.</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="row g-3 principios-grid reveal-section">
          <div class="col-sm-6">
            <div class="principio-card">
              <div class="principio-badge bg-gradient-blue"></div>
              <h5>Membresía abierta y voluntaria</h5>
              <p>Acceso para todas las personas que compartan nuestros valores.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="principio-card">
              <div class="principio-badge bg-gradient-purple"></div>
              <h5>Control democrático</h5>
              <p>Los socios participan en la toma de decisiones, con igualdad de voz.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="principio-card">
              <div class="principio-badge bg-gradient-green"></div>
              <h5>Participación económica</h5>
              <p>Los aportes y beneficios son gestionados con responsabilidad compartida.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="principio-card">
              <div class="principio-badge bg-gradient-orange"></div>
              <h5>Autonomía e independencia</h5>
              <p>Gestión propia, preservando la identidad cooperativa.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="principio-card">
              <div class="principio-badge bg-gradient-teal"></div>
              <h5>Educación e información</h5>
              <p>Formación continua para socios, colaboradores y comunidad.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="principio-card">
              <div class="principio-badge bg-gradient-gold"></div>
              <h5>Cooperación entre cooperativas</h5>
              <p>Unión estratégica con otras cooperativas para fortalecer el sector.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="principio-card">
              <div class="principio-badge bg-gradient-sun"></div>
              <h5>Compromiso con la comunidad</h5>
              <p>Las decisiones ponen en el centro al territorio y su desarrollo.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <hr>

<section class="py-5 organization-section reveal-section" id="organizacion">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-12">
        <p class="text-success text-uppercase fw-bold small mb-2">Órganos de gobierno</p>
        <h2 class="fw-bold mb-3">Nuestra organización</h2>
        <p class="text-muted mb-4">La Cooperativa cuenta con una estructura de gobierno compuesta por la Asamblea General de Delegados, el Consejo de Administración, el Consejo de Vigilancia, el Comité de Educación, el Comité Electoral y la Gerencia General, además de unidades de apoyo como Riesgos, Auditoría Interna, Sistemas, Asesoría Legal, Contabilidad, Créditos y Operaciones, entre otras.</p>
        <p class="text-muted">Esta organización permite una gestión democrática, con control interno permanente y una adecuada supervisión de los recursos de los socios, garantizando transparencia y solidez institucional.</p>
      </div>
    </div>

    <div class="row g-4 mt-2 align-items-start">
      <div class="col-lg-7">
        <div class="row g-3">
          <div class="col-md-6">
            <div class="org-feature">
              <div class="icon-circle text-success"><i class="bi bi-people-fill"></i></div>
              <div>
                <h6 class="fw-bold mb-1">Asamblea General</h6>
                <p class="small mb-0 text-muted">Delegados que representan a todos los socios y definen las líneas estratégicas.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="org-feature">
              <div class="icon-circle text-success"><i class="bi bi-shield-check"></i></div>
              <div>
                <h6 class="fw-bold mb-1">Consejo de Administración</h6>
                <p class="small mb-0 text-muted">Dirige la gestión operativa y asegura el plan institucional.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="org-feature">
              <div class="icon-circle text-success"><i class="bi bi-search"></i></div>
              <div>
                <h6 class="fw-bold mb-1">Consejo de Vigilancia</h6>
                <p class="small mb-0 text-muted">Supervisa el manejo de los recursos cooperativos y la transparencia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="org-feature">
              <div class="icon-circle text-success"><i class="bi bi-mortarboard-fill"></i></div>
              <div>
                <h6 class="fw-bold mb-1">Comités especializados</h6>
                <p class="small mb-0 text-muted">Educación, Electoral y unidades de apoyo para riesgos, auditoría y operaciones.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="org-media-grid fade-in-up">
          <div class="img-tall rounded-4 overflow-hidden shadow-sm">
            <img src="/IMAGENES/INICIO3.jpg" alt="Equipo cooperativo" class="img-fluid object-fit-cover">
          </div>
          <div class="img-small rounded-4 overflow-hidden shadow-sm">
            <img src="/IMAGENES/INICIO2.png" alt="Socios" class="img-fluid object-fit-cover">
          </div>
          <div class="org-stat-card rounded-4 shadow-sm text-center">
            <h4 class="text-success fw-bold mb-1">6+</h4>
            <p class="text-muted small mb-0">Órganos de gobierno coordinados</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-12">
        <div class="org-graph rounded-4 p-4 shadow-sm text-center">
          <h2 class="fw-bold mb-3 ">Organigrama institucional</h2>
          <img src="/IMAGENES/organigrama.png" alt="Organigrama" class="img-fluid rounded-3 organigrama-thumb" style="max-width:420px;cursor:pointer;" data-bs-toggle="modal" data-bs-target="#organigramaModal">
        </div>
      </div>
    </div>
  </div>
</section>


<div class="text-center pb-5">
  <a href="#quienes-somos" class="btn btn-outline-success">Volver al inicio de la página</a>
</div>
    <hr>

<!-- Modal Organigrama -->
<div class="modal fade" id="organigramaModal" tabindex="-1" aria-labelledby="organigramaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="fw-bold mb-3 ">Organigrama institucional</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <img src="/IMAGENES/organigrama.png" alt="Organigrama completo" class="img-fluid rounded">
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
  const slider = document.getElementById('valoresTrack');
  const cards = slider ? Array.from(slider.children) : [];
  const prev = document.getElementById('valorPrev');
  const next = document.getElementById('valorNext');
  if (!slider || !cards.length) return;

  let index = 0;
  const gap = 18;

  const getStep = () => (cards[0]?.offsetWidth || 260) + gap;

  function goTo(i) {
    const visible = Math.max(1, Math.round(slider.clientWidth / getStep()));
    const maxIndex = Math.max(cards.length - visible, 0);
    if (i > maxIndex) {
      index = 0;
    } else if (i < 0) {
      index = maxIndex;
    } else {
      index = i;
    }
    slider.scrollTo({
      left: index * getStep(),
      behavior: 'smooth'
    });
  }

  prev?.addEventListener('click', () => {
    goTo(index - 1);
    resetInterval();
  });

  next?.addEventListener('click', () => {
    goTo(index + 1);
    resetInterval();
  });

  let auto = setInterval(() => goTo(index + 1), 2500);

  function resetInterval(){
    clearInterval(auto);
    auto = setInterval(() => goTo(index + 1), 2500);
  }

  window.addEventListener('resize', () => goTo(index));
});

document.addEventListener('DOMContentLoaded', function(){
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add('show');
    });
  }, { threshold: 0.2 });

  document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
  document.querySelectorAll('.org-feature').forEach(el => observer.observe(el));
  document.querySelectorAll('.reveal-section').forEach(el => observer.observe(el));
});
</script>
@endpush
