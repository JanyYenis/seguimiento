<?php

namespace App\Models;

use App\Classes\Models\Model;

class Fase extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    public $table = 'fases';

    public $fillable = [
        'id',
        'titulo',
        'descripcion',
        'id_proyecto',
        'valor',
        'created_at',
        'updated_at',
    ];

    public function actividades()
    {
        return $this->hasMany(ActividadFase::class, 'id_fase', 'id');
    }

    public function actividadesActivas()
    {
        return $this->actividades()->where('estado', ActividadFase::ACTIVO);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto', 'id');
    }
}
