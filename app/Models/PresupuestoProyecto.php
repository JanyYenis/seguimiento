<?php

namespace App\Models;

use App\Classes\Models\Model;
use App\Traits\Actividable;

class PresupuestoProyecto extends Model
{
    use Actividable;

    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    protected $table = 'presupuestos_proyectos';
    protected $fillable = [
        'cod_proyecto',
        'descripcion',
        'valor',
        'valor_gastador',
        'email',
        'tel',
        'estado',
    ];

    protected $casts = [
        "created_at" => "date:d/m/Y",
    ];

    protected $dates = [
        "created_at" => "date:d/m/Y",
    ];

    public function infoEstado()
    {
        return darInfoConcepto($this, self::TC_ESTADO, 'estado')->selectRaw('conceptos.*');
    }

    public static function darEstado($infoTipoConcepto = true)
    {
        return darConceptos(self::TC_ESTADO, $infoTipoConcepto);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'cod_proyecto', 'id');
    }
}
