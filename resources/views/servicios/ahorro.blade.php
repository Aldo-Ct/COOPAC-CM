@extends('layout')

@section('titulo', 'Servicios · Ahorro')
@section('activo-creditos', 'active')

@section('contenido')
<div class="sv-hero text-white mb-4">
  <div class="sv-hero-overlay d-flex align-items-center justify-content-center flex-column p-4 text-center">
    <h2 class="fw-bold display-6 mb-1">Ahorro</h2>
    <div class="sv-crumbs"><a href="{{ route('home') }}">Inicio</a> → Servicios → Ahorro</div>
  </div>
</div>

<div class="container py-4">
  <h1 class="fw-bold text-success mb-3">Ahorro</h1>
  <p class="text-secondary">La Cooperativa de Ahorro y Crédito Cabanillas – Mañazo Ltda. ofrece productos de ahorro seguros y con rentabilidad para nuestros socios.</p>

  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
      <h3 class="h5 fw-bold text-success">Ahorro DPF (Depósito a Plazo Fijo)</h3>
      <p class="mb-2">Los depósitos a plazo fijo representan compromisos de ahorro con la Cooperativa, que ofrecen una rentabilidad segura y tasas de interés preferenciales según el monto y el plazo elegido.</p>

      <h6 class="fw-semibold mt-3">Beneficios</h6>
      <ul class="text-secondary mb-3">
        <li>Seguridad garantizada (Fondo de Seguro de Depósitos Cooperativos).</li>
        <li>Altas tasas de interés según el monto y el tiempo del depósito.</li>
        <li>Participación en sorteos y beneficios adicionales para socios.</li>
      </ul>

      <h6 class="fw-semibold">Requisitos</h6>
      <ul class="text-secondary mb-3">
        <li>Ser socio de la COOPAC Cabanillas Mañazo.</li>
        <li>Presentar 02 fotografías y fotocopia del DNI.</li>
      </ul>

      <h6 class="fw-semibold">Tarifario de Tasas Pasivas – Personas Naturales (TEA)</h6>
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle small">
          <thead class="table-light">
            <tr>
              <th>Plazo</th>
              <th>De S/. 300 – 10,000</th>
              <th>Hasta S/. 25,000</th>
              <th>Hasta S/. 50,000</th>
              <th>Hasta S/. 150,000</th>
              <th>Hasta S/. 300,000</th>
              <th>Más de S/. 300,000</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>3 meses (90 días)</td><td>3.00%</td><td>3.50%</td><td>4.00%</td><td>4.50%</td><td>5.00%</td><td>5.50%</td></tr>
            <tr><td>6 meses (180 días)</td><td>3.25%</td><td>3.75%</td><td>4.25%</td><td>4.75%</td><td>5.25%</td><td>5.75%</td></tr>
            <tr><td>9 meses (270 días)</td><td>3.75%</td><td>4.25%</td><td>4.75%</td><td>5.25%</td><td>5.75%</td><td>6.25%</td></tr>
            <tr><td>1 año (360 días)</td><td>6.50%</td><td>7.00%</td><td>8.00%</td><td>9.00%</td><td>9.75%</td><td>10.00%</td></tr>
            <tr><td>1.5 años (540 días)</td><td>7.00%</td><td>7.50%</td><td>8.50%</td><td>9.50%</td><td>9.75%</td><td>10.25%</td></tr>
            <tr><td>2 años (720 días)</td><td>7.50%</td><td>8.00%</td><td>9.00%</td><td>10.00%</td><td>10.25%</td><td>10.50%</td></tr>
            <tr><td>3 años (1080 días)</td><td>8.00%</td><td>9.00%</td><td>9.75%</td><td>10.25%</td><td>10.50%</td><td>11.00%</td></tr>
          </tbody>
        </table>
      </div>
      <p class="text-muted small mb-0">Nota: Las tasas están expresadas en Tasa Efectiva Anual (TEA) y pueden variar según políticas vigentes.</p>
    </div>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h3 class="h5 fw-bold text-success">Ahorro Libre</h3>
      <p class="mb-2">Cuenta flexible que permite depositar y retirar dinero en cualquier momento.</p>
      <h6 class="fw-semibold mt-2">Beneficios</h6>
      <ul class="text-secondary mb-0">
        <li>Disponibilidad inmediata del dinero.</li>
        <li>Sin penalidades por retiros.</li>
        <li>Seguridad y respaldo de la COOPAC Cabanillas Mañazo.</li>
        <li>Oportunidad de participar en programas de fidelización.</li>
      </ul>
    </div>
  </div>
</div>
@endsection
