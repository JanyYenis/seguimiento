<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\ActaReunion;
use App\Models\PuntoOrdenDia;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PuntoOrdenDiaController extends Controller
{
    public function listado(Request $request, ActaReunion $acta)
    {
        if (!can(Usuario::PERMISO_ACTAS_LISTADO) && !can(Usuario::PERMISO_ACTAS_CREAR) && !can(Usuario::PERMISO_ACTAS_EDITAR) && !can(Usuario::PERMISO_ACTAS_ELIMINAR)) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $acta->load(
            'puntosOrdenDiaNoEliminado.infoEstado'
        );

        // Se almacena la información del acta y sus puntos del dia activos.
        $info["acta"] = $acta;
        $info["puntos"] = $acta->puntosOrdenDiaNoEliminado;

        // Se genera la respuesta con estado de éxito.
        $respuesta["estado"] = "success";

        // Se renderiza la vista y se almacena en la respuesta.
        $respuesta['html'] = view("actas.puntos-dia.index", $info)->render();

        // Se devuelve la respuesta en formato JSON.
        return response()->json($respuesta);
    }

    /**
     * Almacena una nueva puntos del día asociada a un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante con los datos de la puntos del día.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar crear la puntos del día.
     */
    public function store(Request $request)
    {
        // Se obtienen todos los datos de la solicitud.
        $datos = $request->all();


        // Se crea la nueva punto del día en la base de datos.
        $punto = PuntoOrdenDia::create($datos);

        // Si la creación falla, se lanza una excepción.
        if (!$punto) {
            throw new ErrorException("Error al intentar crear el punto del día.");
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se creó correctamente el punto del día.',
        ];
    }

    /**
     * Muestra el formulario de edición para una punto de un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante.
     * @param PuntoOrdenDia $punto La punto a editar.
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON con el estado, mensaje y el HTML renderizado.
     */
    public function edit(Request $request, PuntoOrdenDia $punto)
    {
        $punto->load('acta');
        $responsables = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) use($punto) {
                $query->whereIn('name', [
                    Usuario::ROL_CEO,
                    Usuario::ROL_DESARROLLADOR_FULL_STACK,
                    Usuario::ROL_DESARROLLADOR_FRONTEND,
                    Usuario::ROL_DESARROLLADOR_BACKEND,
                    Usuario::ROL_DISENADOR_UX_UI,
                    Usuario::ROL_GESTOR_PROYECTOS,
                    Usuario::ROL_ANALISTA_CALIDAD,
                    Usuario::ROL_MARKETING_VENTAS,
                    Usuario::ROL_SOPORTE,
                    Usuario::ROL_TESORERO,
                    Usuario::ROL_CONTABILIDAD,
                    Usuario::ROL_ABOGADO
                ]);
            })->orWhere('id', $punto->acta->cod_cliente)
            ->get();

        $info['responsables'] = $responsables;
        // Se almacena la información del item y los nombres de los tipos disponibles.
        $info["punto"] = $punto;

        // Se genera la respuesta con estado de éxito y el mensaje correspondiente.
        $respuesta["estado"] = "success";
        $respuesta["mensaje"] = "Datos cargados correctamente";

        // Se renderiza la vista y se almacena en la respuesta.
        $respuesta['html'] = view("actas.puntos-dia.modals.editar", $info)->render();

        // Se devuelve la respuesta en formato JSON.
        return response()->json($respuesta);
    }

    /**
     * Actualiza una punto del dia existente en un acta.
     *
     * @param Request $request Instancia de la solicitud HTTP entrante con los datos actualizados.
     * @param PuntoOrdenDia $punto el punto a actualizar.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar actualizar la punto.
     */
    public function update(Request $request, PuntoOrdenDia $punto)
    {
        // Se obtienen todos los datos de la solicitud.
        $datos = $request->all();

        // Se actualiza la punto con los nuevos valores.
        $actualizar = $punto->update($datos);

        // Si la actualización falla, se lanza una excepción.
        if (!$actualizar) {
            throw new ErrorException("Error al intentar actualizar el punto.");
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizó correctamente el punto.',
        ];
    }

    /**
     * Elimina una punto de un acta.
     *
     * @param PuntoOrdenDia $punto La punto a eliminar.
     * @return array Respuesta con el estado de la operación y un mensaje de confirmación.
     * @throws \ErrorException Si ocurre un error al intentar eliminar la punto.
     */
    public function delete(PuntoOrdenDia $punto)
    {
        // Se intenta eliminar la punto.
        $eliminar = $punto->eliminar();

        // Si la eliminación falla, se lanza una excepción.
        if (!$eliminar) {
            throw new ErrorException('Ha ocurrido un error al intentar eliminar el punto.');
        }

        // Se devuelve una respuesta con estado de éxito.
        return [
            'estado' => 'success',
            'mensaje' => 'Se eliminó correctamente el punto.',
        ];
    }
}
