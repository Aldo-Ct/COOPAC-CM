@extends('layout')

@section('titulo', 'Noticias')
@section('activo-noticias', 'active')

@section('contenido')
<div class="container py-5">
    <h1 class="fw-bold text-success mb-4 text-center">Últimas Noticias</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($noticias as $noticia)
            <div class="col">
                <div class="card h-100 shadow-sm noticia-card" data-bs-toggle="modal" data-bs-target="#noticiaModal"
                     data-imagen="{{ $noticia->imagen_url }}"
                     data-titulo="{{ $noticia->titulo }}"
                     data-descripcion="{{ $noticia->descripcion }}"
                     data-contenido="{{ $noticia->contenido }}"
                     data-adjunto="{{ $noticia->adjunto_url }}">
                    <img src="{{ $noticia->imagen_url }}" class="card-img-top" alt="{{ $noticia->titulo }}" style="height: 220px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-success">{{ $noticia->titulo }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($noticia->descripcion ?? $noticia->resumen, 100) }}</p>
                    </div>
                    <div class="card-footer text-muted small">
                        Publicado: {{ optional($noticia->publicado_en ?? $noticia->created_at)->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="lead text-muted">No hay noticias disponibles en este momento.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $noticias->links() }}
    </div>
</div>

<!-- Modal para mostrar la noticia completa -->
<div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticiaModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" class="img-fluid mb-3" alt="" id="noticiaModalImagen">
                <p id="noticiaModalDescripcion"></p>
                <div id="noticiaModalDownload" class="mt-3 d-none">
                    <a href="#" id="noticiaModalDownloadLink" target="_blank" class="btn btn-outline-success">
                        Descargar archivo
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Saneador simple con lista permitida para evitar XSS sin cambiar el aspecto
        function sanitizeHtml(dirty) {
            if (!dirty) return '';
            const parser = new DOMParser();
            const doc = parser.parseFromString(dirty, 'text/html');

            const allowedTags = new Set(['P','BR','STRONG','EM','B','I','U','UL','OL','LI','A','SPAN','DIV','H1','H2','H3','H4','H5','H6']);
            const allowedAttrs = {
                'A': ['href','title','target','rel'],
                'SPAN': ['style'],
                'DIV': ['style'],
                'P': ['style'],
                'H1': ['style'], 'H2': ['style'], 'H3': ['style'], 'H4': ['style'], 'H5': ['style'], 'H6': ['style'],
            };

            function cleanNode(node) {
                const nodeType = node.nodeType;
                if (nodeType === Node.TEXT_NODE) {
                    return node.cloneNode(true);
                }
                if (nodeType !== Node.ELEMENT_NODE) {
                    return document.createTextNode('');
                }
                const tag = node.tagName;
                if (!allowedTags.has(tag)) {
                    // Reemplaza elemento no permitido por el contenido limpio de sus hijos
                    const frag = document.createDocumentFragment();
                    node.childNodes.forEach(child => {
                        const cleaned = cleanNode(child);
                        if (cleaned) frag.appendChild(cleaned);
                    });
                    return frag;
                }

                const el = document.createElement(tag);
                // Copiar atributos permitidos
                const attrs = allowedAttrs[tag] || [];
                for (const attr of attrs) {
                    if (node.hasAttribute(attr)) {
                        let val = node.getAttribute(attr) || '';
                        if (tag === 'A' && attr === 'href') {
                            // Permitir sólo http/https y rutas relativas
                            const safe = /^(https?:\/\/|\/)/i.test(val);
                            if (!safe) continue;
                        }
                        if (tag === 'A' && attr === 'target') {
                            // Sólo permitir _blank
                            val = '_blank';
                        }
                        if (tag === 'A' && attr === 'rel') {
                            val = 'noopener noreferrer';
                        }
                        el.setAttribute(attr, val);
                    }
                }
                // Limpiar hijos
                node.childNodes.forEach(child => {
                    const cleaned = cleanNode(child);
                    if (cleaned) el.appendChild(cleaned);
                });
                return el;
            }

            const cleaned = cleanNode(doc.body);
            const container = document.createElement('div');
            container.appendChild(cleaned);
            return container.innerHTML;
        }

        function isSafeUrl(url) {
            if (!url) return false;
            // Permitir http/https y rutas relativas
            return /^(https?:\/\/|\/)/i.test(url);
        }

        var noticiaModal = document.getElementById('noticiaModal');
        noticiaModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var imagen = button.getAttribute('data-imagen');
            var titulo = button.getAttribute('data-titulo');
            var descripcion = button.getAttribute('data-descripcion');
            var contenido = button.getAttribute('data-contenido');
            var adjunto = button.getAttribute('data-adjunto');

            var modalTitle = noticiaModal.querySelector('.modal-title');
            var modalImage = noticiaModal.querySelector('#noticiaModalImagen');
            var modalDescription = noticiaModal.querySelector('#noticiaModalDescripcion');
            var modalDownload = noticiaModal.querySelector('#noticiaModalDownload');
            var modalDownloadLink = noticiaModal.querySelector('#noticiaModalDownloadLink');

            modalTitle.textContent = titulo || '';
            // Validar imagen
            if (isSafeUrl(imagen)) {
                modalImage.src = imagen;
            } else {
                modalImage.removeAttribute('src');
            }
            modalImage.alt = titulo || '';
            // Insertar HTML saneado para mantener formato sin riesgos
            var htmlToShow = (contenido && contenido.trim().length ? contenido : (descripcion || ''));
            modalDescription.innerHTML = sanitizeHtml(htmlToShow);

            if (isSafeUrl(adjunto)) {
                modalDownload.classList.remove('d-none');
                modalDownloadLink.href = adjunto;
            } else {
                modalDownload.classList.add('d-none');
                modalDownloadLink.href = '#';
            }
        });
    });
</script>
@endpush
