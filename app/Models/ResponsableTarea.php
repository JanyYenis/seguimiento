<?php

namespace App\Models;

use App\Classes\Models\Model;

class ResponsableTarea extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    protected $table = 'responsables_tareas';
    protected $fillable = [
        'cod_tarea',
        'cod_responsable',
        'estado',
    ];

    public function responsable()
    {
        return $this->belongsTo(Usuario::class, 'cod_responsable', 'id');
    }

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'cod_tarea', 'id');
    }
}
