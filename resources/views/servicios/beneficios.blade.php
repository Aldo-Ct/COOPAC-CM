@extends('layout')

@section('titulo', 'Servicios · Beneficios de ser socio')
@section('activo-creditos', 'active')

@section('contenido')
<div class="sv-hero text-white mb-4">
  <div class="sv-hero-overlay d-flex align-items-center justify-content-center flex-column p-4 text-center">
    <h2 class="fw-bold display-6 mb-1">Beneficios</h2>
    <div class="sv-crumbs"><a href="{{ route('home') }}">Inicio</a> → Servicios → Beneficios</div>
  </div>
</div>

<div class="container py-4">
  <h1 class="fw-bold text-success mb-3">Beneficios generales de ser socio</h1>
  <ul class="text-secondary fs-6">
    <li>Seguridad financiera respaldada por el Fondo de Seguro de Depósitos Cooperativos.</li>
    <li>Acceso a altas tasas de interés en ahorro y créditos con condiciones preferentes.</li>
    <li>Participación democrática en asambleas y decisiones institucionales.</li>
    <li>Acceso a servicios sociales, educativos y de previsión.</li>
    <li>Atención personalizada, con enfoque rural y humano.</li>
  </ul>

  <div class="mt-3">
    <a href="{{ route('simulador') }}" class="btn btn-success">Simula tu crédito</a>
  </div>
</div>
@endsection
