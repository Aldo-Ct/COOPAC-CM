@php use Illuminate\Support\Str; @endphp
@extends('layout')

@section('titulo', 'Búsqueda')
@section('activo-noticias', request()->is('buscar') ? 'active' : '')

@section('contenido')
<div class="container py-5">
  <div class="mb-4 text-center">
    <p class="text-uppercase text-success fw-bold small mb-1">Búsqueda global</p>
    <h2 class="fw-bold mb-1">Resultados para: "{{ $q }}"</h2>
    <p class="text-muted">Coincidencias en noticias, anuncios y secciones del sitio.</p>
  </div>

  <div class="row g-4">
    <div class="col-lg-7">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold mb-0">Noticias ({{ $noticias->total() }})</h5>
      </div>
      <div class="row row-cols-1 row-cols-md-2 g-3">
        @forelse($noticias as $noticia)
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="{{ $noticia->imagen_url }}" class="card-img-top" alt="{{ $noticia->titulo }}" style="height:180px;object-fit:cover;">
              <div class="card-body">
                <h6 class="fw-bold text-success">{{ $noticia->titulo }}</h6>
                <p class="text-muted small mb-2">{{ Str::limit($noticia->descripcion ?? $noticia->resumen, 100) }}</p>
                <p class="text-muted small mb-0">Publicado: {{ optional($noticia->publicado_en ?? $noticia->created_at)->format('d/m/Y') }}</p>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="alert alert-light border text-center mb-0">No se encontraron noticias.</div>
          </div>
        @endforelse
      </div>
      <div class="d-flex justify-content-center mt-3">{{ $noticias->links() }}</div>
    </div>

    <div class="col-lg-5">
      <div class="mb-3">
        <h5 class="fw-bold mb-0">Anuncios ({{ $anuncios->count() }})</h5>
      </div>
      <div class="list-group shadow-sm mb-4">
        @forelse($anuncios as $a)
          <a href="{{ $a->url ?: '#' }}" target="{{ $a->url ? '_blank' : '_self' }}" class="list-group-item list-group-item-action d-flex align-items-center gap-3">
            <img src="{{ $a->imagen_url }}" alt="{{ $a->titulo }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
            <div class="flex-fill">
              <div class="fw-bold">{{ $a->titulo }}</div>
              @if($a->descripcion)
              <div class="text-muted small">{{ Str::limit($a->descripcion, 80) }}</div>
              @endif
            </div>
          </a>
        @empty
          <div class="list-group-item text-center text-muted">No hay anuncios.</div>
        @endforelse
      </div>

      <div>
        <h5 class="fw-bold mb-2">Secciones del sitio</h5>
        <div class="list-group shadow-sm">
          @forelse($sections as $s)
            <a href="{{ $s['url'] }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
              <span>{{ $s['title'] }}</span>
              <i class="bi bi-arrow-right-circle text-success"></i>
            </a>
          @empty
            <div class="list-group-item text-muted">Sin coincidencias en secciones.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
