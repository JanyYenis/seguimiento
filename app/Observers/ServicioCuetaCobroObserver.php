<?php

namespace App\Observers;

use App\Models\CuentaCobro;
use App\Models\ServicioCuentaCobro;

class ServicioCuetaCobroObserver
{
    /**
     * Handle the ServicioCuentaCobro "created" event.
     */
    public function created(ServicioCuentaCobro $servicio): void
    {
        $this->actualizarValor($servicio);
    }

    /**
     * Handle the ServicioCuentaCobro "updated" event.
     */
    public function updated(ServicioCuentaCobro $servicio): void
    {
        $this->actualizarValor($servicio);
    }

    /**
     * Handle the ServicioCuentaCobro "deleted" event.
     */
    public function deleted(ServicioCuentaCobro $servicio): void
    {
        $this->actualizarValor($servicio);
    }

    /**
     * Handle the ServicioCuentaCobro "restored" event.
     */
    public function restored(ServicioCuentaCobro $servicio): void
    {
        //
    }

    /**
     * Handle the ServicioCuentaCobro "force deleted" event.
     */
    public function forceDeleted(ServicioCuentaCobro $servicio): void
    {
        //
    }

    public function actualizarValor(ServicioCuentaCobro $servicio)
    {
        if ($servicio->wasChanged('valor') || $servicio->wasChanged('estado')) {
            $total = ServicioCuentaCobro::selectRaw('SUM(valor) as total')
                ->where('estado', ServicioCuentaCobro::ACTIVO)
                ->where('cod_cuenta', $servicio->cod_cuenta)
                ->first()?->total ?? 0;

            CuentaCobro::find($servicio->cod_cuenta)->update(['valor' => $total]);
        }
    }
}
