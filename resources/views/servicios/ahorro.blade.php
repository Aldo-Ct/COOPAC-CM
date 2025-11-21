@extends('layout')

@section('titulo', 'Servicios · Ahorro y Créditos')
@section('activo-creditos', 'active')

@section('contenido')
<section class="service-hero ahorro-hero text-white">
  <div class="service-hero-overlay d-flex align-items-center">
    <div class="container text-center text-lg-start">
      <p class="text-uppercase fw-semibold small mb-2">Servicios financieros</p>
      <h1 class="display-5 fw-bold mb-3">Ahorros y créditos para tu crecimiento</h1>
      <p class="mb-4 lead">Protegemos tus depósitos y financiamos tus proyectos con soluciones hechas a la medida de nuestros socios.</p>
      <div class="hero-stats-grid mt-3">
        <div class="stat-card">
          <span class="stat-label">Socios ahorristas</span>
          <span class="stat-value">+10k</span>
        </div>
        <div class="stat-card">
          <span class="stat-label">Depósitos asegurados</span>
          <span class="stat-value">100%</span>
        </div>
        <div class="stat-card">
          <span class="stat-label">Cobertura FSDC</span>
          <span class="stat-value">S/ 300k</span>
        </div>
        <div class="stat-card">
          <span class="stat-label">Sólidos en el sur</span>
          <span class="stat-value">+13 años</span>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="service-stack py-5" id="servicios-ahorro">
  <div class="container service-stack-container">
    <div class="stack-block stack-highlight reveal-section" id="ahorros">
      <div class="row g-4 align-items-center">
        <div class="col-lg-7">
          <p class="text-uppercase text-success fw-bold small mb-2">Soluciones de ahorro</p>
          <h2 class="fw-bold mb-3">Servicios de ahorro</h2>
          <p class="text-muted">Nuestros productos de ahorro están diseñados para que los socios guarden su dinero de forma segura, rentable y flexible. Contamos con el respaldo del Fondo de Seguro de Depósitos Cooperativo, tasas competitivas y campañas permanentes para premiar tu constancia.</p>
          <div class="info-pill mt-4 fade-in-up">
            <span class="pill-label">Respaldo</span>
            <p class="mb-0">Tus depósitos se encuentran garantizados hasta el límite vigente por el Fondo de Seguro de Depósitos Cooperativos (FSDC).</p>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card ahorro-highlight shadow-sm border-0 fade-in-up">
            <div class="card-body">
              <h5 class="fw-bold text-success">Acceso digital</h5>
              <p class="text-muted mb-3">Consulta tus cuentas desde nuestros canales virtuales y recibe alertas de tus movimientos.</p>
              <h5 class="fw-bold text-success">Campañas permanentes</h5>
              <p class="text-muted mb-0">Participa en sorteos, promociones y reconocimientos especiales para ahorristas fieles.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
<hr>
    <div class="stack-divider"></div>

    <div class="stack-block stack-soft reveal-section" id="beneficios-ahorro">
      <div class="section-heading text-center mb-4">
        <p class="text-uppercase text-success fw-bold small mb-1">Beneficios del ahorro</p>
        <h3 class="fw-bold">Ventajas de ahorrar con la cooperativa</h3>
      </div>
      <div class="row g-4">
        @php
          $beneficios = [
            ['icon' => 'shield-lock', 'title' => 'Seguridad garantizada', 'text' => 'Inscritos en el Fondo de Seguro de Depósitos Cooperativos, protegiendo tu dinero hasta el límite vigente.'],
            ['icon' => 'graph-up-arrow', 'title' => 'Altas tasas de interés', 'text' => 'Mejores rendimientos de acuerdo con el plazo y el monto depositado.'],
            ['icon' => 'gift', 'title' => 'Promociones y sorteos', 'text' => 'Campañas especiales durante el año para premiar a nuestros ahorristas.'],
            ['icon' => 'arrow-up-right-circle', 'title' => 'Crecimiento sostenido', 'text' => 'Tus depósitos crecen junto a la confianza de miles de socios.'],
          ];
        @endphp
        @foreach ($beneficios as $item)
          <div class="col-md-6 col-xl-3">
            <div class="feature-card h-100 fade-in-up">
              <div class="feature-icon">
                <i class="bi bi-{{ $item['icon'] }}"></i>
              </div>
              <h5 class="fw-bold">{{ $item['title'] }}</h5>
              <p class="text-muted mb-0">{{ $item['text'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
<hr>
    <div class="stack-divider"></div>

    <div class="stack-block stack-white reveal-section" id="tipos-ahorro">
      <div class="section-heading text-center mb-5">
        <p class="text-uppercase text-success fw-bold small mb-1">Productos destacados</p>
        <h3 class="fw-bold">Ahorro que se adapta a ti</h3>
      </div>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="ahorro-card h-100 fade-in-up">
            <div class="tag text-success mb-2">Ahorro libre</div>
            <h4 class="fw-bold">Flexibilidad total</h4>
            <p>Ideal para quienes necesitan disponer de su dinero en cualquier momento.</p>
            <ul class="list-unstyled text-muted mb-0">
              <li><i class="bi bi-check2-circle text-success me-2"></i>Depósitos y retiros ilimitados.</li>
              <li><i class="bi bi-check2-circle text-success me-2"></i>Bajo monto de apertura.</li>
              <li><i class="bi bi-check2-circle text-success me-2"></i>Participación en programas de fidelización.</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="ahorro-card h-100 fade-in-up">
            <div class="tag text-success mb-2">Ahorro a plazo fijo (DPF)</div>
            <h4 class="fw-bold">Rentabilidad preferencial</h4>
            <p>Depósitos a plazo que ofrecen mejores tasas según el monto y el tiempo acordado.</p>
            <ul class="list-unstyled text-muted mb-0">
              <li><i class="bi bi-check2-circle text-success me-2"></i>Tasas diferenciadas y competitivas.</li>
              <li><i class="bi bi-check2-circle text-success me-2"></i>Compromiso de ahorro seguro.</li>
              <li><i class="bi bi-check2-circle text-success me-2"></i>Renovación automática opcional.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
<hr>
    <div class="stack-divider"></div>

    <div class="stack-block stack-soft reveal-section" id="requisitos-ahorro">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6">
          <div class="section-heading mb-3">
            <p class="text-uppercase text-success fw-bold small mb-1">Requisitos</p>
            <h3 class="fw-bold">¿Cómo abrir una cuenta de ahorro?</h3>
          </div>
          <p class="text-muted">Para acceder a nuestros servicios de ahorro debes ser socio de la COOPAC Cabanillas Mañazo y presentar:</p>
          <ul class="list-unstyled requisitos-list">
            <li><span>02 fotografías tamaño carnet.</span></li>
            <li><span>Copia del DNI vigente.</span></li>
          </ul>
        </div>
        <div class="col-lg-6">
          <div class="ficha-card shadow-sm fade-in-up rate-card">
            <div class="d-flex align-items-start justify-content-between mb-2">
              <div>
                <p class="text-uppercase text-success fw-bold small mb-1">Tarifario TEA</p>
                <h5 class="fw-bold text-dark mb-1">Personas naturales</h5>
                <p class="text-muted small mb-0">Tasas efectivas anuales para depósitos a plazo fijo.</p>
              </div>
              <div class="rate-badge text-success fw-bold small">TEA</div>
            </div>

            <div class="table-responsive rate-table mb-2">
              <table class="table align-middle mb-0">
                <thead>
                  <tr>
                    <th>Plazo</th>
                    <th>300 - 10k</th>
                    <th>Hasta 25k</th>
                    <th>Hasta 50k</th>
                    <th>Hasta 150k</th>
                    <th>Hasta 300k</th>
                    <th>+300k</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td>3 meses</td><td>3.00%</td><td>3.50%</td><td>4.00%</td><td>4.50%</td><td>5.00%</td><td>5.50%</td></tr>
                  <tr><td>6 meses</td><td>3.25%</td><td>3.75%</td><td>4.25%</td><td>4.75%</td><td>5.25%</td><td>5.75%</td></tr>
                  <tr><td>9 meses</td><td>3.75%</td><td>4.25%</td><td>4.75%</td><td>5.25%</td><td>5.75%</td><td>6.25%</td></tr>
                  <tr><td>12 meses</td><td>6.50%</td><td>7.00%</td><td>8.00%</td><td>9.00%</td><td>9.75%</td><td>10.00%</td></tr>
                  <tr><td>18 meses</td><td>7.00%</td><td>7.50%</td><td>8.50%</td><td>9.50%</td><td>9.75%</td><td>10.25%</td></tr>
                  <tr><td>24 meses</td><td>7.50%</td><td>8.00%</td><td>9.00%</td><td>10.00%</td><td>10.25%</td><td>10.50%</td></tr>
                  <tr><td>36 meses</td><td>8.00%</td><td>9.00%</td><td>9.75%</td><td>10.25%</td><td>10.50%</td><td>11.00%</td></tr>
                </tbody>
              </table>
            </div>
            <p class="text-muted small mb-0 fst-italic">* Las tasas se expresan en TEA y pueden variar según políticas vigentes.</p>
          </div>
        </div>
      </div>
    </div>
<hr>

    <div class="stack-divider"></div>

    <div class="stack-block stack-white reveal-section" id="creditos">
      <div class="section-heading text-center mb-4">
        <p class="text-uppercase text-success fw-bold small mb-1">Portafolio de crédito</p>
        <h3 class="fw-bold">Servicios de crédito</h3>
        <p class="text-muted mb-0">Financiamos actividades productivas, comerciales, de servicios y necesidades personales bajo evaluación crediticia en cumplimiento de la normativa SBS.</p>
      </div>

      <div class="credit-grid mb-5">


        <div class="credit-card fade-in-up">
          <span class="badge bg-success-subtle text-success mb-2">Créditos de consumo</span>
          <h4 class="fw-bold mb-3">Bienestar personal y familiar</h4>
          <div class="credit-pill mb-3 fade-in-up">
            <h6 class="fw-bold mb-1">Consumo no revolvente</h6>
            <p class="small mb-0">Para bienes, servicios o gastos personales que no estén ligados a una actividad empresarial.</p>
          </div>
          <div class="credit-pill fade-in-up">
            <h6 class="fw-bold mb-1">Consumo revolvente</h6>
            <p class="small mb-0">Permite reutilizar la línea de crédito conforme se amortiza la deuda.</p>
          </div>
        </div>

        <div class="credit-card fade-in-up">
          <span class="badge bg-success-subtle text-success mb-2">Créditos hipotecarios</span>
          <h4 class="fw-bold mb-3">Tu vivienda propia</h4>
          <p class="text-muted mb-0">Financiamos la adquisición, construcción, refacción, remodelación, ampliación o subdivisión de vivienda respaldada por hipoteca inscrita.</p>
        </div>

        <div class="credit-card fade-in-up">
          <span class="badge bg-success-subtle text-success mb-2">Créditos por campañas</span>
          <h4 class="fw-bold mb-3">Soluciones para cada temporada</h4>
          <p class="text-muted mb-0">Campañas como Escolaridad, Día de la Madre, Tarpuy y Navidad, con condiciones diseñadas para cada momento.</p>
        </div>
      </div>
    </div>
<hr>
    <div class="stack-divider"></div>

    <div class="stack-block stack-soft reveal-section" id="requisitos-socio">
      <div class="section-heading text-center mb-5">
        <p class="text-uppercase text-success fw-bold small mb-1">Requisitos para ser socio</p>
        <h3 class="fw-bold">Acceso a los servicios cooperativos</h3>
      </div>
      <div class="row g-4">
        <div class="col-lg-5">
          <div class="info-pill fade-in-up">
                <span class="pill-label">¿Quiénes pueden asociarse?</span>
            <ul class="list-unstyled mb-0 text-muted">
              <li><i class="bi bi-check2-circle text-success me-2"></i>Personas naturales mayores de edad con plena capacidad legal.</li>
              <li><i class="bi bi-check2-circle text-success me-2"></i>Menores representados por sus padres o tutores.</li>
              <li><i class="bi bi-check2-circle text-success me-2"></i>Personas jurídicas inscritas en SUNARP (asociaciones, entidades públicas, MYPES, cooperativas).</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="row g-4">
            <div class="col-md-6">
              <div class="requisito-card h-100 fade-in-up">
                <h5 class="fw-bold text-success mb-3">Para persona natural</h5>
                <ul class="text-muted list-unstyled mb-0">
                  <li>Capacidad legal y solvencia moral.</li>
                  <li>Pago de derechos de admisión.</li>
                  <li>Cumplir puntualmente las obligaciones.</li>
                  <li>Aceptar estatuto, reglamentos y acuerdos.</li>
                  <li>No tener impedimentos establecidos.</li>
                </ul>
              </div>
            </div>
            <div class="col-md-6">
              <div class="requisito-card h-100 fade-in-up">
                <h5 class="fw-bold text-success mb-3">Para persona jurídica</h5>
                <ul class="text-muted list-unstyled mb-0">
                  <li>Acta de constitución inscrita.</li>
                  <li>Vigencia de poder de presidente y gerente (≤15 días).</li>
                  <li>Estatuto vigente.</li>
                  <li>Acta legalizada con acuerdo de afiliación y designación de representantes.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<hr>
    <div class="stack-divider"></div>

    <div class="stack-block stack-white reveal-section" id="beneficios-socio">
      <div class="section-heading text-center mb-4">
        <p class="text-uppercase text-success fw-bold small mb-1">Beneficios de ser socio</p>
        <h3 class="fw-bold">Ventajas generales de pertenecer a la cooperativa</h3>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="beneficios-list-card fade-in-up">
            <ul class="text-muted fs-6 mb-0">
              <li>Seguridad financiera respaldada por el Fondo de Seguro de Depósitos Cooperativos.</li>
              <li>Acceso a altas tasas de interés en ahorro y créditos con condiciones preferentes.</li>
              <li>Participación democrática en asambleas y decisiones institucionales.</li>
              <li>Servicios sociales, educativos y de previsión pensados para los socios.</li>
              <li>Atención personalizada, con enfoque rural y humano.</li>
            </ul>
            <div class="mt-4 text-center">
              <a href="{{ route('simulador') }}" class="btn btn-outline-success">Simula tu crédito</a>
            </div>
          </div>
        </div>
      </div>
    </div>
<hr>
    <div class="stack-divider"></div>

    <div class="stack-block stack-soft reveal-section" id="servicios-complementarios">
      <div class="section-heading text-center mb-4">
        <p class="text-uppercase text-success fw-bold small mb-1">Servicios complementarios</p>
        <h3 class="fw-bold">Soluciones de apoyo y previsión social</h3>
      </div>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="complementario-card h-100 fade-in-up">
            <h5 class="fw-bold text-success mb-2">Fondo de Previsión Social</h5>
            <p class="text-muted">Servicio solidario que brinda apoyo económico en caso de fallecimiento del socio o su cónyuge.</p>
            <h6 class="fw-semibold">Condiciones</h6>
            <ul class="text-muted mb-3">
              <li>Pago anual de S/ 10.00.</li>
              <li>Edad máxima de afiliación: 75 años.</li>
              <li>Cuotas al día para mantener la cobertura.</li>
            </ul>
            <h6 class="fw-semibold">Objetivos</h6>
            <ul class="text-muted mb-0">
              <li>Brindar asistencia económica a socios y deudos.</li>
              <li>Fomentar la ayuda mutua y la solidaridad.</li>
              <li>Promover la cultura de previsión social.</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="complementario-card h-100 fade-in-up">
            <h5 class="fw-bold text-success mb-2">Fondo Social Cooperativo</h5>
            <p class="text-muted mb-0">Promueve actividades sociales, educativas y de bienestar. Fortalece la participación de los socios y mejora su calidad de vida apoyando programas de educación cooperativa, bienestar y recreación.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
<hr>
<section class="py-5 service-section reveal-section" id="simulador">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-7">
        <h3 class="fw-bold mb-3">Simulador de créditos</h3>
        <p class="text-muted mb-0">Calcula el monto de tu cuota estimada y conoce el plan preliminar de pagos antes de solicitar tu crédito. Ingresa tus datos y recibe una orientación inmediata.</p>
      </div>
      <div class="col-lg-5 text-lg-end">
        <a href="{{ route('simulador') }}" class="btn btn-success btn-lg shadow">Probar simulador</a>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add('show');
    });
  }, { threshold: 0.2 });

  document.querySelectorAll('#servicios-ahorro .reveal-section, #simulador.reveal-section').forEach(el => revealObserver.observe(el));

  const fadeObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add('show');
    });
  }, { threshold: 0.2 });

  document.querySelectorAll('#servicios-ahorro .fade-in-up').forEach(el => fadeObserver.observe(el));
});
</script>
@endpush
@endsection
