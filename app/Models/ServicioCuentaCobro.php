<?php

namespace App\Models;

use App\Classes\Models\Model;
use Illuminate\Support\Str;

class ServicioCuentaCobro extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    public $table = 'servicios_cuentas_cobros';

    public $fillable = [
        'cod_cuenta',
        'cod_fase',
        'cantidad',
        'valor',
        'estado',
    ];

    protected $casts = [
        'id' => 'string', // Esto fuerza a que el UUID se mantenga como string
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function cuenta()
    {
        return $this->belongsTo(CuentaCobro::class, 'cod_cuenta', 'id');
    }

    public function fase()
    {
        return $this->belongsTo(Fase::class, 'cod_fase', 'id');
    }
}
