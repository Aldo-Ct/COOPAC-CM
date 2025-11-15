<x-layouts.app :title="__('Nuevo Anuncio')">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">Nuevo Anuncio</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Crea un nuevo anuncio para el carrusel de la página principal.</p>
            </div>
        </div>

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    @if ($errors->any())
                        <div class="rounded-md bg-red-50 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Hubo errores con tu envío</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul role="list" class="list-disc space-y-1 pl-5">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.anuncios.store') }}" enctype="multipart/form-data" class="space-y-6 bg-white dark:bg-zinc-900 p-4 rounded-md shadow-sm">
                        @csrf

                        <div>
                            <label for="titulo" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Título (opcional)</label>
                            <div class="mt-2">
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700">
                            </div>
                        </div>

                        <div>
                            <label for="imagen" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Imagen (JPG/PNG/WEBP)</label>
                            <div class="mt-2">
                                <input type="file" name="imagen" id="imagen" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-zinc-800 dark:border-zinc-700 dark:placeholder-zinc-500" accept="image/*" required>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Se mostrará en el modal-carrusel (recomendado: vertical o A4).</p>
                        </div>

                        <div>
                            <label for="url" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">URL destino (opcional)</label>
                            <div class="mt-2">
                                <input type="url" name="url" id="url" value="{{ old('url') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-2">
                                <label for="orden" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Orden</label>
                                <div class="mt-2">
                                    <input type="number" name="orden" id="orden" min="1" value="{{ old('orden', 1) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700">
                                </div>
                            </div>
                            <div class="sm:col-span-1 flex items-end">
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="activo" name="activo" type="checkbox" value="1" checked class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 dark:bg-zinc-800 dark:border-zinc-700">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label for="activo" class="font-medium text-gray-900 dark:text-white">Activo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="desde" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Desde</label>
                                <div class="mt-2">
                                    <input type="date" name="desde" id="desde" value="{{ old('desde') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="hasta" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Hasta</label>
                                <div class="mt-2">
                                    <input type="date" name="hasta" id="hasta" value="{{ old('hasta') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 dark:border-gray-700 pt-6">
                            <a href="{{ route('admin.anuncios.index') }}" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Cancelar</a>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>