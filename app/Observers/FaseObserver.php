<?php

namespace App\Observers;

use App\Models\Fase;
use App\Models\Proyecto;
use App\Models\Usuario;
use App\Notifications\AproximacionPresupuestoNotification;

class FaseObserver
{
    /**
     * Handle the Fase "created" event.
     */
    public function created(Fase $fase): void
    {
        // $this->actualizarPresupuesto($fase);
        $this->validarPresupuestonProyecto($fase);
    }

    /**
     * Handle the Fase "updated" event.
     */
    public function updated(Fase $fase): void
    {
        // $this->actualizarPresupuesto($fase);
        $this->validarPresupuestonProyecto($fase);
    }

    /**
     * Handle the Fase "deleted" event.
     */
    public function deleted(Fase $fase): void
    {
        //
    }

    /**
     * Handle the Fase "restored" event.
     */
    public function restored(Fase $fase): void
    {
        //
    }

    /**
     * Handle the Fase "force deleted" event.
     */
    public function forceDeleted(Fase $fase): void
    {
        //
    }

    // public function actualizarPresupuesto(Fase $fase)
    // {
    //     $proyecto = Proyecto::with(
    //         'tareasActivas',
    //         'presupuestoActivo',
    //         'fasesActivas.actividadesActivas',
    //     )->find($fase?->id_proyecto);

    //     $totalGastado = 0;
    //     $totalGastado1 = 0;
    //     $totalGastado2 = 0;

    //     foreach ($proyecto->tareasActivas as $value) {
    //         $totalGastado += (int) $value?->valor ?? 0;
    //     }

    //     if ($proyecto?->presupuestoActivo) {
    //         $proyecto->presupuestoActivo->update(['valor_gastador' => $totalGastado]);
    //     }

    //     foreach ($proyecto->tareasActivas->where('id_actividad', $actividad->cod_actividad) as $value) {
    //         $totalGastado1 += (int) $value?->valor ?? 0;
    //     }

    //     $actividad->update(['valor' => $totalGastado1]);

    //     foreach ($proyecto->FaseActivas->where('id', $fase->id) as $value) {
    //         foreach ($value->actividadesActivas as $item) {
    //             $totalGastado2 += (int) $item?->valor ?? 0;
    //         }
    //     }

    //     $fase->update(['valor' => $totalGastado2]);
    // }

    public function validarPresupuestonProyecto(Fase $fase)
    {
        if ($fase->wasChanged('valor')) {
            $proyecto = Proyecto::with(
                'presupuestoActivo',
                'responsablesActivos',
            )->find($fase?->id_proyecto);

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
