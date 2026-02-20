<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\PresupuestoProyecto;
use Illuminate\Http\Request;

class PresupuestoProyectoController extends Controller
{
    public function store(Request $request)
    {
        $datos = $request->all();

        $presupuesto = PresupuestoProyecto::create($datos);

        if (!$presupuesto) {
            throw new ErrorException("Error al intentar agregar el presupuesto.");
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se agrego el presupuesto correctamente.',
        ];
    }

    public function update(Request $request, PresupuestoProyecto $presupuesto)
    {
        $datos = $request->all();

        $actualizar = $presupuesto->update($datos);

        if (!$actualizar) {
            throw new ErrorException("Error al intentar actualizar el presupuesto.");
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizo el presupuesto correctamente.',
        ];
    }

    public function delete(Request $request, PresupuestoProyecto $presupuesto)
    {
        $eliminar = $presupuesto->eliminar();

        if (!$eliminar) {
            throw new ErrorException("Error al intentar eliminar el presupuesto.");
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se elimino correctamente el presupuesto.',
        ];
    }
}