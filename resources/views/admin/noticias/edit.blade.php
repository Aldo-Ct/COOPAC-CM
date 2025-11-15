<x-layouts.app :title="__('Editar Noticia')">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">
                    Editar noticia
                </h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                    Actualiza la información publicada en la sección de noticias.
                </p>
            </div>
        </div>

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    @if ($errors->any())
                        <div class="mb-4 rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Revisa los siguientes errores</h3>
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

                    <form
                        method="POST"
                        action="{{ route('admin.noticias.update', $noticia) }}"
                        enctype="multipart/form-data"
                        class="space-y-6 rounded-md bg-white p-4 shadow-sm dark:bg-zinc-900"
                    >
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="titulo" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                Título
                            </label>
                            <div class="mt-2">
                                <input
                                    type="text"
                                    name="titulo"
                                    id="titulo"
                                    value="{{ old('titulo', $noticia->titulo) }}"
                                    required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="adjunto" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                Archivo descargable (opcional)
                            </label>
                            <div class="mt-2 space-y-2">
                                @if ($noticia->adjunto_url)
                                    <a
                                        href="{{ $noticia->adjunto_url }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 rounded-md bg-slate-200 px-3 py-1.5 text-sm font-medium text-slate-800 hover:bg-slate-300 dark:bg-slate-700 dark:text-slate-100 dark:hover:bg-slate-600"
                                    >
                                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                        Descargar archivo actual
                                    </a>
                                @endif
                                <input
                                    type="file"
                                    name="adjunto"
                                    id="adjunto"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                                    class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-gray-400"
                                >
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Carga un nuevo archivo para reemplazar el existente (máx. 8 MB).
                            </p>
                        </div>

                        <div>
                            <label for="descripcion" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                Descripción corta
                            </label>
                            <div class="mt-2">
                                <textarea
                                    name="descripcion"
                                    id="descripcion"
                                    rows="3"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700"
                                >{{ old('descripcion', $noticia->descripcion) }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label for="contenido" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                Contenido
                            </label>
                            <div class="mt-2">
                                <textarea
                                    name="contenido"
                                    id="contenido"
                                    rows="6"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700"
                                >{{ old('contenido', $noticia->contenido) }}</textarea>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                    Imagen actual
                                </label>
                                <div class="mt-2">
                                    <img
                                        src="{{ $noticia->imagen_url }}"
                                        alt="{{ $noticia->titulo }}"
                                        class="h-32 w-full max-w-sm rounded object-cover"
                                    >
                                </div>
                            </div>

                            <div>
                                <label for="imagen" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                    Reemplazar imagen
                                </label>
                                <div class="mt-2">
                                    <input
                                        type="file"
                                        name="imagen"
                                        id="imagen"
                                        accept="image/*"
                                        class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-gray-400"
                                    >
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Déjalo vacío si deseas conservar la imagen actual.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                            <div class="sm:col-span-2">
                                <label for="estado" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                    Estado
                                </label>
                                <div class="mt-2">
                                    <select
                                        name="estado"
                                        id="estado"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700"
                                    >
                                        <option value="borrador" {{ old('estado', $noticia->estado) === 'borrador' ? 'selected' : '' }}>
                                            Borrador
                                        </option>
                                        <option value="publicada" {{ old('estado', $noticia->estado) === 'publicada' ? 'selected' : '' }}>
                                            Publicada
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="publicado_en" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                    Fecha de publicación
                                </label>
                                <div class="mt-2">
                                    <input
                                        type="datetime-local"
                                        name="publicado_en"
                                        id="publicado_en"
                                        value="{{ old('publicado_en', optional($noticia->publicado_en)->format('Y-m-d\TH:i')) }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700"
                                    >
                                </div>
                            </div>
                            <div class="sm:col-span-1">
                                <label for="orden" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                                    Orden
                                </label>
                                <div class="mt-2">
                                    <input
                                        type="number"
                                        name="orden"
                                        id="orden"
                                        min="1"
                                        value="{{ old('orden', $noticia->orden) }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-zinc-800 dark:text-white dark:ring-zinc-700"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 pt-6 dark:border-gray-700">
                            <a
                                href="{{ route('admin.noticias.index') }}"
                                class="text-sm font-semibold leading-6 text-gray-900 dark:text-white"
                            >
                                Cancelar
                            </a>
                            <button
                                type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>


