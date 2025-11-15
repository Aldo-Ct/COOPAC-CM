<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspectoCredito extends Model
{
    protected $table = 'prospectos_credito';

    protected $fillable = [
        'nombre_completo','dni','celular',
        'monto_solicitado','plazo_meses','agencia',
        'cuota_estimada',
        'tipo_credito',
        'estado', // Añadido para que no falle al crear
    ];
}
