@extends('layout')

@section('titulo', 'Cooperativa Cabanillas Mañazo Ltda.')

@section('activo-inicio', 'active')

@section('contenido')

    <!-- SECCIÓN HERO: descripción + carrusel -->
    <section id="nosotros" class="py-5 bg-light">
      <div class="container">
        <div class="row align-items-center g-4">

          <!-- Columna izquierda: texto institucional -->
          <div class="col-lg-5">
            <h2 class="fw-bold text-success mb-3">
              Cooperativa Cabanillas Mañazo Ltda.
            </h2>

            <h5 class="fw-semibold text-dark lh-base">
              Más que una entidad financiera,
              <span class="text-success">somos parte de tu historia.</span>
            </h5>

            <p class="text-muted mt-3">
              Creemos en el esfuerzo de las familias emprendedoras del altiplano.
              Desde hace más de 15 años impulsamos sueños, brindamos créditos accesibles y cuidamos tus ahorros con transparencia y compromiso.
              Aquí, tu confianza es nuestra mayor riqueza.
            </p>

            <ul class="list-unstyled mt-3 mb-4 text-muted small">
              <li class="d-flex align-items-start mb-2">
                <span class="text-success me-2">✔</span>
                <span>Atención cercana y humana.</span>
              </li>
              <li class="d-flex align-items-start mb-2">
                <span class="text-success me-2">✔</span>
                <span>Créditos con respuesta rápida.</span>
              </li>
              <li class="d-flex align-items-start mb-2">
                <span class="text-success me-2">✔</span>
                <span>Ahorro seguro y rentable.</span>
              </li>
              <li class="d-flex align-items-start mb-2">
                <span class="text-success me-2">✔</span>
                <span>Orgullosamente locales: Cabanillas y Mañazo.</span>
              </li>
            </ul>

            <a href="{{ route('simulador') }}" class="btn btn-success fw-semibold px-4 py-2">
              Simula tu crédito
            </a>
          </div>

          <!-- Columna derecha: carrusel -->
          <div class="col-lg-7">
            <div id="carouselHero" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselHero" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselHero" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselHero" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/IMAGENES/INICIO1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/IMAGENES/INICIO2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/IMAGENES/INICIO3.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- /SECCIÓN HERO -->

    <section class="py-5 bg-white" id="cooperativa">
      <div class="container text-center">
        <h2 class="fw-bold text-success mb-2">COOPAC CABANILLAS MAÑAZO</h2>
        <h3 class="fw-semibold text-dark mb-3">Más que una cooperativa, una familia que crece contigo.</h3>

        <p class="text-muted mx-auto" style="max-width: 800px;">
          En la <strong>Cooperativa Cabanillas Mañazo</strong> creemos que el verdadero desarrollo se construye con
          <span class="text-success fw-semibold">confianza, solidaridad y compromiso</span>.
          Acompañamos a nuestros socios en cada paso de sus proyectos personales, familiares y empresariales,
          brindando herramientas financieras que transforman sueños en realidades.
        </p>

        <p class="text-muted mx-auto mt-3" style="max-width: 800px;">
          Con presencia en diversas provincias de <strong>Puno</strong>, somos parte activa del crecimiento de nuestra región
          y de las historias que, día a día, nos inspiran a seguir sirviendo con transparencia, cercanía y orgullo local.
        </p>

        <div class="mt-4">
          <a href="#novedades" class="btn btn-success px-4 py-2 fw-semibold">
            Conoce más sobre nosotros
          </a>
        </div>
      </div>
    </section>

    <hr>

    <!-- SECCIÓN DE RESPALDO INSTITUCIONAL (SBS) -->
    <section id="respaldo" class="text-center py-5">
      <div class="container">
        <h2 class="fw-bold mb-3" style="color:#0d5a28;">Respaldo Institucional</h2>
        <p class="text-muted mb-5">
          Regulación, clasificación y supervisión de la <strong>Cooperativa Cabanillas Mañazo Ltda.</strong>
        </p>

        <div id="carouselSBS" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <!-- SLIDE 1 -->
            <div class="carousel-item active">
              <div class="row justify-content-center g-4">
                <!-- Card 1 -->
                <div class="col-md-6">
                  <div class="coop-card h-100">
                    <div class="coop-card-img">
                      <img src="/IMAGENES/SBS_logo.png" alt="Logo SBS" class="coop-card-img-logo">
                    </div>
                    <div class="p-4">
                      <h5>Supervisados por la SBS</h5>
                      <p>
                        La <strong>Cooperativa Cabanillas Mañazo Ltda.</strong> está autorizada y supervisada
                        por la <strong>Superintendencia de Banca, Seguros y AFP (SBS)</strong>, garantizando transparencia,
                        respaldo y cumplimiento normativo.
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6">
                  <div class="coop-card h-100">
                    <div class="coop-card-img">
                      <img src="/IMAGENES/confianza.png" alt="Normas IFRS" class="coop-card-img-logo">
                    </div>
                    <div class="p-4">
                      <h5>Normas Contables Internacionales</h5>
                      <p>
                        Aplicamos las <strong>Normas Internacionales de Información Financiera (IFRS)</strong> para asegurar
                        la calidad, confiabilidad y transparencia de nuestros estados financieros.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- SLIDE 2 -->
            <div class="carousel-item">
              <div class="row justify-content-center g-4">
                <!-- Card 3 -->
                <div class="col-md-6">
                  <div class="coop-card h-100">
                    <div class="coop-card-img">
                      <img src="/IMAGENES/fenacrep.png" alt="Logo Fenacrep" class="coop-card-img-logo">
                    </div>
                    <div class="p-4">
                      <h5>Miembro de FENACREP</h5>
                      <p>
                        Formamos parte de la <strong>Federación Nacional de Cooperativas de Ahorro y Crédito del Perú (FENACREP)</strong>,
                        que promueve la integración y fortalecimiento del sistema cooperativo.
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-6">
                  <div class="coop-card h-100">
                    <div class="coop-card-img">
                      <img src="/IMAGENES/calidad.png" alt="Sistema Financiero" class="coop-card-img-logo">
                    </div>
                    <div class="p-4">
                      <h5>Parte del Sistema Financiero</h5>
                      <p>
                        Somos parte activa del <strong>Sistema Financiero Peruano</strong>, operando bajo estándares
                        de gestión, control y gobierno corporativo establecidos por la SBS.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- SLIDE 3 -->
            <div class="carousel-item">
              <div class="row justify-content-center g-4">
                <!-- Card 5 -->
                <div class="col-md-6">
                  <div class="coop-card h-100">
                    <div class="coop-card-img">
                      <img src="/IMAGENES/auditoria.png" alt="Auditoría Externa" class="coop-card-img-logo">
                    </div>
                    <div class="p-4">
                      <h5>Auditorías Externas Independientes</h5>
                      <p>
                        Nuestras operaciones son evaluadas anualmente por <strong>firmas auditoras certificadas</strong>,
                        garantizando transparencia en el manejo de los fondos de nuestros socios.
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Card 6 -->
                <div class="col-md-6">
                  <div class="coop-card h-100">
                    <div class="coop-card-img">
                      <img src="/IMAGENES/confianza.png" alt="Respaldo y Confianza" class="coop-card-img-logo">
                    </div>
                    <div class="p-4">
                      <h5>Compromiso y Confianza</h5>
                      <p>
                        Con más de <strong>15 años de trayectoria</strong>, reafirmamos nuestro compromiso con la
                        comunidad brindando servicios financieros responsables y sostenibles.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Controles carrusel -->
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselSBS" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>

          <button class="carousel-control-next" type="button" data-bs-target="#carouselSBS" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
          </button>
        </div>
      </div>
    </section>

    <hr>

    <!-- PORTAL DE TRANSPARENCIA -->
    <section id="transparencia" class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3" style="color:#0d5a28;">Portal de Transparencia</h2>
                    <p class="text-muted mb-4">
                        Comprometidos con la claridad y el acceso a la información.
                    </p>
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <img src="/IMAGENES/SBS_logo.png" alt="Logo SBS" style="height: 50px;" class="mb-3">
                            <h5 class="card-title fw-semibold">Información Financiera y de Mercado</h5>
                            <p class="card-text text-muted">
                                Como entidad supervisada, nuestra información está disponible públicamente en el portal de la Superintendencia de Banca, Seguros y AFP (SBS). Consulta nuestros estados financieros, indicadores y más.
                            </p>
                            <a href="https://www.sbs.gob.pe/" target="_blank" rel="noopener noreferrer" class="btn btn-success fw-semibold px-4 py-2">
                                Visitar portal de la SBS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

@endsection
