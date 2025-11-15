@extends('layout')

@section('titulo', 'Servicios · Complementarios')
@section('activo-creditos', 'active')

@section('contenido')
<div class="sv-hero text-white mb-4">
  <div class="sv-hero-overlay d-flex align-items-center justify-content-center flex-column p-4 text-center">
    <h2 class="fw-bold display-6 mb-1">Servicios Complementarios</h2>
    <div class="sv-crumbs"><a href="{{ route('home') }}">Inicio</a> → Servicios → Complementarios</div>
  </div>
</div>

<div class="container py-4">
  <h1 class="fw-bold text-success mb-3">Servicios Complementarios y/o No Financieros</h1>

  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
      <h3 class="h5 fw-bold">Fondo de Previsión Social</h3>
      <p class="text-secondary">Servicio solidario que brinda apoyo económico en caso de fallecimiento del socio o su cónyuge.</p>
      <h6 class="fw-semibold">Condiciones</h6>
      <ul class="text-secondary">
        <li>Pago anual de S/ 10.00.</li>
        <li>Edad máxima de afiliación: 75 años.</li>
        <li>Mantenerse al día con el pago de cuotas anuales.</li>
      </ul>
      <h6 class="fw-semibold">Objetivos</h6>
      <ul class="text-secondary mb-0">
        <li>Brindar asistencia económica a socios y deudos.</li>
        <li>Fomentar la ayuda mutua y la solidaridad entre asociados.</li>
        <li>Promover la cultura de previsión social dentro de la cooperativa.</li>
      </ul>
    </div>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h3 class="h5 fw-bold">Fondo Social Cooperativo</h3>
      <p class="text-secondary mb-0">Promueve actividades sociales, educativas y de bienestar. Fortalece la participación de los socios y mejora su calidad de vida, apoyando programas de educación cooperativa, bienestar y recreación.</p>
    </div>
  </div>
</div>
@endsection
