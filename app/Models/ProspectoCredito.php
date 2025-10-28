<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspectoCredito extends Model
{
    protected $table = 'prospectos_credito';

    protected $fillable = [
        'nombre_completo',
        'dni',
        'celular',
        'monto_solicitado',
        'plazo_meses',
        'tipo_credito',
        'estado',
        'agencia',
    ];
}
