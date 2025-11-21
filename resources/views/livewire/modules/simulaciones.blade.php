@push('styles')
    <link rel="stylesheet" href="{{ asset('css/simulaciones-card.css') }}">
@endpush

<div id="simulaciones-component">

    <div class="sim-card-wrapper">
    <div class="sim-card">

        {{-- BARRA SUPERIOR --}}
        <div class="sim-header-row">
            <div class="sim-header-left">
                <div class="sim-title-row">
                    <h2 class="sim-title">Simulaciones</h2>
                    <span class="sim-count-badge">{{ $simulaciones->total() }} registros</span>
                </div>

                <div class="sim-actions-row">
                    <button wire:click="clearSelection" class="sim-action-btn sim-action-secondary">
                        Limpiar filtros
                    </button>

                    <button wire:click.prevent="exportAll" class="sim-action-btn sim-action-primary" type="button">
                        Exportar Excel (XLS)
                    </button>
                </div>
            </div>

            <div class="sim-header-right">
                {{-- Filtros correlativos en línea --}}
                <div class="sim-filter">
                    <label class="sim-filter-label">Agencia</label>
                    <select wire:model="filtroAgencia" class="sim-filter-input">
                        <option value="">Todas</option>
                        <option value="Cabanillas">Cabanillas</option>
                        <option value="Puno Centro">Puno Centro</option>
                        <option value="Juliaca">Juliaca</option>
                    </select>
                </div>

                <div class="sim-filter">
                    <label class="sim-filter-label">Estado</label>
                    <select wire:model="filtroEstado" class="sim-filter-input">
                        <option value="">Todos</option>
                        <option value="nuevo">Nuevo</option>
                        <option value="contactado">Contactado</option>
                        <option value="en_evaluacion">En evaluación</option>
                        <option value="aprobado_preliminar">Aprobado preliminar</option>
                        <option value="descartado">Descartado</option>
                    </select>
                </div>

                <div class="sim-filter">
                    <label class="sim-filter-label">Tipo</label>
                    <select wire:model="filtroTipo" class="sim-filter-input">
                        <option value="">Todos</option>
                        <option value="consumo">Consumo</option>
                        <option value="hipotecario">Hipotecario</option>
                        <option value="vehicular">Vehicular</option>
                    </select>
                </div>

                <div class="sim-filter short">
                    <label class="sim-filter-label">Fecha</label>
                    <input wire:model="filtroFecha" type="date" class="sim-filter-input">
                </div>

                <div class="sim-filter grow">
                    <label class="sim-filter-label">Buscar</label>
                    <div class="sim-search-wrapper">
                        <input
                            wire:model.debounce.500ms="search"
                            type="text"
                            class="sim-search-input"
                            placeholder="Nombre, DNI o celular..."
                        >
                        <span class="sim-search-icon">
                            <i class="bi bi-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLA --}}
        <div class="sim-table-wrapper">
            <table class="sim-table">
                <thead>
                    <tr>
                        <th class="w-check">
                            <input type="checkbox" wire:model="checkAll">
                        </th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Celular</th>
                        <th>Monto (S/)</th>
                        <th>Plazo</th>
                        <th>Tipo</th>
                        <th>Agencia</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th class="w-acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($simulaciones as $s)
                        @php
                            $estadoColor = match($s->estado) {
                                'nuevo' => 'estado-badge estado-nuevo',
                                'contactado' => 'estado-badge estado-contactado',
                                'en_evaluacion' => 'estado-badge estado-eval',
                                'aprobado_preliminar' => 'estado-badge estado-aprobado',
                                'descartado' => 'estado-badge estado-descartado',
                                default => 'estado-badge estado-default'
                            };
                        @endphp

                        <tr wire:key="sim-{{ $s->id }}">
                            <td class="text-center">
                                <input type="checkbox" wire:model="selected" value="{{ $s->id }}">
                            </td>

                            <td class="txt-strong">{{ $s->nombre }}</td>
                            <td class="txt-dim">{{ $s->dni }}</td>
                            <td class="txt-dim">{{ $s->celular }}</td>

                            <td class="txt-money">
                                S/ {{ number_format($s->monto_solicitado, 2) }}
                            </td>

                            <td class="txt-dim">{{ $s->plazo_meses }} meses</td>

                            <td>
                                <span class="tag-soft">{{ ucfirst($s->tipo_credito) }}</span>
                            </td>

                            <td><span class="txt-agencia">{{ $s->agencia }}</span></td>

                            <td>
                                <div class="estado-layout">
                                    <span class="{{ $estadoColor }}">
                                        {{ ucfirst(str_replace('_', ' ', $s->estado)) }}
                                    </span>

                                    <select
                                        wire:change="changeEstado({{ $s->id }}, $event.target.value)"
                                        class="estado-select"
                                    >
                                        <option value="">Cambiar…</option>
                                        <option value="contactado">Contactado</option>
                                        <option value="en_evaluacion">En evaluación</option>
                                        <option value="aprobado_preliminar">Aprobado preliminar</option>
                                        <option value="descartado">Descartado</option>
                                    </select>
                                </div>
                            </td>

                            <td class="txt-dim">
                                {{ $s->created_at->format('Y-m-d') }}
                            </td>

                            <td class="acciones-cell">
                                <button
                                    wire:click="select({{ $s->id }})"
                                    class="icon-btn view"
                                    title="Ver detalle"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>

                                @if($s->celular)
                                    <a
                                        href="https://wa.me/{{ preg_replace('/[^0-9]/','', $s->celular) }}"
                                        target="_blank"
                                        class="icon-btn whatsapp"
                                        title="WhatsApp"
                                    >
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                @endif

                                <button
                                    wire:click="confirmDelete({{ $s->id }})"
                                    class="icon-btn delete"
                                    title="Eliminar"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="empty-row">No hay simulaciones</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- FOOTER --}}
        <div class="sim-footer-row">
            <div class="sim-footer-left">
                <span class="sim-footer-text">
                    Seleccionados: {{ count($selected) }}
                </span>

                <select wire:model="bulkAction" class="bulk-select">
                    <option value="">Acción masiva…</option>
                    <option value="delete">Eliminar seleccionados</option>
                </select>

                <button wire:click="runBulkAction" class="bulk-apply-btn">
                    Aplicar
                </button>

                <button wire:click.prevent="exportAll" class="bulk-apply-btn bulk-primary">
                    Exportar Excel (XLS)
                </button>

                <button wire:click.prevent="deleteSelected" class="bulk-apply-btn bulk-danger">
                    Eliminar seleccionados
                </button>
            </div>

            <div class="sim-footer-right">
                <span class="sim-footer-text">
                    Mostrando {{ $simulaciones->firstItem() ?: 0 }} - {{ $simulaciones->lastItem() ?: 0 }} de {{ $simulaciones->total() }}
                </span>

                <div class="sim-pagination">
                    {{ $simulaciones->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- Modal de confirmación de eliminación --}}

@push('scripts')
<script>
        document.addEventListener('open-delete-modal', function () {
                var modalEl = document.getElementById('confirmDeleteModal');
                if (!modalEl) return;
                var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
        });

                // Also listen via Livewire event (for emit)
                if (window.Livewire) {
                    Livewire.on('open-delete-modal', function () {
                        var modalEl = document.getElementById('confirmDeleteModal');
                        if (!modalEl) return;
                        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modal.show();
                    });
                }

        document.addEventListener('close-delete-modal', function () {
                var modalEl = document.getElementById('confirmDeleteModal');
                if (!modalEl) return;
                var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.hide();
        });

                if (window.Livewire) {
                    Livewire.on('close-delete-modal', function () {
                        var modalEl = document.getElementById('confirmDeleteModal');
                        if (!modalEl) return;
                        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modal.hide();
                    });
                }

    // Toast listener
    document.addEventListener('show-toast', function (e) {
        var payload = e.detail || { type: 'info', message: '' };
        var toastEl = document.getElementById('livewireToast');
        if (!toastEl) return;
        var toastBody = toastEl.querySelector('.toast-body');
        toastBody.textContent = payload.message || '';
        // adjust classes by type
        toastEl.classList.remove('bg-success','bg-danger','bg-info');
        if (payload.type === 'success') toastEl.classList.add('bg-success','text-white');
        if (payload.type === 'error') toastEl.classList.add('bg-danger','text-white');
        if (payload.type === 'info') toastEl.classList.add('bg-info','text-white');

        var bToast = bootstrap.Toast.getOrCreateInstance(toastEl);
        bToast.show();
    });

    // Livewire emitted toast
    if (window.Livewire) {
        Livewire.on('show-toast', function (payload) {
            var toastEl = document.getElementById('livewireToast');
            if (!toastEl) return;
            var toastBody = toastEl.querySelector('.toast-body');
            toastBody.textContent = (payload && payload.message) ? payload.message : '';
            toastEl.classList.remove('bg-success','bg-danger','bg-info');
            if (payload && payload.type === 'success') toastEl.classList.add('bg-success','text-white');
            if (payload && payload.type === 'error') toastEl.classList.add('bg-danger','text-white');
            if (payload && payload.type === 'info') toastEl.classList.add('bg-info','text-white');
            var bToast = bootstrap.Toast.getOrCreateInstance(toastEl);
            bToast.show();
        });
    }

    // Listener para iniciar la descarga desde Livewire
    document.addEventListener('start-download', function (e) {
        var payload = e.detail || {};
        if (!payload.url) return;
        // Abrir la URL de descarga en la misma ventana para que el navegador gestione el file download
        window.location.href = payload.url;
    });

    // Livewire emitted start-download
    if (window.Livewire) {
        Livewire.on('start-download', function (payload) {
            if (!payload || !payload.url) return;
            window.location.href = payload.url;
        });
    }
</script>
@endpush

{{-- Toast (Bootstrap) --}}
<div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index: 2000;">
    <div id="livewireToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
    <div class="toast-body"></div>
    </div>
</div>
</div>
