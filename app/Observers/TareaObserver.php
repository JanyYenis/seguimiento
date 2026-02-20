<?php

namespace App\Observers;

use App\Models\ActividadesComponentes;
use App\Models\Componentes;
use App\Models\CostoProyecto;
use App\Models\Facturaciones;
use App\Models\ProgresoProyecto;
use App\Models\ProyectoCliente;
use App\Models\Tarea;
use App\Models\Usuario;
use App\Notifications\AproximacionPresupuestoNotification;
use App\Notifications\FinalizacionProyectoNotification;
use Illuminate\Support\Facades\Auth;

class TareaObserver
{
    /**
     * Handle the Tarea "created" event.
     */
    public function created(Tarea $tarea): void
    {
        $this->actualizarEstadoProyecto($tarea);
        $this->actualizarPresupuestoCrear($tarea);
        $this->actualizarProgresoProyectoCrear($tarea);
        $this->actualizarCostoProyectoCrear($tarea);
        $this->actualizarFacturacionProyectoCrear($tarea);
        $this->validarPresupuestonProyecto($tarea);
    }

    /**
     * Handle the Tarea "updated" event.
     */
    public function updated(Tarea $tarea): void
    {
        $this->actualizarEstadoProyecto($tarea);
        $this->actualizarPresupuesto($tarea);
        $this->actualizarCostoProyecto($tarea);
        $this->actualizarProgresoProyecto($tarea);
        $this->actualizarFacturacionProyecto($tarea);
        // $this->validarFinalizacionProyecto($tarea);
        $this->validarPresupuestonProyecto($tarea);
    }

    /**
     * Handle the Tarea "deleted" event.
     */
    public function deleted(Tarea $tarea): void
    {
        //
    }

    /**
     * Handle the Tarea "restored" event.
     */
    public function restored(Tarea $tarea): void
    {
        //
    }

    /**
     * Handle the Tarea "force deleted" event.
     */
    public function forceDeleted(Tarea $tarea): void
    {
        //
    }

    public function actualizarEstadoProyecto(Tarea $tarea)
    {
        $proyecto = ProyectoCliente::with(
            'tareasEnProgreso',
            'tareasPendientes',
            'tareasFinalizadas',
            'tareasActivas'
        )->find($tarea?->cod_proyecto_cliente);
        if (count($proyecto?->tareasActivas) == count($proyecto?->tareasFinalizadas)) {
            $proyecto->update(['estado' => ProyectoCliente::COMPLETADO]);
        }
        if (count($proyecto?->tareasEnProgreso)) {
            $proyecto->update(['estado' => ProyectoCliente::EN_PROGRESO]);
        } else {
            $proyecto->update(['estado' => ProyectoCliente::ACTIVO]);
        }
    }

    public function actualizarPresupuesto(Tarea $tarea)
    {
        if ($tarea->wasChanged('valor')) {
            $proyecto = ProyectoCliente::with(
                'tareasActivas',
                'presupuestoActivo',
                'componentesActivas.actividadesActivas',
                'costoProyectoActivo',
            )->find($tarea?->cod_proyecto_cliente);

            $totalGastado = 0;
            $totalGastado1 = 0;
            $totalGastado2 = 0;

            foreach ($proyecto->tareasActivas as $value) {
                $totalGastado += (int) $value?->valor ?? 0;
            }

            foreach ($proyecto->tareasActivas->where('id_actividad', $tarea->id_actividad) as $value) {
                $totalGastado1 += (int) $value?->valor ?? 0;
            }

            $actividad = ActividadesComponentes::find($tarea->id_actividad);
            $actividad->update(['valor' => $totalGastado1]);

            $componente = Componentes::with('actividadesActivas')->find($actividad->id_componente);
            foreach ($componente->actividadesActivas as $item) {
                $totalGastado2 += (int) $item?->valor ?? 0;
            }

            $componente->update(['valor' => $totalGastado2]);
        }
    }

    public function actualizarPresupuestoCrear(Tarea $tarea)
    {
        # code...

        $proyecto = ProyectoCliente::with(
            'tareasActivas',
            'presupuestoActivo',
            'componentesActivas.actividadesActivas',
            'costoProyectoActivo',
        )->find($tarea?->cod_proyecto_cliente);

        $totalGastado = 0;
        $totalGastado1 = 0;
        $totalGastado2 = 0;

        foreach ($proyecto->tareasActivas as $value) {
            $totalGastado += (int) $value?->valor ?? 0;
        }

        foreach ($proyecto->tareasActivas->where('id_actividad', $tarea->id_actividad) as $value) {
            $totalGastado1 += (int) $value?->valor ?? 0;
        }

        $actividad = ActividadesComponentes::find($tarea->id_actividad);
        $actividad->update(['valor' => $totalGastado1]);

        $componente = Componentes::with('actividadesActivas')->find($actividad->id_componente);
        foreach ($componente->actividadesActivas as $item) {
            $totalGastado2 += (int) $item?->valor ?? 0;
        }

        $componente->update(['valor' => $totalGastado2]);
    }

    public function actualizarCostoProyecto(Tarea $tarea)
    {
        if (! $tarea->wasChanged('costo')) {
            return;
        }

        // Cargar proyecto con sus componentes, actividades y tareas
        $proyecto = ProyectoCliente::with([
            'componentesActivas.actividadesActivas.tareasActivas',
            'presupuestoActivo'
        ])->find($tarea->cod_proyecto_cliente);

        if (! $proyecto) {
            return;
        }

        // 1) Actualizar costo de la actividad donde pertenece la tarea
        $actividad = ActividadesComponentes::with('tareasActivas')
            ->find($tarea->id_actividad);

        // Si la actividad tiene tareas, sumarlas; si no, dejar su costo actual
        $nuevoCostoActividad = $actividad->tareasActivas->isNotEmpty()
            ? $actividad->tareasActivas->sum('costo')
            : $actividad->costo;

        $actividad->update(['costo' => $nuevoCostoActividad]);

        // 2) Actualizar costo del componente padre
        $componente = Componentes::with('actividadesActivas.tareasActivas')
            ->find($actividad->id_componente);

        $nuevoCostoComponente = $componente->actividadesActivas->sum(function ($act) {
            if ($act->tareasActivas->isNotEmpty()) {
                return $act->tareasActivas->sum('costo');
            }
            // Si la actividad no tiene tareas, usar su propio costo
            return $act->costo;
        });

        $componente->update(['costo' => $nuevoCostoComponente]);

        // 3) Calcular costo total del proyecto
        $totalGastado = $proyecto->componentesActivas->sum(function ($comp) {
            return $comp->actividadesActivas->sum(function ($act) {
                return $act->tareasActivas->isNotEmpty()
                    ? $act->tareasActivas->sum('costo')
                    : $act->costo;
            });
        });

        // 4) Registrar en la tabla de costos solo si existe presupuesto activo
        if ($proyecto->presupuestoActivo) {
            // Inactivar el registro anterior
            CostoProyecto::where('cod_proyecto_cliente', $proyecto->id)
                ->where('estado', CostoProyecto::ACTIVO)
                ->update([
                    'estado'     => CostoProyecto::INACTIVO,
                    'updated_at' => now(),
                ]);

            // Crear uno nuevo con el total actualizado
            CostoProyecto::create([
                'costo'                => $totalGastado,
                'estado'               => CostoProyecto::ACTIVO,
                'id_usuario'           => auth()->id(),
                'cod_proyecto_cliente' => $proyecto->id,
            ]);
        }
    }

    public function actualizarCostoProyectoCrear(Tarea $tarea)
    {

        // Cargar proyecto con sus componentes, actividades y tareas
        $proyecto = ProyectoCliente::with([
            'componentesActivas.actividadesActivas.tareasActivas',
            'presupuestoActivo'
        ])->find($tarea->cod_proyecto_cliente);

        if (! $proyecto) {
            return;
        }

        // 1) Actualizar costo de la actividad donde pertenece la tarea
        $actividad = ActividadesComponentes::with('tareasActivas')
            ->find($tarea->id_actividad);

        // Si la actividad tiene tareas, sumarlas; si no, dejar su costo actual
        $nuevoCostoActividad = $actividad->tareasActivas->isNotEmpty()
            ? $actividad->tareasActivas->sum('costo')
            : $actividad->costo;

        $actividad->update(['costo' => $nuevoCostoActividad]);

        // 2) Actualizar costo del componente padre
        $componente = Componentes::with('actividadesActivas.tareasActivas')
            ->find($actividad->id_componente);

        $nuevoCostoComponente = $componente->actividadesActivas->sum(function ($act) {
            if ($act->tareasActivas->isNotEmpty()) {
                return $act->tareasActivas->sum('costo');
            }
            // Si la actividad no tiene tareas, usar su propio costo
            return $act->costo;
        });

        $componente->update(['costo' => $nuevoCostoComponente]);

        // 3) Calcular costo total del proyecto
        $totalGastado = $proyecto->componentesActivas->sum(function ($comp) {
            return $comp->actividadesActivas->sum(function ($act) {
                return $act->tareasActivas->isNotEmpty()
                    ? $act->tareasActivas->sum('costo')
                    : $act->costo;
            });
        });

        // 4) Registrar en la tabla de costos solo si existe presupuesto activo
        if ($proyecto->presupuestoActivo) {
            // Inactivar el registro anterior
            CostoProyecto::where('cod_proyecto_cliente', $proyecto->id)
                ->where('estado', CostoProyecto::ACTIVO)
                ->update([
                    'estado'     => CostoProyecto::INACTIVO,
                    'updated_at' => now(),
                ]);

            // Crear uno nuevo con el total actualizado
            CostoProyecto::create([
                'costo'                => $totalGastado,
                'estado'               => CostoProyecto::ACTIVO,
                'id_usuario'           => auth()->id(),
                'cod_proyecto_cliente' => $proyecto->id,
            ]);
        }
    }


    public function validarFinalizacionProyecto(Tarea $tarea)
    {
        $proyecto = ProyectoCliente::with(
            'tareasActivas',
            'responsablesActivos',
        )->find($tarea?->cod_proyecto_cliente);

        if (count($proyecto->tareasActivas) == count($proyecto->tareasFinalizadas)) {
            foreach ($proyecto->responsablesActivos as $responsable) {
                $usuarioResponsable = Usuario::find($responsable->cod_usuario);
                $usuarioResponsable->notify(new FinalizacionProyectoNotification($usuarioResponsable, $proyecto));
            }
        }
    }

    public function validarPresupuestonProyecto(Tarea $tarea)
    {
        if ($tarea->wasChanged('valor')) {
            $proyecto = ProyectoCliente::with(
                'presupuestoActivo',
                'responsablesActivos',
                'costoProyectoActivo',
            )->find($tarea?->cod_proyecto_cliente);

            if ($proyecto?->presupuestoActivo) {
                if (($proyecto->presupuestoActivo->valor / 2) <= ($proyecto->costoProyectoActivo->costo)) {
                    foreach ($proyecto->responsablesActivos as $responsable) {
                        $usuarioResponsable = Usuario::find($responsable->cod_usuario);
                        $usuarioResponsable->notify(new AproximacionPresupuestoNotification($usuarioResponsable, $proyecto));
                    }
                }
            }
        }
    }

    public function actualizarProgresoProyecto(Tarea $tarea)
    {
        // Verificar si el progreso cambió y es un valor válido
        if ($tarea->wasChanged('progreso') && is_numeric($tarea->progreso) && $tarea->progreso >= 0 && $tarea->progreso <= 100) {
            $actividad = ActividadesComponentes::with('tareasActivas')->find($tarea->id_actividad);

            if ($actividad) {
                // Calcular progreso promedio de tareas activas
                $progresoActividad = $actividad->tareasActivas->avg('progreso') ?? 0;

                // Evitar actualización innecesaria y bucles
                if (round($actividad->progreso, 2) != round($progresoActividad, 2)) {
                    $actividad->progreso = $progresoActividad;
                    $actividad->save();
                }
            }
        }
    }

    public function actualizarProgresoProyectoCrear(Tarea $tarea)
    {
        // Verificar si el progreso cambió y es un valor válido
        if ($tarea->wasChanged('progreso') && is_numeric($tarea->progreso) && $tarea->progreso >= 0 && $tarea->progreso <= 100) {
            $actividad = ActividadesComponentes::with('tareasActivas')->find($tarea->id_actividad);

            if ($actividad) {
                // Calcular progreso promedio de tareas activas
                $progresoActividad = $actividad->tareasActivas->avg('progreso') ?? 0;

                // Evitar actualización innecesaria y bucles
                if (round($actividad->progreso, 2) != round($progresoActividad, 2)) {
                    $actividad->progreso = $progresoActividad;
                    $actividad->save();
                }
            }
        }
    }


    public function actualizarFacturacionProyecto(Tarea $tarea)
    {

        $proyecto = ProyectoCliente::with([
            'tareasActivas',
            'facturacionesActivas',
            'componentesActivas.actividadesActivas.tareasActivas'
        ])->find($tarea->cod_proyecto_cliente);

        if (!$proyecto) return;

        $totalActividad = $proyecto->tareasActivas
            ->where('id_actividad', $tarea->id_actividad)
            ->sum('valor_facturado') ?? 0;

        // dd($totalActividad);

        $actividad = ActividadesComponentes::find($tarea->id_actividad);
        $actividad->updateQuietly(['valor_facturado' => $totalActividad]);
        $actividad->refresh();
        // dd($actividad);
        $componente = Componentes::with('actividadesActivas')->find($actividad->id_componente);

        $totalComponente = $componente->actividadesActivas->sum(function ($actividad) {
            return $actividad->tareasActivas->isNotEmpty()
                ? $actividad->tareasActivas->sum('valor_facturado')
                : $actividad->valor_facturado;
        }) ?? 0;

        $componente->update(['valor_facturado' => $totalComponente]);

        $totalProyecto = $proyecto->componentesActivas->sum(function ($componente) {
            return $componente->actividadesActivas->sum(function ($actividad) {
                return $actividad->tareasActivas->isNotEmpty()
                    ? $actividad->tareasActivas->sum('valor_facturado')
                    : $actividad->valor_facturado;
            });
        }) ?? 0;


        Facturaciones::where('id_proyecto', $proyecto->id)
            ->where('estado', Facturaciones::ACTIVO)
            ->update([
                'estado' => Facturaciones::INACTIVO,
                'updated_at' => now()
            ]);

        Facturaciones::create([
            'descripcion' => 'Facturación automática Tarea- ' . now()->format('Y-m-d H:i'),
            'monto' => $totalProyecto,
            'fecha_facturacion' => now(),
            'estado' => Facturaciones::ACTIVO,
            'id_proyecto' => $proyecto->id,
            'id_carpeta' => null,
            'id_usuario' => Auth::user()->id,
        ]);
    }

    public function actualizarFacturacionProyectoCrear(Tarea $tarea)
    {

        $proyecto = ProyectoCliente::with([
            'tareasActivas',
            'facturacionesActivas',
            'componentesActivas.actividadesActivas.tareasActivas'
        ])->find($tarea->cod_proyecto_cliente);

        if (!$proyecto) return;

        $totalActividad = $proyecto->tareasActivas
            ->where('id_actividad', $tarea->id_actividad)
            ->sum('valor_facturado') ?? 0;

        // dd($totalActividad);

        $actividad = ActividadesComponentes::find($tarea->id_actividad);
        $actividad->updateQuietly(['valor_facturado' => $totalActividad]);
        $actividad->refresh();
        // dd($actividad);
        $componente = Componentes::with('actividadesActivas')->find($actividad->id_componente);

        $totalComponente = $componente->actividadesActivas->sum(function ($actividad) {
            return $actividad->tareasActivas->isNotEmpty()
                ? $actividad->tareasActivas->sum('valor_facturado')
                : $actividad->valor_facturado;
        }) ?? 0;

        $componente->update(['valor_facturado' => $totalComponente]);

        $totalProyecto = $proyecto->componentesActivas->sum(function ($componente) {
            return $componente->actividadesActivas->sum(function ($actividad) {
                return $actividad->tareasActivas->isNotEmpty()
                    ? $actividad->tareasActivas->sum('valor_facturado')
                    : $actividad->valor_facturado;
            });
        }) ?? 0;


        Facturaciones::where('id_proyecto', $proyecto->id)
            ->where('estado', Facturaciones::ACTIVO)
            ->update([
                'estado' => Facturaciones::INACTIVO,
                'updated_at' => now()
            ]);

        Facturaciones::create([
            'descripcion' => 'Facturación automática Tarea- ' . now()->format('Y-m-d H:i'),
            'monto' => $totalProyecto,
            'fecha_facturacion' => now(),
            'estado' => Facturaciones::ACTIVO,
            'id_proyecto' => $proyecto->id,
            'id_carpeta' => null,
            'id_usuario' => Auth::user()->id,
        ]);
    }
}
