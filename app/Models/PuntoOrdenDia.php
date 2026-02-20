<?php

namespace App\Models;

use App\Classes\Models\Model;
use Illuminate\Support\Str;

class PuntoOrdenDia extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    public $table = 'puntos_orden_dia';

    public $fillable = [
        'cod_acta',
        'numero',
        'titulo',
        'descripcion',
        'cod_responsable',
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

    public function acta()
    {
        return $this->belongsTo(ActaReunion::class, 'cod_acta', 'id');
    }

    public function responsable()
    {
        return $this->belongsTo(Usuario::class, 'cod_responsable', 'id');
    }
}
