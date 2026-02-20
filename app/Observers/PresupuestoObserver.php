<?php

namespace App\Observers;

use App\Models\PresupuestoProyecto;
use App\Models\Proyecto;
use App\Models\Usuario;
use App\Notifications\AproximacionPresupuestoNotification;
use App\Notifications\CambioPresupuestoNotification;
use Illuminate\Support\Facades\Log;

class PresupuestoObserver
{
    /**
     * Handle the PresupuestoProyecto "created" event.
     */
    public function created(PresupuestoProyecto $presupuesto): void
    {
        $this->actualizarPresupuesto($presupuesto);
        $this->validarPresupuestonProyecto($presupuesto);
        $this->notificarCambioPresupuesto($presupuesto);
    }

    /**
     * Handle the PresupuestoProyecto "updated" event.
     */
    public function updated(PresupuestoProyecto $presupuesto): void
    {
        $this->actualizarPresupuesto($presupuesto);
        $this->validarPresupuestonProyecto($presupuesto);
        $this->notificarCambioPresupuesto($presupuesto);
    }

    /**
     * Handle the PresupuestoProyecto "deleted" event.
     */
    public function deleted(PresupuestoProyecto $presupuesto): void
    {
        //
    }

    /**
     * Handle the PresupuestoProyecto "restored" event.
     */
    public function restored(PresupuestoProyecto $presupuesto): void
    {
        //
    }

    /**
     * Handle the PresupuestoProyecto "force deleted" event.
     */
    public function forceDeleted(PresupuestoProyecto $presupuesto): void
    {
        //
    }

    public function actualizarPresupuesto(PresupuestoProyecto $presupuesto)
    {
        $proyecto = Proyecto::with(
            'tareasActivas',
            'presupuestoActivo',
            'fasesActivas.actividadesActivas',
        )->find($presupuesto?->cod_proyecto_cliente);

        $totalGastado = 0;

        foreach ($proyecto->tareasActivas as $value) {
            $totalGastado += (int) $value?->valor ?? 0;
        }

        foreach ($proyecto->fasesActivas as $value) {
            $totalGastado += (int) $value?->valor ?? 0;
            foreach ($value->actividadesActivas as $item) {
                $totalGastado += (int) $item?->valor ?? 0;
            }
        }
    }

    public function validarPresupuestonProyecto(PresupuestoProyecto $presupuesto)
    {
        if ($presupuesto->wasChanged('valor')) {
            $proyecto = Proyecto::with(
                'presupuestoActivo',
                'responsablesActivos',
            )->find($presupuesto?->cod_proyecto_cliente);

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

    public function notificarCambioPresupuesto(PresupuestoProyecto $presupuesto)
    {
        if ($presupuesto->wasRecentlyCreated) {
            // Obtener el último presupuesto ACTIVO que no sea este mismo
            $anteriorPresupuesto = PresupuestoProyecto::where('cod_proyecto_cliente', $presupuesto->cod_proyecto_cliente)
                ->where('estado', PresupuestoProyecto::ACTIVO)
                ->where('id', '!=', $presupuesto->id)
                ->latest('created_at')
                ->first();

            // Si no hay presupuesto anterior activo, buscar cualquier inactivo reciente
            if (!$anteriorPresupuesto) {
                $anteriorPresupuesto = PresupuestoProyecto::where('cod_proyecto_cliente', $presupuesto->cod_proyecto_cliente)
                    ->where('estado', PresupuestoProyecto::INACTIVO)
                    ->where('id', '!=', $presupuesto->id)
                    ->latest('created_at')
                    ->first();
            }

            if (!$anteriorPresupuesto) {
                Log::info("No se encontró presupuesto anterior para nuevo presupuesto: {$presupuesto->id}");
                return;
            }

            $anterior = $anteriorPresupuesto->valor;
            $actual = $presupuesto->valor;

            if ($anterior == $actual) {
                return;
            }
        } else if ($presupuesto->wasChanged('valor')) {
            $anterior = $presupuesto->getOriginal('valor');
            $actual = $presupuesto->valor;

            if ($anterior == $actual) {
                return;
            }
        } else {
            return;
        }

        $totalCambiado = $actual - $anterior;
        $proyecto = Proyecto::with('responsablesActivos')
            ->find($presupuesto->cod_proyecto_cliente);

        $usuarioAutor = $presupuesto->usuario;

        $porcentajeCambio = 0;
        if ($anterior != 0) {
            $porcentajeCambio = (abs($totalCambiado) / $anterior) * 100;
        } else {
            $porcentajeCambio = 100; // Si anterior es 0, cualquier cambio es 100%
        }

        // Notificar a los responsables
        foreach ($proyecto->responsablesActivos as $responsable) {
            $usuarioResponsable = Usuario::find($responsable->cod_usuario);

            $usuarioResponsable->notify(new CambioPresupuestoNotification(
                $usuarioAutor,
                $proyecto,
                $anterior,
                $actual,
                $totalCambiado,
                $porcentajeCambio
            ));
        }
    }
}
