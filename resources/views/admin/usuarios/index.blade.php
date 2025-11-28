<x-layouts.app :title="__('Usuarios · Roles')">
    {{-- Listado de usuarios para asignar roles/permisos --}}
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">Usuarios</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Asigna roles y permisos.</p>
            </div>
            <form method="GET" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <input type="text" name="q" value="{{ $q }}" placeholder="Buscar nombre o email"
                       class="rounded-md border px-3 py-1.5 dark:bg-zinc-800 dark:text-white" />
                <button class="ml-2 rounded-md bg-zinc-900 text-white px-3 py-1.5">Buscar</button>
            </form>
        </div>

        @if (session('ok'))
            <div class="mt-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('ok') }}</div>
        @endif
        @if (session('err'))
            <div class="mt-4 rounded-md bg-red-50 p-4 text-red-800">{{ session('err') }}</div>
        @endif

        <div class="mt-6 overflow-hidden bg-white shadow-sm ring-1 ring-black ring-opacity-5 rounded-md dark:bg-zinc-900">
            <table class="min-w-full dash-table">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Roles</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach ($users as $u)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $u->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $u->email }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $u->getRoleNames()->join(', ') ?: '—' }}</td>
                            <td class="px-4 py-3 text-right text-sm">
                                <a href="{{ route('admin.usuarios.edit', $u) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $users->links() }}</div>
    </div>
</x-layouts.app>
