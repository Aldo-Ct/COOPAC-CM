@extends('layout')

@section('titulo', 'Agencias y Puntos de Atención')
@section('activo-agencias', 'active')

@section('contenido')
<section class="agencias-hero text-white">
  <div class="agencias-hero-overlay d-flex align-items-center">
    <div class="container">
      <p class="text-uppercase fw-semibold small mb-2">Red institucional</p>
      <h1 class="display-6 fw-bold mb-3">Agencias y Puntos de Atención</h1>
      <p class="lead mb-0">La COOPAC Cabanillas-Mañazo cuenta con una red de agencias y puntos de atención en Puno y Arequipa para estar más cerca de sus socios. Encuentra tu oficina más cercana a continuación.</p>
    </div>
  </div>
</section>

@php
  $agencias = [
    ['nombre' => 'Sede Principal – Cabanillas', 'ubicacion' => 'San Román, Puno', 'direccion' => 'Jr. San Román N.º 209 – Cabanillas', 'map_query' => 'Jr. San Román 209, Cabanillas, Puno, Perú', 'map_embed' => 'https://www.google.com/maps?width=600&height=400&hl=es&q=-15.6423777,-70.3492325&output=embed', 'imagen' => 'IMAGENES/INICIO3.jpg'],
    ['nombre' => 'Agencia Mañazo', 'ubicacion' => 'Puno', 'direccion' => 'Jr. San Martín s/n – Mañazo', 'map_query' => 'Plaza de Armas Mañazo, Puno, Perú', 'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3839.057685966207!2d-70.3429268!3d-15.800912023432854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915d4df8c522e317%3A0x68f08a8171611cc3!2sCOOPAC%20CABANILLAS%20MA%C3%91AZO%20LTDA!5e0!3m2!1ses-419!2spe!4v1763695888363!5m2!1ses-419!2spe', 'imagen' => 'IMAGENES/2.png'],
    ['nombre' => 'Agencia Atuncolla', 'ubicacion' => 'Puno', 'direccion' => 'Av. Sillustani s/n – Atuncolla', 'map_query' => 'Plaza de Armas Atuncolla, Puno, Perú', 'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3841.1837052117794!2d-70.14234499999999!3d-15.6883982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915d5f0c01a87639%3A0xbc9811158d073108!2sCOOPAC%20CABANILLAS%20MA%C3%91AZO!5e0!3m2!1ses-419!2spe!4v1763696744635!5m2!1ses-419!2spe', 'imagen' => 'IMAGENES/3.png'],
    ['nombre' => 'Agencia Coata', 'ubicacion' => 'Puno', 'direccion' => 'Plaza San Isidro – Coata', 'map_query' => 'Plaza San Isidro Coata, Puno, Perú', 'imagen' => 'IMAGENES/4.jpg'],
    ['nombre' => 'Agencia Puno', 'ubicacion' => 'Puno', 'direccion' => 'Av. El Sol N.º 132 – Puno', 'map_query' => 'Av. El Sol 132, Puno, Perú' , 'imagen' => 'IMAGENES/INICIO3.jpg'],
    ['nombre' => 'Agencia Juliaca', 'ubicacion' => 'San Román, Puno', 'direccion' => 'Jr. Jáuregui N.º 690 – Juliaca', 'map_query' => 'Jr. Jáuregui 690, Juliaca, Puno, Perú', 'imagen' => 'IMAGENES/INICIO2.png'],
    ['nombre' => 'Agencia Ayaviri', 'ubicacion' => 'Melgar, Puno', 'direccion' => 'Jr. Cusco N.º 131 – Ayaviri', 'map_query' => 'Jr. Cusco 131, Ayaviri, Puno, Perú', 'imagen' => 'IMAGENES/INICIO3.jpg'],
    ['nombre' => 'Agencia Azángaro', 'ubicacion' => 'Azángaro, Puno', 'direccion' => 'Jr. Azángaro N.º 180, Plaza San Bernardo – Azángaro', 'map_query' => 'Plaza San Bernardo, Azángaro, Puno, Perú', 'imagen' => 'IMAGENES/INICIO2.png'],
    ['nombre' => 'Agencia Crucero', 'ubicacion' => 'Carabaya, Puno', 'direccion' => 'Jr. Amarguras N.º 105 – Crucero', 'map_query' => 'Jr. Amarguras 105, Crucero, Puno, Perú', 'imagen' => 'IMAGENES/INICIO3.jpg'],
    ['nombre' => 'Agencia San Miguel', 'ubicacion' => 'San Román, Puno', 'direccion' => 'Av. Circunvalación N.º 138 – San Miguel', 'map_query' => 'Av. Circunvalación 138, San Miguel, San Román, Perú', 'imagen' => 'IMAGENES/INICIO2.png'],
    ['nombre' => 'Agencia Arequipa', 'ubicacion' => 'Cerro Colorado, Arequipa', 'direccion' => 'Av. Aviación con vía de evitamiento – Cerro Colorado', 'map_query' => 'Av. Aviación y Vía de Evitamiento, Cerro Colorado, Arequipa, Perú', 'imagen' => 'IMAGENES/INICIO3.jpg'],
  ];

  $puntos = [
    ['lugar' => 'Distrito de Santa Lucía', 'direccion' => 'Mercado Central'],
    ['lugar' => 'Provincia de Lampa', 'direccion' => 'Jr. Prolongación G. Moore – Plaza de Armas'],
    ['lugar' => 'Distrito de Vilque', 'direccion' => 'Av. Manco Cápac N.º 150'],
    ['lugar' => 'Distrito de Capachica', 'direccion' => 'Plaza de Armas'],
    ['lugar' => 'Distrito de Huata', 'direccion' => 'Jr. Lima N.º 203'],
    ['lugar' => 'Centro Poblado de Moro', 'direccion' => 'Vía Juliaca – Puno'],
  ];
@endphp

<section class="py-5 agencias-section">
  <div class="container">
    <div class="section-heading text-center mb-5">
      <h2 class="fw-bold">Nuestras agencias</h2>
      <p class="text-muted mb-0">Cada oficina cuenta con asesores preparados para atender tus operaciones de ahorro y crédito.</p>
    </div>

    <div class="d-flex flex-column gap-5">
      @foreach ($agencias as $index => $agencia)
        @php
          $reverse = $index % 2 === 1 ? 'flex-lg-row-reverse' : '';
          $mapUrl = $agencia['map_embed']
            ?? 'https://maps.google.com/maps?hl=es&q='.rawurlencode($agencia['map_query']).'&t=&z=18&iwloc=B&output=embed';
        @endphp
        <div class="row g-4 align-items-stretch agency-row reveal-section {{ $reverse }}">
          <div class="col-12 col-lg-6">
            <div class="card h-100 shadow-sm border-0">
              <img
                src="{{ asset($agencia['imagen']) }}"
                class="card-img-top img-fluid object-fit-cover agency-photo-img"
                alt="Foto {{ $agencia['nombre'] }}"
                onerror="this.onerror=null;this.src='/IMAGENES/INICIO2.png';">
              <div class="card-body">
                <h4 class="card-title agency-name text-center mb-2">{{ $agencia['nombre'] }}</h4>
                <p class="text-center mb-3"><span class="badge text-bg-success-subtle text-success">{{ $agencia['ubicacion'] }}</span></p>
                <p class="card-text mb-2">
                  <strong>Dirección:</strong> {{ $agencia['direccion'] }}
                </p>
                <p class="card-text text-muted mb-0">
                  Atención integral en servicios de ahorro y crédito con asesores especializados.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-6">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body">
                <h5 class="card-title mb-2">Cómo llegar</h5>
                <p class="card-text mb-0">Encuéntranos en Google Maps.</p>
              </div>
              <div class="ratio ratio-16x9">
                <iframe
                  src="{{ $mapUrl }}"
                  allowfullscreen
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="py-5 bg-light puntos-section">
  <div class="container">
    <div class="section-heading text-center mb-4">
      <h3 class="fw-bold">Puntos de atención</h3>
      <p class="text-muted mb-0">Encuentra módulos itinerantes o ventanillas aliadas en las siguientes localidades.</p>
    </div>

    <div class="row g-3">
      @foreach ($puntos as $punto)
        <div class="col-12 col-md-6">
          <div class="punto-card d-flex align-items-start gap-3 rounded-4 h-100 reveal-section">
            <div class="punto-icon">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
              <h6 class="fw-bold mb-1 text-success">{{ $punto['lugar'] }}</h6>
              <p class="mb-0 text-muted">{{ $punto['direccion'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => entry.isIntersecting && entry.target.classList.add('show'));
  }, { threshold: 0.2 });

  document.querySelectorAll('.reveal-section').forEach(el => observer.observe(el));
});
</script>
@endpush
@endsection
