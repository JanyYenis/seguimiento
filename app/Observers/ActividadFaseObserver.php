<?php

namespace App\Observers;

use App\Models\ActividadFase;
use App\Models\Fase;
use App\Models\PresupuestoProyecto;
use App\Models\CostoProyecto;
use App\Models\Facturaciones;
use App\Models\ProgresoProyecto;
use App\Models\Proyecto;
use App\Models\Tarea;
use App\Models\Usuario;
use App\Notifications\AproximacionPresupuestoNotification;

class ActividadFaseObserver
{
    /**
     * Handle the ActividadFase "created" event.
     */
    public function created(ActividadFase $actividad): void
    {
        $this->actualizarPresupuesto($actividad);
        $this->validarPresupuestonProyecto($actividad);
    }

    /**
     * Handle the ActividadFase "updated" event.
     */
    public function updated(ActividadFase $actividad): void
    {
        $this->actualizarPresupuesto($actividad);
        $this->validarPresupuestonProyecto($actividad);
    }

    /**
     * Handle the ActividadFase "deleted" event.
     */
    public function deleted(ActividadFase $actividad): void
    {
        //
    }

    /**
     * Handle the ActividadFase "restored" event.
     */
    public function restored(ActividadFase $actividad): void
    {
        //
    }

    /**
     * Handle the ActividadFase "force deleted" event.
     */
    public function forceDeleted(ActividadFase $actividad): void
    {
        //
    }

    //Esta funcion sirve para actualizar los costos y los presupuestos
    public function actualizarPresupuesto(ActividadFase $actividad)
    {
        // Actualizar componente
        $fase = Fase::with('actividadesActivas')->find($actividad->id_fase);

        if ($fase) {
            $totalValorfase = $fase->actividadesActivas->sum('valor');
            $fase->update([
                'valor' => $totalValorfase,
            ]);
        }

        // Actualizar proyecto
        $proyecto = Proyecto::with([
            'fases.actividadesActivas',
            'tareasActivas',
            'presupuestoActivo'
        ])->find($fase->id_proyecto ?? null);

        if ($proyecto?->presupuestoActivo) {
            $totalGastado = 0;

            foreach ($proyecto->fases as $fas) {
                foreach ($fas->actividadesActivas as $act) {
                    $tareasActividad = $proyecto->tareasActivas->where('id_actividad', $act->id);

                    if ($tareasActividad->isNotEmpty()) {
                        $totalGastado += $tareasActividad->sum('valor');
                    } else {
                        $totalGastado += $act->valor;
                    }
                }
            }
        }
    }

    public function validarPresupuestonProyecto(ActividadFase $actividad)
    {
        if ($actividad->wasChanged('valor')) {
            $proyecto = Proyecto::with(
                'presupuestoActivo',
                'responsablesActivos',
            )->find($actividad?->componente?->id_proyecto);

            if ($proyecto?->presupuestoActivo) {
                if (($proyecto->presupuestoActivo->valor / 2) <= ($proyecto->presupuestoActivo->costo_gastador)) {
                    foreach ($proyecto->responsablesActivos as $responsable) {
                        $usuarioResponsable = Usuario::find($responsable->cod_usuario);
                        $usuarioResponsable->notify(new AproximacionPresupuestoNotification($usuarioResponsable, $proyecto));
                    }
                }
            }
        }
    }
}
