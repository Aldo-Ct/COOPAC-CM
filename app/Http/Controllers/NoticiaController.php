<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\View\View;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    /**
     * Lista de noticias públicas.
     */
    public function index(): View
    {
        $noticias = Noticia::publicadas()
            ->latest('publicado_en')
            ->latest()
            ->paginate(9);

        return view('noticias', compact('noticias'));
    }

    /**
     * Búsqueda simple de noticias por título/descripcion/contenido.
     */
    public function search(Request $request): View
    {
        $q = trim($request->query('q', ''));

        $noticias = Noticia::publicadas()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('titulo', 'like', "%{$q}%")
                        ->orWhere('descripcion', 'like', "%{$q}%")
                        ->orWhere('contenido', 'like', "%{$q}%");
                });
            })
            ->latest('publicado_en')
            ->latest()
            ->paginate(9)
            ->appends(['q' => $q]);

        return view('noticias', compact('noticias'));
    }
}


