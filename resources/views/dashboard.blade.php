<x-layouts.app :title="__('Dashboard')">
    @php
        /** @var \App\Models\User|null $usuario */
        $usuario = auth()->user();
        $totalSim = \App\Models\Simulacion::count();
        $simHoy = \App\Models\Simulacion::whereDate('created_at', now())->count();
        $prospectosPend = \App\Models\ProspectoCredito::where('estado', 'nuevo')->count();
        $ultimosAnuncios = \App\Models\Anuncio::orderByDesc('created_at')->limit(3)->get();
    @endphp

    {{-- Hero cooperativo --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-700 via-green-600 to-yellow-500 text-white p-6 shadow-lg mb-8">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm uppercase tracking-wide opacity-75">Cooperativa de Ahorro y Crédito Cabanillas Mañazo</p>
                <h1 class="text-2xl font-semibold">Hola, {{ $usuario->name }}</h1>
                <p class="text-sm opacity-80">
                    {{ $usuario->agencia ? 'Agencia '.$usuario->agencia : 'Plataforma Administrativa' }}
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                @can('simulaciones.ver')
                    <a href="{{ route('simulaciones') }}" class="bg-white/90 text-green-800 px-4 py-2 rounded-full text-sm font-semibold hover:bg-white transition">
                        Ver simulaciones
                    </a>
                @endcan
                <a href="{{ url('/') }}" class="border border-white/60 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-white/10 transition">
                    ← Volver al sitio
                </a>
            </div>
        </div>
    </div>

    {{-- Métricas principales --}}
    <div class="grid gap-4 md:grid-cols-3 mb-8">
        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm">
            <div class="text-sm font-semibold text-green-700">Simulaciones totales</div>
            <div class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">{{ number_format($totalSim) }}</div>
            <p class="text-xs text-zinc-500 mt-1">Incluye todo el histórico registrado.</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm">
            <div class="text-sm font-semibold text-green-700">Simulaciones hoy</div>
            <div class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">{{ $simHoy }}</div>
            <p class="text-xs text-zinc-500 mt-1">Generadas durante este día.</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm">
            <div class="text-sm font-semibold text-green-700">Prospectos pendientes</div>
            <div class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">{{ $prospectosPend }}</div>
            <p class="text-xs text-zinc-500 mt-1">Sin contacto registrado.</p>
        </div>
    </div>

    {{-- Atajos y paneles --}}
    <div class="grid gap-6 lg:grid-cols-3 mb-8">
        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm lg:col-span-2">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Acciones rápidas</h2>
            <div class="flex flex-wrap gap-3">
                @can('simulaciones.ver')
                    <a href="{{ route('simulaciones') }}" class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                        📊 Gestión de simulaciones
                    </a>
                @endcan
                @can('anuncios.gestionar')
                    <a href="{{ route('admin.anuncios.index') }}" class="flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-yellow-600 transition">
                        📢 Panel de anuncios
                    </a>
                @endcan
                @can('noticias.gestionar')
                    <a href="{{ route('admin.noticias.index') }}" class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-600 transition">
                        📰 Noticias institucionales
                    </a>
                @endcan
                @can('rrhh.gestionar')
                    <a href="{{ route('rrhh.asesores.index') }}" class="flex items-center gap-2 bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-amber-700 transition">
                        👥 RR.HH. · Asesores
                    </a>
                @endcan
                <a href="{{ route('panel') }}" class="flex items-center gap-2 border border-zinc-300 dark:border-zinc-700 px-4 py-2 rounded-lg text-sm font-semibold text-zinc-700 dark:text-zinc-100 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                    🏠 Panel principal
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Anuncios recientes</h2>
            <ul class="space-y-3">
                @forelse($ultimosAnuncios as $anuncio)
                    <li class="border border-zinc-200 dark:border-zinc-800 rounded-lg p-3 text-sm">
                        <div class="font-semibold text-green-700">{{ $anuncio->titulo ?? 'Anuncio institucional' }}</div>
                        <p class="text-xs text-zinc-500">{{ $anuncio->created_at?->diffForHumans() }}</p>
                    </li>
                @empty
                    <li class="text-sm text-zinc-500">Sin anuncios cargados.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Panel inferior --}}
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Compromiso cooperativo</h2>
            <p class="text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed">
                Seguimos impulsando el desarrollo de nuestros socios rurales y urbano marginales.
                Usa este panel para acelerar la atención de simulaciones, brindar seguimiento oportuno y anunciar campañas con transparencia.
            </p>
            <p class="text-sm text-zinc-600 dark:text-zinc-300 mt-3">
                Recuerda mantener actualizada la información de tus prospectos y reportar cualquier novedad a Imagen o RR.HH.
            </p>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Últimos prospectos pendientes</h2>
            @php
                $pendientes = \App\Models\ProspectoCredito::where('estado', 'nuevo')->latest()->limit(3)->get();
            @endphp
            <ul class="space-y-3 text-sm">
                @forelse($pendientes as $prospecto)
                    <li class="flex items-center justify-between border border-zinc-200 dark:border-zinc-800 rounded-lg px-3 py-2">
                        <div>
                            <div class="font-semibold text-zinc-900 dark:text-white">{{ $prospecto->nombre }}</div>
                            <div class="text-xs text-zinc-500">Solicitud: {{ $prospecto->created_at?->format('d/m/Y') }}</div>
                        </div>
                        <span class="text-xs text-amber-600 font-semibold">Pendiente</span>
                    </li>
                @empty
                    <li class="text-zinc-500">No hay pendientes 🎉</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-layouts.app>
