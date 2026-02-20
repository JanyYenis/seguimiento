<?php

namespace App\Models;

use App\Classes\Models\Model;

class ActividadFase extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    protected $table = 'actividades_fases';

    protected $fillable = [
        'id',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'id_fase',
        'valor',
        'estado',
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'fase',
    ];

    public function fase()
    {
        return $this->belongsTo(Fase::class, 'id_fase', 'id');
    }
}
