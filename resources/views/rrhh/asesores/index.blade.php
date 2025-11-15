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

        <div class="mt-6 overflow-hidden bg-white shadow-sm ring-1 ring-black ring-opacity-5 rounded-md dark:bg-zinc-900">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Agencia</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse ($asesores as $u)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $u->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $u->email }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $u->agencia ?? '—' }}</td>
                            <td class="px-4 py-3 text-right text-sm">
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
