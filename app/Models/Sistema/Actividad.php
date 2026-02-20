<?php

namespace App\Models\Sistema;

use App\Classes\Models\Model;
use App\Models\Usuario;

class Actividad extends Model
{
    protected $table = 'actividades';
    protected $fillable = [
        'cod_usuario',
        'accion',
        'actividable_type',
        'actividable_id',
        'changes',
    ];

    public function actividable()
    {
        return $this->morphTo();
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
