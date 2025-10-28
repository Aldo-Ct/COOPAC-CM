<x-layouts.app :title="__('Dashboard')">

    {{-- BARRA SUPERIOR ADMIN --}}
    <div class="bg-green-700 text-white px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between rounded-md shadow mb-6">
        <div class="flex items-center gap-4">


            {{-- Texto institucional --}}
                    <div class="w-full text-center md:text-center">
                <div class="text-sm uppercase tracking-wide font-semibold">
                    COOPAC CABANILLAS MAÑAZO
                </div>
                <div class="text-lg font-bold leading-tight">
                    ADMINISTRADOR
                </div>
    </div>
        </div>

        <div class="mt-4 md:mt-0 flex items-center gap-3">
            {{-- Nombre del usuario logueado --}}


            {{-- Botón volver --}}
            <a href="{{ url('/') }}"
               class="bg-white text-green-700 font-semibold px-4 py-2 rounded-md hover:bg-green-100 transition text-sm">
                ← salir
            </a>
        </div>
    </div>

    {{-- TARJETAS / CONTENIDO DASHBOARD --}}
    <div class="flex flex-col gap-4 w-full">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-gray-200 dark:border-neutral-700 bg-white">
                <x-placeholder-pattern class="absolute inset-0 w-full h-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-gray-200 dark:border-neutral-700 bg-white">
                <x-placeholder-pattern class="absolute inset-0 w-full h-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-gray-200 dark:border-neutral-700 bg-white">
                <x-placeholder-pattern class="absolute inset-0 w-full h-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>

        <div class="relative min-h-[200px] overflow-hidden rounded-xl border border-gray-200 dark:border-neutral-700 bg-white">
            <x-placeholder-pattern class="absolute inset-0 w-full h-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>

</x-layouts.app>
