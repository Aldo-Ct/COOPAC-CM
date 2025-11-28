<x-layouts.app :title="__('RR.HH. · Asesores')">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">Asesores de Crédito</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Gestiona los usuarios con acceso al módulo de Simulaciones.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('rrhh.asesores.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Nuevo asesor</a>
            </div>
        </div>

        @if (session('ok'))
            <div class="mt-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('ok') }}</div>
        @endif

        <div class="mt-4 p-3 bg-white dark:bg-zinc-900 shadow-sm ring-1 ring-black ring-opacity-5 rounded-md">
            <form method="GET" action="{{ route('rrhh.asesores.index') }}" class="flex flex-wrap items-end gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Buscar</label>
                    <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Nombre o email" class="mt-1 w-56 rounded-md border dark:bg-zinc-800 dark:text-white" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Agencia</label>
                    <select name="agencia" class="mt-1 w-56 rounded-md border dark:bg-zinc-800 dark:text-white">
                        <option value="">Todas</option>
                        @foreach(($agenciasLista ?? []) as $ag)
                            <option value="{{ $ag }}" @selected(($agencia ?? '')===$ag)>{{ $ag }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-2 rounded-md bg-indigo-600 text-white">Aplicar</button>
                    <a href="{{ route('rrhh.asesores.index') }}" class="px-3 py-2 rounded-md bg-indigo-600 text-white">Restablecer filtros</a>
                </div>
            </form>
        </div>

        <div class="mt-4 overflow-hidden bg-white shadow-sm ring-1 ring-black ring-opacity-5 rounded-md dark:bg-zinc-900">
            <table class="min-w-full dash-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Agencia</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asesores as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->agencia ?? '—' }}</td>
                            <td class="text-right">
                                <a href="{{ route('rrhh.asesores.edit', $u) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                <form action="{{ route('rrhh.asesores.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar definitivamente al asesor?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-900 ml-3">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">No hay asesores registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $asesores->links() }}</div>
    </div>
</x-layouts.app>
