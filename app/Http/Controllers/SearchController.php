<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __invoke(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $term = mb_strtolower($q);

        $noticias = Noticia::publicadas()
            ->when($term !== '', function ($query) use ($term) {
                $query->where(function ($sub) use ($term) {
                    $sub->where('titulo', 'like', "%{$term}%")
                        ->orWhere('descripcion', 'like', "%{$term}%")
                        ->orWhere('contenido', 'like', "%{$term}%");
                });
            })
            ->latest('publicado_en')
            ->paginate(9)
            ->appends(['q' => $q]);

        $anuncios = Anuncio::vigentes()
            ->when($term !== '', function ($query) use ($term) {
                $query->where(function ($sub) use ($term) {
                    $sub->where('titulo', 'like', "%{$term}%")
                        ->orWhere('descripcion', 'like', "%{$term}%")
                        ->orWhere('url', 'like', "%{$term}%");
                });
            })
            ->orderBy('orden')
            ->get();

        $sections = $this->matchStaticSections($term);

        return view('search', [
            'q'        => $q,
            'noticias' => $noticias,
            'anuncios' => $anuncios,
            'sections' => $sections,
        ]);
    }

    private function matchStaticSections(string $term): array
    {
        $catalog = [
            [
                'title' => 'Quiénes somos',
                'url'   => route('quienes') . '#quienes-somos',
                'keywords' => ['quienes', 'somos', 'cooperativa', 'historia'],
            ],
            [
                'title' => 'Historia',
                'url'   => route('quienes') . '#historia',
                'keywords' => ['historia', 'origen', 'fundación'],
            ],
            [
                'title' => 'Misión y Visión',
                'url'   => route('quienes') . '#mision-vision',
                'keywords' => ['mision', 'visión', 'vision', 'mision y vision'],
            ],
            [
                'title' => 'Valores y Principios',
                'url'   => route('quienes') . '#valores-principios',
                'keywords' => ['valores', 'principios'],
            ],
            [
                'title' => 'Organización',
                'url'   => route('quienes') . '#organizacion',
                'keywords' => ['organizacion', 'órganos', 'organigrama'],
            ],
            [
                'title' => 'Servicios de Ahorro y Crédito',
                'url'   => route('servicios.ahorro'),
                'keywords' => ['ahorro', 'crédito', 'credito', 'servicios'],
            ],
            [
                'title' => 'Simulador de Créditos',
                'url'   => route('simulador'),
                'keywords' => ['simulador', 'credito', 'crédito'],
            ],
            [
                'title' => 'Agencias y Puntos de Atención',
                'url'   => route('agencias'),
                'keywords' => ['agencias', 'oficinas', 'puntos', 'atención'],
            ],
            [
                'title' => 'Transparencia',
                'url'   => url('/transparencia'),
                'keywords' => ['transparencia', 'estados financieros', 'memorias'],
            ],
            [
                'title' => 'Noticias',
                'url'   => route('noticias'),
                'keywords' => ['noticias', 'novedades'],
            ],
        ];

        if ($term === '') {
            return $catalog;
        }

        return array_values(array_filter($catalog, function ($item) use ($term) {
            foreach ($item['keywords'] as $kw) {
                if (str_contains($term, $kw)) {
                    return true;
                }
            }
            return false;
        }));
    }
}
