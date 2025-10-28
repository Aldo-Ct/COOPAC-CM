<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Simulacion extends Model
{
    use HasFactory;

    // Default table name. If your project stores the data in
    // `prospectos_credito` set SIMULACION_TABLE=prospectos_credito in .env
    protected $table = 'simulaciones';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // allow runtime override via env (cannot call env() in a property default)
        if ($envTable = env('SIMULACION_TABLE')) {
            $this->table = $envTable;
            return;
        }

        // auto-detect legacy table name if present
        if (Schema::hasTable('prospectos_credito')) {
            $this->table = 'prospectos_credito';
        }
    }

    protected $fillable = [
        // legacy column in prospectos_credito is `nombre_completo`
        'nombre',
        'nombre_completo',
        'dni',
        'celular',
        'monto_solicitado',
        'plazo_meses',
        'tipo_credito',
        'agencia',
        'estado',
        'asesor_id',
    ];

    protected $casts = [
        'monto_solicitado' => 'decimal:2',
        'plazo_meses' => 'integer',
    ];

    public function asesor()
    {
        return $this->belongsTo(User::class, 'asesor_id');
    }

    /**
     * Accessor to return `nombre` for legacy tables that store the full name
     * in `nombre_completo` (e.g. prospectos_credito). This makes the view
     * compatible without changing column names in templates.
     */
    public function getNombreAttribute()
    {
        if (array_key_exists('nombre', $this->attributes) && $this->attributes['nombre']) {
            return $this->attributes['nombre'];
        }

        return $this->attributes['nombre_completo'] ?? null;
    }
}
