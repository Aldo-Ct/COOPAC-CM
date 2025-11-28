<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            @php
                /** @var \App\Models\User|null $authUser */
                $authUser = auth()->user();
            @endphp
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('panel') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    {{-- Segmento 1: Inicio (vacío por ahora) --}}
                    <flux:navlist.item icon="home" :href="route('panel')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Inicio') }}</flux:navlist.item>

                    {{-- Segmento 2: Simulaciones (módulo) --}}
                    @can('simulaciones.ver')
                        <flux:navlist.item icon="calculator" :href="route('simulaciones')" :current="request()->routeIs('simulaciones')" wire:navigate>
                            {{ __('Simulaciones') }}
                        </flux:navlist.item>
                    @endcan

                    {{-- Segmento 3: Anuncios --}}
                    @can('anuncios.gestionar')
                        <flux:navlist.item icon="megaphone" :href="route('admin.anuncios.index')" :current="request()->routeIs('admin.anuncios.*')" wire:navigate>
                            {{ __('Anuncios') }}
                        </flux:navlist.item>
                    @endcan

                    {{-- Segmento 4: Noticias --}}
                    @can('noticias.gestionar')
                        <flux:navlist.item icon="newspaper" :href="route('admin.noticias.index')" :current="request()->routeIs('admin.noticias.*')" wire:navigate>
                            {{ __('Noticias') }}
                        </flux:navlist.item>
                    @endcan

                    {{-- Segmento 5b: Usuarios/Roles (solo Admin) --}}
                    @role('admin')
                        <flux:navlist.item icon="users" :href="route('admin.usuarios.index')" :current="request()->routeIs('admin.usuarios.*')" wire:navigate>
                            {{ __('Usuarios · Roles') }}
                        </flux:navlist.item>
                    @endrole

                    {{-- Segmento 5: RR.HH. --}}
                    @can('rrhh.gestionar')
                        <flux:navlist.item icon="layout-grid" :href="route('rrhh.asesores.index')" :current="request()->routeIs('rrhh.asesores.*')" wire:navigate>
                            {{ __('RR.HH. · Asesores') }}
                        </flux:navlist.item>
                    @endcan

                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="$authUser->name"
                    :initials="$authUser->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ $authUser->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ $authUser->name }}</span>
                                    <span class="truncate text-xs">{{ $authUser->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="$authUser->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ $authUser->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ $authUser->name }}</span>
                                    <span class="truncate text-xs">{{ $authUser->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

    {{ $slot }}

    {{-- Stack for view-specific scripts (Livewire @push('scripts')) --}}
    @stack('scripts')

    @fluxScripts
    </body>
</html>
