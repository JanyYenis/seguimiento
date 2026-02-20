<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaseController extends Controller
{
    public function index(Request $request)
    {
        $campos = $request->all();
        $id_proyecto = $request->get('idProyecto');

        $fases = Fase::where('id_proyecto', $id_proyecto)
            ->where('estado', Fase::ACTIVO);

        return DataTables::eloquent($fases)
            ->addColumn("estado", function ($model) {
                $info['concepto'] = $model?->infoEstado;
                return view("sistema.estado", $info);
            })
            ->addColumn("action", function ($model) {
                $info['model'] = $model;
                $info['puedeVerActividades'] = can(Usuario::PERMISO_ACTIVIDADES_CREAR) || can(Usuario::PERMISO_ACTIVIDADES_EDITAR) || can(Usuario::PERMISO_ACTIVIDADES_LISTADO)  || can(Usuario::PERMISO_ACTIVIDADES_ELIMINAR);
                $info['puedeEditar'] = can(Usuario::PERMISO_FASES_EDITAR);
                $info['puedeEliminar'] = can(Usuario::PERMISO_FASES_ELIMINAR);
                $info['estados'] = Usuario::darEstado()->conceptosActivos;
                $info['nombreTabla'] = Usuario::darNombreTabla();
                // $info['puedeAsignarToken'] = $proyecto;
                return view("proyectos.componentes-editar.fases.columnas.acciones", $info);
            })
            ->rawColumns(["action"])
            ->make(true);
    }

    public function crear(Request $request)
    {
        $campos = $request->all();
        $campos['id_proyecto'] = $request->input('id_proyecto');
        $tituloFase = $campos['tituloFase'];
        $descFase = $campos['descFase'];
        $valorFase = $campos['valorFase'] ?? 0;

        // Crear una nueva instancia del modelo Fases y asignar los valores
        $fase = new Fase();
        $fase->titulo = $tituloFase;
        $fase->descripcion = $descFase;
        $fase->valor = $valorFase ?? 0;
        $fase->id_proyecto = $campos['id_proyecto'];

        // Guardar el fase en la base de datos
        $fase->save();

        return response()->json([
            'estado' => 'success',
            'fase' => $fase
        ]);
    }

    public function editar($id)
    {
        $fase = Fase::find($id);

        if (!$fase) {
            return response()->json(['estado' => 'error', 'mensaje' => 'Fase no encontrado'], 404);
        }

        return response()->json([
            'estado' => 'success',
            'mesagge' => 'Fase cargado correctamente.',
            'fase' => $fase
        ]);
    }

    public function editarBack(Request $request, $id)
    {
        $fase = Fase::find($id);

        $fase->titulo = $request->input('titulo');
        $fase->descripcion = $request->input('descripcion');

        if (!$fase) {
            return response()->json(['estado' => 'error', 'mensaje' => 'Fase no encontrado'], 404);
        }

        if ($fase->save()) {
            return response()->json([
                'estado' => 'success',
                'message' => 'fase actualizado correctamente',
                'fase' => $fase
            ]);
        } else {
            return response()->json(['estado' => 'error', 'mensaje' => 'Error al actualizar la fase'], 404);
        }
    }
}
