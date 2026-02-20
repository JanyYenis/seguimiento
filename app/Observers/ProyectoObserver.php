<?php

namespace App\Observers;

use App\Models\Proyecto;
use App\Models\Usuario;
use App\Notifications\FinalizacionProyectoNotification;

class ProyectoObserver
{
    /**
     * Handle the Proyecto "created" event.
     */
    public function created(Proyecto $proyecto): void
    {
        //
    }

    /**
     * Handle the Proyecto "updated" event.
     */
    public function updated(Proyecto $proyecto): void
    {
        $this->validarFinalizacionProyecto($proyecto);
    }

    /**
     * Handle the Proyecto "deleted" event.
     */
    public function deleted(Proyecto $proyecto): void
    {
        //
    }

    /**
     * Handle the Proyecto "restored" event.
     */
    public function restored(Proyecto $proyecto): void
    {
        //
    }

    /**
     * Handle the Proyecto "force deleted" event.
     */
    public function forceDeleted(Proyecto $proyecto): void
    {
        //
    }
    public function validarFinalizacionProyecto(Proyecto $proyecto)
    {
        if ($proyecto->wasChanged('estado')) {
            if ($proyecto->estado == Proyecto::COMPLETADO) {
                $proyecto->load('responsablesActivos');
                foreach ($proyecto->responsablesActivos as $responsable) {
                    $usuarioResponsable = Usuario::find($responsable->cod_usuario);
                    $usuarioResponsable->notify(new FinalizacionProyectoNotification($usuarioResponsable, $proyecto));
                }
            }
        }
    }
}
