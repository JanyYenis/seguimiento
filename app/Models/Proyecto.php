<?php

namespace App\Models;

use App\Classes\Models\Model;
use App\Traits\Actividable;

class Proyecto extends Model
{
    use Actividable;
    const TC_ESTADO   = 'TC_ESTADO_PROYECTOS';
    const ACTIVO      = 1;
    const EN_PROGRESO = 2;
    const COMPLETADO  = 3;
    const RIESGO      = 4;
    const ELIMINADO   = 0;

    protected $table = 'proyectos';
    protected $appends = ['progreso'];
    protected $fillable = [
        'logo',
        'nombre',
        'tipo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'fecha_inicio_garantia',
        'fecha_fin_garantia',
        'email',
        'tel',
        'responsable_id',
        'cod_cliente',
        'estado',
    ];

    protected $casts = [
        "fecha_inicio" => "date:d/m/Y",
        "fecha_fin" => "date:d/m/Y",
        "fecha_inicio_garantia" => "date:d/m/Y",
        "fecha_fin_garantia" => "date:d/m/Y",
        "created_at" => "date:d/m/Y",
    ];

    protected $dates = [
        "fecha_inicio" => "date:d/m/Y",
        "fecha_fin" => "date:d/m/Y",
        "fecha_inicio_garantia" => "date:d/m/Y",
        "fecha_fin_garantia" => "date:d/m/Y",
    ];

    public function infoEstado()
    {
        return darInfoConcepto($this, self::TC_ESTADO, 'estado')->selectRaw('conceptos.*');
    }

    public static function darEstado($infoTipoConcepto = true)
    {
        return darConceptos(self::TC_ESTADO, $infoTipoConcepto);
    }

    public function gestor()
    {
        return $this->belongsTo(Usuario::class, 'responsable_id', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'cod_cliente', 'id');
    }

    public function responsables()
    {
        return $this->hasMany(ResponsableProyecto::class, 'cod_proyecto', 'id');
    }

    public function responsablesActivos()
    {
        return $this->responsables()->where('estado', ResponsableProyecto::ACTIVO);
    }

    public function presupuesto()
    {
        return $this->hasOne(PresupuestoProyecto::class, 'cod_proyecto', 'id');
    }

    public function presupuestoActivo()
    {
        return $this->presupuesto()->where('estado', PresupuestoProyecto::ACTIVO);
    }

    public function fases()
    {
        return $this->hasMany(Fase::class, 'id_proyecto', 'id');
    }

    public function fasesActivas()
    {
        return $this->fases()->whereNot('estado', Fase::ELIMINADO);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'cod_proyecto', 'id');
    }

    public function tareasActivas()
    {
        return $this->tareas()->whereNot('estado', Tarea::ELIMINADO);
    }

    public function tareasEnProgreso()
    {
        return $this->tareas()->where('estado', Tarea::EN_EJECUCION);
    }

    public function tareasPendientes()
    {
        return $this->tareas()->where('estado', Tarea::PENDIENTE);
    }

    public function tareasFinalizadas()
    {
        return $this->tareas()->where('estado', Tarea::FINALIZADA);
    }

    public function getProgresoAttribute()
    {
        $progreso = 0;

        $cantidad_tareas = count($this->tareasActivas) ?? 0;
        $cantidad_tareas_ejecucion = count($this->tareasEnProgreso) ? (count($this->tareasEnProgreso) * 0.5) : 0;
        $cantidad_tareas_finalizadas = count($this->tareasFinalizadas) ? (count($this->tareasFinalizadas) * 1) : 0;

        if ($cantidad_tareas) {
            $progreso = (($cantidad_tareas_ejecucion) + ($cantidad_tareas_finalizadas) / $cantidad_tareas) * 100;
        }

        return $progreso;
    }
}
