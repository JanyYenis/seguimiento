<?php

namespace App\Models;

use App\Classes\Models\Model;

class Calendario extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO = 1;
    const INACTIVO = 2;
    const ELIMINADO = 0;

    const TC_TIPO_DIA_CALENDARIO = 'TC_TIPO_DIA_CALENDARIO';
    const SI = 1;
    const NO = 0;

    protected $table = 'calendarios';
    protected $fillable = [
        'id_usuario',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'dia',
        'url',
        'estado',
    ];

    public function infoDia()
    {
        return darInfoConcepto($this, self::TC_TIPO_DIA_CALENDARIO, 'dia')->selectRaw('conceptos.*');
    }

    public static function darTipoGenero($infoTipoConcepto = true)
    {
        return darConceptos(self::TC_TIPO_DIA_CALENDARIO, $infoTipoConcepto);
    }
}
