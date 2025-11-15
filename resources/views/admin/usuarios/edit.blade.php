<x-layouts.app :title="__('Editar roles')">
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Editar: {{ $usuario->name }}</h1>

        <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" class="space-y-6 bg-white dark:bg-zinc-900 p-4 rounded-md shadow-sm">
            @csrf @method('PUT')

            <div>
                <h2 class="text-sm font-medium text-gray-900 dark:text-white">Roles</h2>
                <div class="mt-2 grid grid-cols-2 gap-2">
                    @foreach ($roles as $r)
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                            <input type="checkbox" name="roles[]" value="{{ $r }}" @checked($usuario->hasRole($r))>
                            <span>{{ $r }}</span>
                        </label>
                    @endforeach
                </div>
                @error('roles')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>

            <div>
                <h2 class="text-sm font-medium text-gray-900 dark:text-white">Permisos</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Marca permisos específicos (p.ej., permitir RR.HH. ver Simulaciones sin cambiar de rol).</p>
                <div class="mt-2 grid grid-cols-2 gap-2">
                    @foreach ($perms as $p)
                        <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                            <input type="checkbox" name="perms[]" value="{{ $p }}" @checked($usuario->can($p))>
                            <span>{{ $p }}</span>
                        </label>
                    @endforeach
                </div>
                @error('perms')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.usuarios.index') }}" class="px-3 py-2 rounded-md border">Cancelar</a>
                <button class="px-3 py-2 rounded-md bg-indigo-600 text-white">Guardar</button>
            </div>
        </form>
    </div>
</x-layouts.app>

