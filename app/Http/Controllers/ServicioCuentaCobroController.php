<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\CuentaCobro;
use App\Models\Fase;
use App\Models\Proyecto;
use App\Models\ServicioCuentaCobro;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ServicioCuentaCobroController extends Controller
{
    public function listado(Request $request, CuentaCobro $cuenta)
    {
        if (!can(Usuario::PERMISO_CUENTAS_COBROS_LISTADO) && !can(Usuario::PERMISO_CUENTAS_COBROS_CREAR) && !can(Usuario::PERMISO_CUENTAS_COBROS_EDITAR) && !can(Usuario::PERMISO_CUENTAS_COBROS_ELIMINAR)) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $cuenta->load(
            'serviciosNoEliminados.infoEstado'
        );

        // Se almacena la información del cuenta y sus servicios activos.
        $info["cuenta"] = $cuenta;
        $info["servicios"] = $cuenta->serviciosNoEliminados;

        // Se genera la respuesta con estado de éxito.
        $respuesta["estado"] = "success";

        // Se renderiza la vista y se almacena en la respuesta.
        $respuesta['html'] = view("cuentas-cobros.servicios.index", $info)->render();

        // Se devuelve la respuesta en formato JSON.
        return response()->json($respuesta);
    }

    /**
     * Almacena una nueva servicio asociada a un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante con los datos de la servicio.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar crear la servicio.
     */
    public function store(Request $request)
    {
        // Se obtienen todos los datos de la solicitud.
        $datos = $request->all();


        // Se crea la nueva servicio en la base de datos.
        $servicio = ServicioCuentaCobro::create($datos);

        // Si la creación falla, se lanza una excepción.
        if (!$servicio) {
            throw new ErrorException("Error al intentar crear el servicio.");
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se creó correctamente el servicio.',
        ];
    }

    /**
     * Muestra el formulario de edición para una servicio de un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante.
     * @param ServicioCuentaCobro $servicio La servicio a editar.
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON con el estado, mensaje y el HTML renderizado.
     */
    public function edit(Request $request, ServicioCuentaCobro $servicio)
    {
        $servicio->load('cuenta');
        // Se almacena la información del item y los nombres de los tipos disponibles.
        $info["servicio"] = $servicio;
        $info['fases'] = Fase::selectRaw('id, titulo as text')
            ->where('estado', Fase::ACTIVO)
            ->where('id_proyecto', $servicio?->cuenta?->cod_proyecto)
            ->get();

        // Se genera la respuesta con estado de éxito y el mensaje correspondiente.
        $respuesta["estado"] = "success";
        $respuesta["mensaje"] = "Datos cargados correctamente";

        // Se renderiza la vista y se almacena en la respuesta.
        $respuesta['html'] = view("cuentas-cobros.servicios.modals.editar", $info)->render();

        // Se devuelve la respuesta en formato JSON.
        return response()->json($respuesta);
    }

    /**
     * Actualiza una servicio existente en un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante con los datos actualizados.
     * @param ServicioCuentaCobro $servicio el servicio a actualizar.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar actualizar la servicio.
     */
    public function update(Request $request, ServicioCuentaCobro $servicio)
    {
        // Se obtienen todos los datos de la solicitud.
        $datos = $request->all();

        // Se actualiza la servicio con los nuevos valores.
        $actualizar = $servicio->update($datos);

        // Si la actualización falla, se lanza una excepción.
        if (!$actualizar) {
            throw new ErrorException("Error al intentar actualizar el servicio.");
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizó correctamente el servicio.',
        ];
    }

    /**
     * Elimina una servicio de un acta.
     *
     * @param ServicioCuentaCobro $servicio La servicio a eliminar.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar eliminar la servicio.
     */
    public function delete(ServicioCuentaCobro $servicio)
    {
        // Se intenta eliminar la servicio.
        $eliminar = $servicio->eliminar();

        // Si la eliminación falla, se lanza una excepción.
        if (!$eliminar) {
            throw new ErrorException('Ha ocurrido un error al intentar eliminar el servicio.');
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se eliminó correctamente el servicio.',
        ];
    }

    public function buscarFases(Request $request, Proyecto $proyecto)
    {
        $fases = Fase::selectRaw('id, titulo as text')
            ->where('estado', Fase::ACTIVO)
            ->where('id_proyecto', $proyecto->id)
            ->get();

        return [
            'estado' => 'success',
            'fases' => $fases,
        ];
    }
}
