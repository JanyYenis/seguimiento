<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\ActaReunion;
use App\Models\AsistenteReunion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AsistenteController extends Controller
{
    public function listado(Request $request, ActaReunion $acta)
    {
        if (!can(Usuario::PERMISO_ACTAS_LISTADO) && !can(Usuario::PERMISO_ACTAS_CREAR) && !can(Usuario::PERMISO_ACTAS_EDITAR) && !can(Usuario::PERMISO_ACTAS_ELIMINAR)) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $acta->load(
            'asistentesNoEliminados.infoEstado'
        );

        // Se almacena la información del acta y sus asietntes activos.
        $info["acta"] = $acta;
        $info["asistentes"] = $acta->asistentesNoEliminados;

        // Se genera la respuesta con estado de éxito.
        $respuesta["estado"] = "success";

        // Se renderiza la vista y se almacena en la respuesta.
        $respuesta['html'] = view("actas.asistentes.index", $info)->render();

        // Se devuelve la respuesta en formato JSON.
        return response()->json($respuesta);
    }

    /**
     * Almacena una nueva asistente asociada a un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante con los datos de la asistente.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar crear la asistente.
     */
    public function store(Request $request)
    {
        // Se obtienen todos los datos de la solicitud.
        $datos = $request->all();


        // Se crea la nueva asistente en la base de datos.
        $asistente = AsistenteReunion::create($datos);

        // Si la creación falla, se lanza una excepción.
        if (!$asistente) {
            throw new ErrorException("Error al intentar crear el asistente.");
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se creó correctamente el asistente.',
        ];
    }

    /**
     * Muestra el formulario de edición para una asistente de un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante.
     * @param AsistenteReunion $asistente La asistente a editar.
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON con el estado, mensaje y el HTML renderizado.
     */
    public function edit(Request $request, AsistenteReunion $asistente)
    {
        // Se almacena la información del item y los nombres de los tipos disponibles.
        $info["asistente"] = $asistente;

        // Se genera la respuesta con estado de éxito y el mensaje correspondiente.
        $respuesta["estado"] = "success";
        $respuesta["mensaje"] = "Datos cargados correctamente";

        // Se renderiza la vista y se almacena en la respuesta.
        $respuesta['html'] = view("actas.asistentes.modals.editar", $info)->render();

        // Se devuelve la respuesta en formato JSON.
        return response()->json($respuesta);
    }

    /**
     * Actualiza una asistente existente en un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante con los datos actualizados.
     * @param AsistenteReunion $asistente el asistente a actualizar.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar actualizar la asistente.
     */
    public function update(Request $request, AsistenteReunion $asistente)
    {
        // Se obtienen todos los datos de la solicitud.
        $datos = $request->all();

        // Se actualiza la asistente con los nuevos valores.
        $actualizar = $asistente->update($datos);

        // Si la actualización falla, se lanza una excepción.
        if (!$actualizar) {
            throw new ErrorException("Error al intentar actualizar el asistente.");
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizó correctamente el asistente.',
        ];
    }

    /**
     * Elimina una asistente de un acta.
     *
     * @param AsistenteReunion $asistente La asistente a eliminar.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar eliminar la asistente.
     */
    public function delete(AsistenteReunion $asistente)
    {
        // Se intenta eliminar la asistente.
        $eliminar = $asistente->eliminar();

        // Si la eliminación falla, se lanza una excepción.
        if (!$eliminar) {
            throw new ErrorException('Ha ocurrido un error al intentar eliminar el asistente.');
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se eliminó correctamente el asistente.',
        ];
    }
}
