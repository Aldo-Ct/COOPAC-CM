<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Noticia;

class MigrateNoticiasStorage extends Command
{
    protected $signature = 'coopac:migrate-noticias-storage {--dry-run}';
    protected $description = 'Move public/noticias files to public/uploads/noticias and update DB paths.';

    public function handle(): int
    {
        $dry = (bool)$this->option('dry-run');

        $fromBase = public_path('noticias');
        $toBase   = public_path('uploads/noticias');

        if (! File::exists($fromBase)) {
            $this->info('No existe public/noticias. Nada que migrar.');
            return self::SUCCESS;
        }

        if (! File::exists($toBase)) {
            if (! $dry) {
                File::makeDirectory($toBase, 0755, true);
            }
        }

        $moved = 0; $skipped = 0; $updated = 0;

        Noticia::withTrashed()->chunk(200, function ($items) use (&$moved, &$skipped, &$updated, $dry, $fromBase, $toBase) {
            foreach ($items as $n) {
                foreach (['imagen', 'adjunto'] as $field) {
                    $path = $n->{$field};
                    if (! $path || ! \Illuminate\Support\Str::startsWith($path, 'noticias/')) {
                        continue;
                    }

                    $rel = substr($path, strlen('noticias/')); // e.g. foo.jpg or archivos/bar.pdf
                    $from = public_path('noticias/' . $rel);
                    $to   = public_path('uploads/noticias/' . $rel);

                    // Asegurar carpeta destino
                    $dir = dirname($to);
                    if (! $dry && ! File::exists($dir)) {
                        File::makeDirectory($dir, 0755, true);
                    }

                    if (File::exists($from)) {
                        if (! $dry) {
                            @rename($from, $to);
                        }
                        $moved++;
                    } else {
                        $skipped++;
                    }

                    // Actualizar DB
                    $newPath = 'uploads/noticias/' . $rel;
                    if (! $dry) {
                        $n->{$field} = $newPath;
                        $n->save();
                    }
                    $updated++;
                }
            }
        });

        // Intentar eliminar carpeta antigua si quedó vacía
        if (! $dry) {
            @rmdir(public_path('noticias/archivos'));
            @rmdir(public_path('noticias'));
        }

        $this->info("Archivos movidos: {$moved}; registros actualizados: {$updated}; faltantes: {$skipped}");

        return self::SUCCESS;
    }
}

