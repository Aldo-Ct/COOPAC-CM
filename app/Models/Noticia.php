<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Noticia extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'slug',
        'descripcion',
        'contenido',
        'imagen',
        'adjunto',
        'publicado_en',
        'estado',
        'orden',
    ];

    protected $casts = [
        'publicado_en' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $noticia) {
            if (! $noticia->slug) {
                $noticia->slug = static::generateUniqueSlug($noticia->titulo);
            }
        });

        static::updating(function (self $noticia) {
            if ($noticia->isDirty('titulo')) {
                $noticia->slug = static::generateUniqueSlug($noticia->titulo, $noticia->getKey());
            }
        });
    }

    public function scopePublicadas($query)
    {
        return $query
            ->where('estado', 'publicada')
            ->where(function ($q) {
                $q->whereNull('publicado_en')
                  ->orWhere('publicado_en', '<=', now());
            });
    }

    public function getImagenUrlAttribute(): string
    {
        if (! $this->imagen) {
            return 'https://placehold.co/640x360?text=Noticia';
        }

        if (Str::startsWith($this->imagen, ['http://', 'https://'])) {
            return $this->imagen;
        }

        return asset($this->imagen);
    }

    public function getAdjuntoUrlAttribute(): ?string
    {
        if (! $this->adjunto) {
            return null;
        }

        if (Str::startsWith($this->adjunto, ['http://', 'https://'])) {
            return $this->adjunto;
        }

        return asset($this->adjunto);
    }

    public function getResumenAttribute(): string
    {
        $contenido = $this->descripcion ?? $this->contenido ?? '';
        return Str::limit(strip_tags($contenido), 160);
    }

    protected static function generateUniqueSlug(string $titulo, ?int $ignoreId = null): string
    {
        $slugBase = Str::slug($titulo) ?: Str::random(8);
        $slug = $slugBase;
        $counter = 1;

        while (static::withTrashed()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $slugBase . '-' . ++$counter;
        }

        return $slug;
    }
}


