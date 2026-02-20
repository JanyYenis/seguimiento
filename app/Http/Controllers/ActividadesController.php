<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\ActividadFase;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ActividadesController extends Controller
{
    public function listado(Request $request)
    {
        $datos = $request->all();
        $id_fase = $request->get('idFase');

        $actividades = ActividadFase::where('id_fase', $id_fase)
            ->where('estado', ActividadFase::ACTIVO);

        return DataTables::eloquent($actividades)
            ->addColumn("estado", function ($model) {
                $info['concepto'] = $model?->infoEstado;
                return view("sistema.estado", $info);
            })
            ->addColumn("action", function ($model) {
                $info['model'] = $model;
                $info['puedeEditar'] = can(Usuario::PERMISO_ACTIVIDADES_EDITAR);
                $info['puedeEliminar'] = can(Usuario::PERMISO_ACTIVIDADES_ELIMINAR);
                $info['nombreTabla'] = Usuario::darNombreTabla();
                return view("proyectos.componentes-editar.fases.actividades.columnas.acciones", $info);
            })
            ->rawColumns(["action"])
            ->make(true);
    }

    public function crear(Request $request)
    {
        $campos = $request->all();
        $campos['id_fase'] = $request->get('idFase');
        $campos['estado'] = ActividadFase::ACTIVO;

        unset($campos['idFase']);

        $actividad = ActividadFase::create($campos);

        if (!$actividad) {
            throw new ErrorException("Error al intentar crear la actividad");
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se agrego la tarea correctamente.',
        ];
    }

    public function edit($id)
    {
        $actividad = ActividadFase::find($id);

        if (!$actividad) {
            return response()->json(['estado' => 'error', 'mensaje' => 'Actividad no encontrada'], 404);
        }

        return response()->json([
            'estado' => 'success',
            'mensaje' => 'Se cargaron los datos correctamente.',
            'actividad' => $actividad
        ]);
    }

    public function editBack(Request $request, $id)
    {
        // Encuentra la actividad por ID
        $actividad = ActividadFase::find($id);

        if (!$actividad) {
            return response()->json(['estado' => 'error', 'mensaje' => 'Actividad no encontrada'], 404);
        }

        // Actualiza los campos de la actividad
        $actividad->titulo = $request->input('titulo');
        $actividad->fecha_inicio = $request->input('fecha_inicio');
        $actividad->fecha_fin = $request->input('fecha_fin');
        $actividad->descripcion = $request->input('descripcion');

        // Guarda los cambios
        if ($actividad->save()) {
            return response()->json([
                'estado' => 'success',
                'mensaje' => 'Actividad actualizada',
                'actividad' => $actividad
            ]);
        } else {
            return response()->json(['estado' => 'error', 'mensaje' => 'Error al actualizar la actividad'], 500);
        }
    }

    public function inactivar($id)
    {
        $actividad = ActividadFase::find($id);

        // Verifica si la actividad existe
        if ($actividad) {
            $actividad->estado = ActividadFase::INACTIVO;

            $actividad->save();

            return response()->json([
                'estado' => 'success',
                'message' => 'Actividad inactivada exitosamente.'
            ]);
        } else {
            // Maneja el caso donde la actividad no se encuentra
            return response()->json(['error' => 'Actividad no encontrada.'], 404);
        }
    }
}
