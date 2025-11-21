@extends('layout')

@section('titulo', 'Transparencia Institucional')

@section('contenido')
<section class="hero-transparencia text-white py-5">
  <div class="container">
    <p class="text-uppercase fw-semibold small mb-2">rendición de cuentas</p>
    <h1 class="display-6 fw-bold mb-3">Transparencia Institucional</h1>
    <p class="lead mb-0">En la COOPAC Cabanillas–Mañazo creemos que la confianza se construye con información clara y accesible. Por eso ponemos a disposición de nuestros socios y del público nuestros estados financieros, memorias anuales y documentos normativos.</p>
  </div>
</section>
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      @php
        $documentos = [
          [
            'titulo' => 'Estados Financieros',
            'descripcion' => 'Consulta nuestros estados financieros oficiales, con detalle de resultados, activos, pasivos y principales indicadores.',
            'link' => 'https://drive.google.com/drive/folders/14L_5el4MFwHM5Ui4_m2LZrHUAZeAgl-b?usp=drive_link'
          ],
          [
            'titulo' => 'Memorias Anuales 2020–2024',
            'descripcion' => 'Memorias de gestión anual: crecimiento de socios, aportes, ahorros, créditos e impacto social.',
            'link' => 'https://drive.google.com/drive/folders/1_oWxuhqOLv1jHKFopgN0oyDyYTDeYXME?usp=drive_link'
          ],
          [
            'titulo' => 'Documentos Normativos',
            'descripcion' => 'Estatuto, reglamentos y políticas internas que rigen la cooperativa.',
            'link' => 'https://drive.google.com/drive/folders/18xSNKS1TBC_JqH7FSqB0YwV_ezkoX-vS?usp=drive_link'
          ],
        ];
      @endphp
      @foreach ($documentos as $item)
        <div class="col-12 col-md-4">
          <div class="card h-100 shadow-sm border-0 transparencia-card">
            <div class="card-body d-flex flex-column">
              <h4 class="fw-bold text-success mb-3">{{ $item['titulo'] }}</h4>
              <p class="text-muted flex-grow-1">{{ $item['descripcion'] }}</p>
              <a class="btn btn-success mt-3" href="{{ $item['link'] }}" target="_blank" rel="noopener">
                Ver {{ $item['titulo'] }}
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="pb-5">
  <div class="container">
    <div class="card border-0 shadow-sm confianza-card">
      <div class="card-body text-center">
        <p class="mb-0 fw-semibold text-success">La cooperativa está inscrita en el Fondo de Seguro de Depósitos Cooperativo (FSDC), con cobertura de hasta S/ 5,000.00 para proteger los ahorros de los socios.</p>
      </div>
    </div>
  </div>
</section>
@endsection
