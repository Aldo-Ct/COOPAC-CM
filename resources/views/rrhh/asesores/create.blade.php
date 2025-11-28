<x-layouts.app :title="__('Nuevo asesor')">
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Nuevo asesor</h1>

        <form action="{{ route('rrhh.asesores.store') }}" method="POST" class="space-y-4 bg-white dark:bg-zinc-900 p-4 rounded-md shadow-sm">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                <input name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-md border dark:bg-zinc-800 dark:text-white" />
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-md border dark:bg-zinc-800 dark:text-white" />
                @error('email')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                <input type="password" name="password" required class="mt-1 w-full rounded-md border dark:bg-zinc-800 dark:text-white" />
                @error('password')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Agencia</label>
                @php($agencias = [
                    'Sede Principal – Cabanillas',
                    'Agencia Mañazo',
                    'Agencia Atuncolla',
                    'Agencia Coata',
                    'Agencia Puno',
                    'Agencia Juliaca',
                    'Agencia Ayaviri',
                    'Agencia Azángaro',
                    'Agencia Crucero',
                    'Agencia San Miguel',
                    'Agencia Arequipa',
                ])
                <select name="agencia" class="mt-1 w-full rounded-md border dark:bg-zinc-800 dark:text-white">
                    <option value="">Seleccione agencia</option>
                    @foreach($agencias as $ag)
                        <option value="{{ $ag }}" @selected(old('agencia')===$ag)>{{ $ag }}</option>
                    @endforeach
                </select>
                @error('agencia')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('rrhh.asesores.index') }}" class="px-3 py-2 rounded-md border">Cancelar</a>
                <button class="px-3 py-2 rounded-md bg-indigo-600 text-white">Guardar</button>
            </div>
        </form>
    </div>
</x-layouts.app>
