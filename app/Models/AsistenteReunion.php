<?php

namespace App\Models;

use App\Classes\Models\Model;
use Illuminate\Support\Str;

class AsistenteReunion extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    public $table = 'asistentes_reuniones';

    public $fillable = [
        'cod_acta',
        'nombre',
        'rol',
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
}
