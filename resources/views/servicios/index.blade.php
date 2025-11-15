@extends('layout')

@section('titulo', 'Servicios')
@section('activo-creditos', 'active')

@section('contenido')
<div class="sv-hero text-white mb-4">
  <div class="sv-hero-overlay d-flex align-items-center justify-content-center flex-column p-4 text-center">
    <h2 class="fw-bold display-6 mb-1">Servicios</h2>
    <div class="sv-crumbs"><a href="{{ route('home') }}">Inicio</a> → Servicios</div>
  </div>
  </div>

<div class="container py-4">
  <p class="text-secondary">Ofrecemos productos y servicios financieros diseñados para satisfacer las necesidades de nuestros socios, promoviendo el ahorro responsable, el acceso a créditos solidarios y la protección social.</p>

  <div class="row g-4 mt-2">
    <div class="col-12 col-md-6 col-lg-3">
      <a href="{{ route('servicios.ahorro') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center">
          <div class="card-body">
            <div class="mb-2 text-success" style="font-size:2rem"><i class="bi bi-piggy-bank-fill"></i></div>
            <h3 class="h6 fw-bold text-dark">Ahorro</h3>
            <p class="small text-secondary mb-0">DPF y Ahorro Libre con tasas competitivas.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <a href="{{ route('servicios.creditos') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center">
          <div class="card-body">
            <div class="mb-2 text-success" style="font-size:2rem"><i class="bi bi-cash-coin"></i></div>
            <h3 class="h6 fw-bold text-dark">Créditos</h3>
            <p class="small text-secondary mb-0">Para micro, pequeñas y medianas empresas, consumo y vivienda.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <a href="{{ route('servicios.complementarios') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center">
          <div class="card-body">
            <div class="mb-2 text-success" style="font-size:2rem"><i class="bi bi-shield-heart"></i></div>
            <h3 class="h6 fw-bold text-dark">Complementarios</h3>
            <p class="small text-secondary mb-0">Fondo de Previsión Social y Fondo Social Cooperativo.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <a href="{{ route('servicios.beneficios') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center">
          <div class="card-body">
            <div class="mb-2 text-success" style="font-size:2rem"><i class="bi bi-stars"></i></div>
            <h3 class="h6 fw-bold text-dark">Beneficios</h3>
            <p class="small text-secondary mb-0">Ventajas de ser socio COOPAC Cabanillas Mañazo.</p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <div class="text-center mt-4">
    <a href="{{ route('simulador') }}" class="btn btn-success">Simulador de Créditos</a>
  </div>
</div>
@endsection

