<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Anuncio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo', 'descripcion', 'imagen', 'url', 'activo', 'orden', 'desde', 'hasta',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'desde'  => 'date',
        'hasta'  => 'date',
    ];

    // URL absoluta para la imagen
    public function getImagenUrlAttribute(): string
    {
        if (! $this->imagen) {
            return asset('anuncios/placeholder.png');
        }

        if (Str::startsWith($this->imagen, ['http://', 'https://'])) {
            return $this->imagen;
        }

        return asset(ltrim($this->imagen, '/'));
    }

    // Scope activos y vigentes por fecha
    public function scopeVigentes($q)
    {
        $hoy = now()->startOfDay();
        return $q->where('activo', true)
                 ->where(function($qq) use ($hoy){
                     $qq->whereNull('desde')->orWhere('desde','<=',$hoy);
                 })
                 ->where(function($qq) use ($hoy){
                     $qq->whereNull('hasta')->orWhere('hasta','>=',$hoy);
                 });
    }
}
