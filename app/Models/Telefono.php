<?php

namespace App\Models;

use App\Classes\Models\Model;
use App\Traits\TelefonableTrait;

class Telefono extends Model
{
    use TelefonableTrait;
    
    // Estados
    const TC_ESTADO  = 'TC_ESTADO_TELEFONOS';
    const ACTIVO     = 1;
    const INACTIVO   = 2;
    const ELIMINADO  = 3;

    const PRINCIPAL = 1;
    const ADICIONAL = 0;
    
    const TIENE_WHATSAPP    = 1;
    const NO_TIENE_WHATSAPP = 0;

    const TC_TIPO = 'TC_TIPOS_TELEFONOS';
    const MOVIL   = 1;
    const FIJO    = 2;
    
    protected $table = "telefonos";

    /** Campos que pueden ser usados en create/update. */
    protected $fillable = [
        'telefonable_type',
        'telefonable_id',
        'numero',
        'principal',
        'whatsapp',
        'tipo',
        'estado',
    ];

    public function telefonable()
    {
        return $this->morphTo("telefonable");
    }
    
    public static function darTipo($infoTipoConcepto = true)
    {
        return darConceptos(self::TC_TIPO, $infoTipoConcepto);
    }

    public static function darEstado($infoTipoConcepto = true)
    {
        return darConceptos(self::TC_ESTADO, $infoTipoConcepto);
    }

    public function infoEstado()
    {
        return darInfoConcepto($this, self::TC_ESTADO, 'estado')->selectRaw('conceptos.*');
    }

    public function infoTipo()
    {
        return darInfoConcepto($this, self::TC_TIPO, 'tipo')->selectRaw('conceptos.*');
    }
}
