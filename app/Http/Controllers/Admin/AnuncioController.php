<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnuncioController extends Controller
{
    protected function storeImage(Request $request): string
    {
        $dir = public_path('anuncios');
        if (! File::exists($dir)) {
            File::makeDirectory($dir, 0775, true);
        }

        $filename = uniqid('anuncio_').'.'.$request->file('imagen')->getClientOriginalExtension();
        $request->file('imagen')->move($dir, $filename);

        return 'anuncios/'.$filename;
    }

    protected function deleteImage(?string $relativePath): void
    {
        if (! $relativePath) {
            return;
        }

        $fullPath = public_path($relativePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }

    public function index()
    {
        $anuncios = Anuncio::orderBy('orden')->latest()->paginate(12);
        return view('admin.anuncios.index', compact('anuncios'));
    }

    public function create()
    {
        $anuncio = new Anuncio();
        return view('admin.anuncios.create', compact('anuncio'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['nullable','string','max:150'],
            'imagen' => ['required','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'url'    => ['nullable','url','max:255'],
            'activo' => ['nullable','boolean'],
            'orden'  => ['nullable','integer','min:1'],
            'desde'  => ['nullable','date'],
            'hasta'  => ['nullable','date','after_or_equal:desde'],
        ]);

        // subir imagen
        $data['imagen'] = $this->storeImage($request);
        $data['activo'] = (bool)($data['activo'] ?? true);
        $data['orden']  = $data['orden'] ?? 1;

        Anuncio::create($data);

        return redirect()->route('admin.anuncios.index')
            ->with('ok','Anuncio creado correctamente.');
    }

    public function edit(Anuncio $anuncio)
    {
        return view('admin.anuncios.edit', compact('anuncio'));
    }

    public function update(Request $request, Anuncio $anuncio)
    {
        $data = $request->validate([
            'titulo' => ['nullable','string','max:150'],
            'imagen' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'url'    => ['nullable','url','max:255'],
            'activo' => ['nullable','boolean'],
            'orden'  => ['nullable','integer','min:1'],
            'desde'  => ['nullable','date'],
            'hasta'  => ['nullable','date','after_or_equal:desde'],
        ]);

        if ($request->hasFile('imagen')) {
            $this->deleteImage($anuncio->imagen);
            $data['imagen'] = $this->storeImage($request);
        }

        $data['activo'] = (bool)($data['activo'] ?? false);
        $data['orden']  = $data['orden'] ?? $anuncio->orden;

        $anuncio->update($data);

        return redirect()->route('admin.anuncios.index')
            ->with('ok','Anuncio actualizado.');
    }

    public function destroy(Anuncio $anuncio)
    {
        // borrar archivo si era local
        $this->deleteImage($anuncio->imagen);
        $anuncio->delete();

        return back()->with('ok','Anuncio eliminado.');
    }

    public function toggle(Anuncio $anuncio)
    {
        $anuncio->update(['activo' => ! $anuncio->activo]);
        return back()->with('ok','Estado actualizado.');
    }
}
