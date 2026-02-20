<?php

namespace App\Models;

use App\Classes\Models\Model;

class ResponsableProyecto extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    protected $table = 'responsables_proyectos';
    protected $fillable = [
        'cod_usuario',
        'cod_proyecto',
        'estado',
    ];

    protected $casts = [
        "created_at" => "date:d/m/Y",
    ];

    protected $dates = [
    ];

    public function infoEstado()
    {
        return darInfoConcepto($this, self::TC_ESTADO, 'estado')->selectRaw('conceptos.*');
    }

    public static function darEstado($infoTipoConcepto = true)
    {
        return darConceptos(self::TC_ESTADO, $infoTipoConcepto);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'cod_usuario', 'id');
    }
}
