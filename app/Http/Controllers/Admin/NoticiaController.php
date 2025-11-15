<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NoticiaController extends Controller
{
    public function index(): View
    {
        $noticias = Noticia::latest('publicado_en')
            ->latest()
            ->paginate(12);

        return view('admin.noticias.index', compact('noticias'));
    }

    public function create(): View
    {
        $noticia = new Noticia([
            'estado' => 'borrador',
            'orden' => 1,
        ]);

        return view('admin.noticias.create', compact('noticia'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request, true);

        $imagen = $request->file('imagen');
        $data['imagen'] = $this->storeFile($imagen, 'uploads/noticias');

        $data['orden'] = $data['orden'] ?? 1;

        if ($data['estado'] === 'publicada' && empty($data['publicado_en'])) {
            $data['publicado_en'] = now();
        }

        if ($request->hasFile('adjunto')) {
            $data['adjunto'] = $this->storeFile($request->file('adjunto'), 'uploads/noticias/archivos');
        }

        Noticia::create($data);

        return redirect()
            ->route('admin.noticias.index')
            ->with('ok', 'Noticia creada correctamente.');
    }

    public function edit(Noticia $noticia): View
    {
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia): RedirectResponse
    {
        $data = $this->validateData($request, false);

        if ($request->hasFile('imagen')) {
            $this->deletePublicFile($noticia->imagen);
            $data['imagen'] = $this->storeFile($request->file('imagen'), 'uploads/noticias');
        }

        $data['orden'] = $data['orden'] ?? $noticia->orden;

        if ($data['estado'] === 'publicada' && empty($data['publicado_en'])) {
            $data['publicado_en'] = now();
        }

        if ($request->hasFile('adjunto')) {
            $this->deletePublicFile($noticia->adjunto);
            $data['adjunto'] = $this->storeFile($request->file('adjunto'), 'uploads/noticias/archivos');
        }

        $noticia->update($data);

        return redirect()
            ->route('admin.noticias.index')
            ->with('ok', 'Noticia actualizada.');
    }

    public function destroy(Noticia $noticia): RedirectResponse
    {
        $this->deletePublicFile($noticia->imagen);
        $this->deletePublicFile($noticia->adjunto);

        $noticia->delete();

        return back()->with('ok', 'Noticia eliminada.');
    }

    public function toggle(Noticia $noticia): RedirectResponse
    {
        $noticia->estado = $noticia->estado === 'publicada' ? 'borrador' : 'publicada';

        if ($noticia->estado === 'publicada' && ! $noticia->publicado_en) {
            $noticia->publicado_en = now();
        }

        $noticia->save();

        return back()->with('ok', 'Estado actualizado.');
    }

    private function validateData(Request $request, bool $isCreate): array
    {
        return $request->validate([
            'titulo' => ['required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string'],
            'contenido' => ['nullable', 'string'],
            'imagen' => [$isCreate ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:6144'],
            'adjunto' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx', 'max:8192'],
            'estado' => ['required', 'in:borrador,publicada'],
            'publicado_en' => ['nullable', 'date'],
            'orden' => ['nullable', 'integer', 'min:1'],
        ]);
    }

    private function storeFile($file, string $directory): string
    {
        if (! $file) {
            return '';
        }

        $extension = $file->getClientOriginalExtension();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $slug = Str::slug($name) ?: 'archivo';
        $filename = time() . '_' . $slug . '.' . $extension;

        $destination = public_path($directory);
        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file->move($destination, $filename);

        return $directory . '/' . $filename;
    }

    private function deletePublicFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (str_starts_with($path, 'storage/')) {
            Storage::delete(str_replace('storage/', 'public/', $path));
            return;
        }

        $fullPath = public_path($path);
        if (File::exists($fullPath)) {
            @unlink($fullPath);
        }
    }
}


