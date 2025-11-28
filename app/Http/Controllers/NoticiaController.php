<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\View\View;

class NoticiaController extends Controller
{
    /**
     * Lista de noticias públicas.
     */
    public function index(): View
    {
        $noticias = Noticia::publicadas()
            ->latest('publicado_en')
            ->paginate(9);

        return view('noticias', compact('noticias'));
    }
}

