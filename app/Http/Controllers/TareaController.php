<?php

namespace App\Http\Controllers;

use App\Events\UsuarioRolEvent;
use App\Exceptions\ErrorException;
use App\Models\ActividadFase;
use App\Models\Proyecto;
use App\Models\ResponsableTarea;
use App\Models\Tarea;
use App\Models\Usuario;
use App\Notifications\TareaStoreNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\Can;

class TareaController extends Controller
{
    public function index()
    {
        $info['responsables'] = Usuario::where('estado', Usuario::ACTIVO)->get();

        return view('tareas.index', $info);
    }

    public function show(Request $request, Proyecto $proyecto)
    {
        if (!can(Usuario::PERMISO_TAREAS_CREAR) && !can(Usuario::PERMISO_TAREAS_EDITAR) &&
            !can(Usuario::PERMISO_TAREAS_ELIMINAR) && !can(Usuario::PERMISO_TAREAS_LISTADO)) {
            throw new ErrorException("No cuenta permisos para las tareas del proyecto");
        }

        $tareasPendientes = Tarea::with('responsablesActivos.responsable')
            ->where('estado', Tarea::PENDIENTE)
            ->where('cod_proyecto', $proyecto->id);
        if ($request->input('id')) {
            $tareasPendientes = $tareasPendientes->where('id', $request->input('id'));
        }
        $tareasPendientes = $tareasPendientes->get() ?? [];
        $tareasEnEjecucion = Tarea::with('responsablesActivos.responsable')
            ->where('estado', Tarea::EN_EJECUCION)
            ->where('cod_proyecto', $proyecto->id);
        if ($request->input('id')) {
            $tareasEnEjecucion = $tareasEnEjecucion->where('id', $request->input('id'));
        }
        $tareasEnEjecucion = $tareasEnEjecucion->get() ?? [];
        $tareasFinalizadas = Tarea::with('responsablesActivos.responsable')
            ->where('estado', Tarea::FINALIZADA)
            ->where('cod_proyecto', $proyecto->id);
        if ($request->input('id')) {
            $tareasFinalizadas = $tareasFinalizadas->where('id', $request->input('id'));
        }
        $tareasFinalizadas = $tareasFinalizadas->get() ?? [];

        return response()->json([
            'estado' => 'success',
            'mensaje' => 'Se cargo correctamente las tareas',
            'tareasPendientes' => $tareasPendientes,
            'tareasEnEjecucion' => $tareasEnEjecucion,
            'tareasFinalizadas' => $tareasFinalizadas,
            'puedeCrear' => can(Usuario::PERMISO_TAREAS_CREAR),
            'puedeEditar' => can(Usuario::PERMISO_TAREAS_EDITAR),
            'puedeEliminar' => can(Usuario::PERMISO_TAREAS_ELIMINAR),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->all();
        $datos['fecha_inicio'] = Carbon::parse($datos['fecha_inicio']);
        $datos['fecha_fin'] = Carbon::parse($datos['fecha_fin']);
        $datos['valor'] = (int) $datos['valor'] ? (int) $datos['valor'] : 0;

        $tarea = Tarea::create($datos);

        if (!$tarea) {
            throw new ErrorException("Error al intentar agregar la tarea.");
        }

        $responsables = $request->input('responsables') ? explode(',', $request->input('responsables')) : [];
        foreach ($responsables as $key => $responsable) {
            $responsableTarea = ResponsableTarea::create([
                'cod_responsable' => $responsable,
                'cod_tarea' => $tarea->id,
            ]);
        }

        Notification::sendNow(auth()->user(), new TareaStoreNotification(auth()->user(), $tarea));
        broadcast(new UsuarioRolEvent(auth()->user()));

        if (array_key_exists('notificar_responsable', $datos)) {
            foreach ($responsables as $key => $responsable) {
                $datosResponsables = Usuario::find($responsable);
                if (auth()->user()->id != $datosResponsables->id) {
                    Notification::sendNow($datosResponsables, new TareaStoreNotification($datosResponsables, $tarea));
                    broadcast(new UsuarioRolEvent($datosResponsables));
                }
            }
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se agrego la tarea correctamente.',
        ];
    }

    public function edit(Request $request, Tarea $tarea)
    {
        $tarea->load('responsableActivo');
        $tarea->valor_etiqueta = '';

        if ($tarea->etiquetas) {
            // Decodificar el JSON
            $array = json_decode($tarea->etiquetas, true);

            // Inicializar una cadena vacía para almacenar los valores
            $result = '';

            // Recorrer el array y concatenar los valores
            foreach ($array as $item) {
                $result .= $item['value'] . ', ';
            }

            // Eliminar la coma adicional al final de la cadena
            $tarea->valor_etiqueta = rtrim($result, ', ');
        }

        $info['tarea'] = $tarea;
        $info['responsables'] = Usuario::where('estado', Usuario::ACTIVO)->get();
        $respuesta["estado"] = "success";
        $respuesta["mensaje"] = "Datos cargados correctamente";
        $respuesta['html'] = view("proyectos.componentes-editar.tareas.modals.editar", $info)->render();

        return response()->json($respuesta);
    }

    public function update(Request $request, Tarea $tarea)
    {
        $datos = $request->all();
        $datos['fecha_inicio'] = Carbon::parse($datos['fecha_inicio']);
        $datos['fecha_fin'] = Carbon::parse($datos['fecha_fin']);

        $actualizar = $tarea->update($datos);

        if (!$actualizar) {
            throw new ErrorException("Error al intentar actualizar la tarea.");
        }

        ResponsableTarea::where('cod_tarea', $tarea->id)->update(['estado' => ResponsableTarea::INACTIVO]);
        $responsables = $request->input('responsables') ? explode(',', $request->input('responsables')) : [];
        foreach ($responsables as $key => $responsable) {
            $responsableTarea = ResponsableTarea::updateOrCreate([
                'cod_tarea' => $tarea->id,
                'cod_responsable' => $responsable,
            ], [
                'estado' => ResponsableTarea::ACTIVO
            ]);
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizo la tarea correctamente.',
        ];
    }

    public function delete(Request $request, Tarea $tarea)
    {
        $eliminar = $tarea->eliminar();

        if (!$eliminar) {
            throw new ErrorException("Error al intentar eliminar la tarea.");
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se elimino correctamente la tarea.',
        ];
    }

    public function actualizarEstado(Request $request, Tarea $tarea)
    {
        if (!can(Usuario::PERMISO_TAREAS_EDITAR)) {
            throw new ErrorException("No tienes permiso para esta acción.");
        }
        $estado = $request->input('estado') ?? Tarea::PENDIENTE;

        $actualizar = $tarea->update(['estado' => $estado]);

        if (!$actualizar) {
            throw new ErrorException("Error al mover la tarea");
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se movio la tarea correctamente.',
        ];
    }

    public function filtrar(Request $request)
    {
        $datos = $request->all();
        $palabras = count(explode(" ", $datos['search'])) ? explode(" ", $datos['search']) : [];
        $tareas = Tarea::with('responsableActivo.responsable')->whereNot('estado', Tarea::ELIMINADO)
            ->where(function($query) use($datos, $palabras) {
                if ($datos['titulo'] && count($palabras)) {
                    // Agregar condiciones para cada palabra
                    foreach ($palabras as $palabra) {
                        $query->orWhereRaw('LOWER(titulo) LIKE ?', ['%' . strtolower($palabra) . '%']);
                    }
                }
                if ($datos['descripcion'] && count($palabras)) {
                    // Agregar condiciones para cada palabra
                    foreach ($palabras as $palabra) {
                        $query->orWhereRaw('LOWER(descripcion) LIKE ?', ['%' . strtolower($palabra) . '%']);
                    }
                }
                if ($datos['etiqueta'] && count($palabras)) {
                    // Agregar condiciones para cada palabra
                    foreach ($palabras as $palabra) {
                        $query->orWhereRaw('LOWER(etiquetas) LIKE ?', ['%' . strtolower($palabra) . '%']);
                    }
                }
                if ($datos['etiqueta'] && count($palabras)) {
                    $query->whereHas('responsableActivo.responsable', function($q) use($palabras){
                        // Agregar condiciones para cada palabra
                        foreach ($palabras as $palabra) {
                            $q->orWhereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($palabra) . '%'])
                                ->orWhereRaw('LOWER(apellido) LIKE ?', ['%' . strtolower($palabra) . '%']);
                        }
                    });
                }
            });

        $tareas = $tareas->get();
        $resultados = [];
        foreach ($tareas as $index => $tarea) {
            $resultados[$index]['id'] = $tarea->id;
            $resultados[$index]['tipo'] = 1;
            $resultados[$index]['icono'] = 'fas fa-clipboard-list fs-1';
            $resultados[$index]['texto'] = $tarea?->titulo ?? 'N/A';
            $resultados[$index]['descripcion'] = $tarea?->descripcion ?? 'N/A';
        }

        // dd($resultados);
        $info['resultados'] = $resultados;
        $info['tituloResultados'] = 'Tareas';
        $respuesta["estado"] = "success";
        $respuesta["mensaje"] = "Datos cargados correctamente";
        $respuesta['html'] = view("layouts.fases.header.fases-search.resultado", $info)->render();

        return response()->json($respuesta);
    }

    public function buscarUsuarios(Request $request)
    {
        $nombre = $request->get("busqueda");
        $filtro = "%$nombre%";
        $tarea = $request->input('tarea') ?? null;
        $proyecto = $request->input('proyecto') ?? null;

        $responsablesActuales = [];
        if ($tarea) {
            $responsablesActuales = ResponsableTarea::where('cod_tarea', $tarea)
                ->where('estado', ResponsableTarea::ACTIVO)
                ->whereHas('responsable.roles', function($query) {
                    $query->whereIn('name', [Usuario::ROL_DESARROLLADOR_FULL_STACK, Usuario::ROL_DESARROLLADOR_FRONTEND,
                        Usuario::ROL_DESARROLLADOR_BACKEND, Usuario::ROL_DISENADOR_UX_UI, Usuario::ROL_SOPORTE]);
                })
                ->get()
                ->pluck('cod_responsable')
                ->toArray() ?? [];
        }

        $responsables = Usuario::selectRaw('usuarios.id, CONCAT(usuarios.nombre, " ", usuarios.apellido) as text')
            ->with('proyecto')
            ->whereRaw("LOWER(usuarios.nombre) LIKE LOWER(?)", $filtro)
            ->where(function($query) use($proyecto) {
                if ($proyecto) {
                    $query->whereHas('proyecto', function($q) use($proyecto) {
                        $q->where('cod_proyecto', $proyecto);
                    });
                }
            })
            ->whereHas('roles', function($query) {
                $query->whereIn('name', [Usuario::ROL_DESARROLLADOR_FULL_STACK, Usuario::ROL_DESARROLLADOR_FRONTEND,
                    Usuario::ROL_DESARROLLADOR_BACKEND, Usuario::ROL_DISENADOR_UX_UI, Usuario::ROL_SOPORTE]);
            })
            ->where('estado', Usuario::ACTIVO)
            ->get()
            ->map(function ($item, $key) use($responsablesActuales) {
                $item->seleccionado = false;
                if (in_array($item->id, $responsablesActuales)) {
                    $item->seleccionado = true;
                }
                return $item;
            });

        return [
            'estado' => 'success',
            'responsables' => $responsables,
        ];
    }

    public function buscarFases(Request $request)
    {
        $nombre = $request->get("busqueda");
        $filtro = "%$nombre%";
        $tarea = $request->input('tarea') ?? null;
        $proyecto = $request->input('proyecto') ?? null;

        $actividad = null;
        if ($tarea) {
            $actividad = Tarea::find($tarea)->id_actividad;
        }

        $actividades = ActividadFase::selectRaw('actividades_fases.id, CONCAT(c.titulo, " / ", actividades_fases.titulo) as text')
            ->join('fases as c', 'actividades_fases.id_fase', '=', 'c.id')
            ->with('fase')
            ->whereRaw("LOWER(actividades_fases.titulo) LIKE LOWER(?)", $filtro)
            ->whereHas('fase', function($query) use($proyecto) {
                $query->where('id_proyecto', $proyecto);
            })
            ->where('actividades_fases.estado', ActividadFase::ACTIVO)
            ->get()
            ->map(function ($item, $key) use($actividad) {
                $item->seleccionado = false;
                if ($item->id == $actividad) {
                    $item->seleccionado = true;
                }
                return $item;
            });

        return [
            'estado' => 'success',
            'actividades' => $actividades,
        ];
    }
}
