<?php

namespace App\Models;

use App\Classes\Models\Model;
use App\Traits\Actividable;

class Tarea extends Model
{
    use Actividable;

    const TC_ESTADO    = 'TC_ESTADO_TAREAS';
    const PENDIENTE    = 1;
    const EN_EJECUCION = 2;
    const FINALIZADA   = 3;
    const ELIMINADO    = 0;

    protected $table = 'tareas';
    protected $fillable = [
        'cod_proyecto',
        'id_actividad',
        'titulo',
        'descripcion',
        'etiquetas',
        'valor',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'cod_usuario', 'id');
    }

    public function responsable()
    {
        return $this->hasOne(ResponsableTarea::class, 'cod_tarea', 'id');
    }

    public function responsables()
    {
        return $this->hasMany(ResponsableTarea::class, 'cod_tarea', 'id');
    }

    public function responsableActivo()
    {
        return $this->responsable()->where('estado', ResponsableTarea::ACTIVO);
    }

    public function responsablesActivos()
    {
        return $this->responsables()->where('estado', ResponsableTarea::ACTIVO);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'cod_proyecto', 'id');
    }
}
