@extends('layout')

@section('titulo', 'Servicios · Créditos')
@section('activo-creditos', 'active')

@section('contenido')
<div class="sv-hero text-white mb-4">
  <div class="sv-hero-overlay d-flex align-items-center justify-content-center flex-column p-4 text-center">
    <h2 class="fw-bold display-6 mb-1">Créditos</h2>
    <div class="sv-crumbs"><a href="{{ route('home') }}">Inicio</a> → Servicios → Créditos</div>
  </div>
</div>

<div class="container py-4">
  <h1 class="fw-bold text-success mb-3">Créditos</h1>
  <p class="text-secondary">Apoyamos el desarrollo de las familias rurales, microempresas y socios emprendedores con líneas de crédito justas y accesibles.</p>

  <div class="row g-4">
    <div class="col-12 col-md-6">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <h3 class="h5 fw-bold">Tipos de Crédito</h3>
          <ul class="text-secondary mb-0">
            <li><strong>Créditos a Microempresas:</strong> financian actividades productivas, comerciales o de servicios (endeudamiento hasta S/ 20,000).</li>
            <li><strong>Créditos a Pequeñas Empresas:</strong> para negocios en crecimiento (S/ 20,000 a S/ 300,000).</li>
            <li><strong>Créditos a Medianas Empresas:</strong> fortalecen o amplían operaciones (más de S/ 300,000).</li>
            <li><strong>Consumo No Revolvente:</strong> para gastos personales o familiares.</li>
            <li><strong>Consumo Revolvente:</strong> línea flexible con reutilización del monto amortizado.</li>
            <li><strong>Hipotecarios para Vivienda:</strong> compra, construcción o remodelación con garantía hipotecaria.</li>
            <li><strong>Campañas Especiales:</strong> escolaridad, día de la madre, Tarpuy (agrícola) y Navidad.</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
          <h3 class="h5 fw-bold">Beneficios</h3>
          <ul class="text-secondary mb-0">
            <li>Tasas competitivas y evaluación ágil.</li>
            <li>Asesoría personalizada.</li>
            <li>Inclusión financiera con enfoque rural.</li>
          </ul>
          <div class="mt-3">
            <a href="{{ route('simulador') }}" class="btn btn-success">Simula tu crédito</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
