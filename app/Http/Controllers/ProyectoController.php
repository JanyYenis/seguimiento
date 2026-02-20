<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\Proyecto;
use App\Models\ResponsableProyecto;
use App\Models\Tarea;
use App\Models\Usuario;
use App\Notifications\ResponsableProyectoNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\FaseController;
use App\Models\Fase;

class ProyectoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ((!can(Usuario::PERMISO_PROYECTOS_CREAR) && !can(Usuario::PERMISO_PROYECTOS_EDITAR) &&
            !can(Usuario::PERMISO_PROYECTOS_LISTADO) && !can(Usuario::PERMISO_PROYECTOS_ELIMINAR) &&
            !can(Usuario::PERMISO_PRESUPUESTO_CREAR) && !can(Usuario::PERMISO_PRESUPUESTO_LISTADO) &&
            !can(Usuario::PERMISO_PRESUPUESTO_EDITAR) && !can(Usuario::PERMISO_PRESUPUESTO_ELIMINAR))) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $responsables = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->where('name', Usuario::ROL_GESTOR_PROYECTOS);
            })
            ->get();

        $clientes = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->where('name', Usuario::ROL_CLIENTE);
            })
            ->get();

        $info['responsables'] = $responsables;
        $info['clientes'] = $clientes;

        return view('proyectos.index', $info);
    }

    public function chartTota(Request $request)
    {
        $cantidad_pendientes = Proyecto::where('estado', Proyecto::ACTIVO)
            ->where(function($query) {
                if (auth()->user()->hasRole(Usuario::ROL_CLIENTE)) {
                    $query->where('cod_cliente', auth()->user()->id);
                } else {
                    $query->where('responsable_id', auth()->user()->id)
                        ->orWhereHas('responsablesActivos', function($q) {
                            $q->where('cod_usuario', auth()->user()->id);
                        });
                }
            })
            ->count();
        $cantidad_ejecucion = Proyecto::where('estado', Proyecto::EN_PROGRESO)
            ->where(function($query) {
                if (auth()->user()->hasRole(Usuario::ROL_CLIENTE)) {
                    $query->where('cod_cliente', auth()->user()->id);
                } else {
                    $query->where('responsable_id', auth()->user()->id)
                        ->orWhereHas('responsablesActivos', function($q) {
                            $q->where('cod_usuario', auth()->user()->id);
                        });
                }
            })
            ->count();
        $cantidad_completados = Proyecto::where('estado', Proyecto::COMPLETADO)
            ->where(function($query) {
                if (auth()->user()->hasRole(Usuario::ROL_CLIENTE)) {
                    $query->where('cod_cliente', auth()->user()->id);
                } else {
                    $query->where('responsable_id', auth()->user()->id)
                        ->orWhereHas('responsablesActivos', function($q) {
                            $q->where('cod_usuario', auth()->user()->id);
                        });
                }
            })
            ->count();

        return [
            'estado' => 'success',
            'data' => [$cantidad_pendientes, $cantidad_ejecucion, $cantidad_completados],
        ];
    }

    public function chartTotaTareas(Request $request, Proyecto $proyecto)
    {
        $cantidad_pendientes = Tarea::where('estado', Tarea::PENDIENTE)->where('cod_proyecto', $proyecto?->id)->count();
        $cantidad_ejecucion = Tarea::where('estado', Tarea::EN_EJECUCION)->where('cod_proyecto', $proyecto?->id)->count();
        $cantidad_completados = Tarea::where('estado', Tarea::FINALIZADA)->where('cod_proyecto', $proyecto?->id)->count();

        return [
            'estado' => 'success',
            'data' => [$cantidad_pendientes, $cantidad_ejecucion, $cantidad_completados],
        ];
    }

    public function chartLinea(Request $request, Proyecto $proyecto)
    {
        $tareasCompletadasPorMes = Tarea::with('proyecto')->selectRaw('YEAR(fecha_fin) as ano, MONTH(fecha_fin) as mes, COUNT(*) as total')
            ->where('cod_proyecto', $proyecto->id)
            ->where('estado', Tarea::FINALIZADA)
            ->groupBy('ano', 'mes')
            ->orderBy('ano', 'asc')
            ->orderBy('mes', 'asc')
            ->get()
            ->keyBy(function ($item) {
                return $item->ano . '-' . $item->mes;
            });

        $tareasPendientePorMes = Tarea::with('proyecto')->selectRaw('YEAR(fecha_fin) as ano, MONTH(fecha_fin) as mes, COUNT(*) as total')
            ->where('cod_proyecto', $proyecto->id)
            ->whereIn('estado', [Tarea::PENDIENTE, Tarea::EN_EJECUCION])
            ->groupBy('ano', 'mes')
            ->orderBy('ano', 'asc')
            ->orderBy('mes', 'asc')
            ->get()
            ->keyBy(function ($item) {
                return $item->ano . '-' . $item->mes;
            });

        $months = collect(array_merge($tareasCompletadasPorMes->keys()->toArray(), $tareasPendientePorMes->keys()->toArray()))
            ->unique()
            ->sort()
            ->values();

        $completeData = [];
        $incompleteData = [];

        foreach ($months as $month) {
            $completeData[] = $tareasCompletadasPorMes->get($month)->total ?? 0;
            $incompleteData[] = $tareasPendientePorMes->get($month)->total ?? 0;
        }

        $result = [
            [
                'name' => 'Completadas',
                'data' => $completeData,
            ],
            [
                'name' => 'Incompletas',
                'data' => $incompleteData,
            ]
        ];

        // dd($result, $months);
        return [
            'estado' => 'success',
            'data' => $result,
            'meses' => $months,
        ];
    }

    public function listado(Request $request)
    {
        if (
            !can(Usuario::PERMISO_PROYECTOS_LISTADO) &&
            !can(Usuario::PERMISO_PRESUPUESTO_CREAR) && !can(Usuario::PERMISO_PRESUPUESTO_LISTADO) &&
            !can(Usuario::PERMISO_PRESUPUESTO_EDITAR) && !can(Usuario::PERMISO_PRESUPUESTO_ELIMINAR)
        ) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $estado = $request->input('estado') ?? 0;
        $pagina = $request->input('pagina') ?? 1;
        $cantidad = $request->input("cantidad_pagina", 6);

        $proyectosQuery = Proyecto::with(
            'responsablesActivos.usuario',
            'presupuestoActivo',
            'infoEstado',
        )
            ->where(function($query) {
                if (auth()->user()->hasRole(Usuario::ROL_CLIENTE)) {
                    $query->where('cod_cliente', auth()->user()->id);
                } else {
                    $query->where('responsable_id', auth()->user()->id)
                        ->orWhereHas('responsablesActivos', function($q) {
                            $q->where('cod_usuario', auth()->user()->id);
                        });
                }
            })
            ->whereNot('estado', Proyecto::ELIMINADO);

        if ($estado != 0 && $estado && $estado != '0') {
            $proyectosQuery = $proyectosQuery->where('estado', $estado);
        }

        $proyectos = $proyectosQuery->paginate($cantidad, ["*"], "proyectos", $pagina);
        $info['ultimaPagina'] = $proyectos->lastPage();
        $info["proyectos"] = $proyectos;
        $info['paginaActual'] = $pagina;

        return [
            "estado" => "success",
            "html" => view("proyectos.listado", $info)->render()
        ];
    }

    public function store(Request $request)
    {
        $datos = $request->all();
        $tituloComp = $datos['tituloFase'];
        $descComp = $datos['descFase'];
        $valorFase = $datos['valorFase'];

        unset($datos['tituloFase']);
        unset($datos['descFase']);
        unset($datos['valorFase']);

        if ($request->hasFile('logo') && $request->file('logo')) {
            $archivo = $request->file('logo');
            $nombreOriginal = $archivo->getClientOriginalName();

            $variablesMensaje['file'] = $nombreOriginal;
            $archivo->move(public_path('img/logos'), $nombreOriginal);
            $datos['logo'] = 'img/logos/' . $nombreOriginal;

            if (!file_exists($datos['logo'])) {
                throw new ErrorException('Error al intentar guardar el archivo.');
            }

            if (!array_key_exists('file', $variablesMensaje)) {
                throw new ErrorException("Error al intentar guardar el archivo.");
            }
        } else {
            if ($request->file('logo')) {
                throw new ErrorException('Por favor, revise si el archivo cuenta con las condiciones establecidas para el envío.');
            }
        }

        $proyecto = Proyecto::create($datos);

        if (!$proyecto) {
            throw new ErrorException('Error al intentar crear el nuevo proyecto.');
        }

        $responsables = $request->input('responsables') ? explode(',', $request->input('responsables')) : [];
        foreach ($responsables as $responsable) {
            $responsableProyecto = ResponsableProyecto::create([
                'cod_usuario' => $responsable,
                'cod_proyecto' => $proyecto->id,
            ]);

            $usuarioResponsable = Usuario::find($responsable);
            $usuarioResponsable->notify(new ResponsableProyectoNotification($usuarioResponsable, $proyecto));
        }

        if (!empty($tituloComp) && !empty($descComp)) {
            foreach ($tituloComp as $index => $titulo) {
                $desc = $descComp[$index] ?? '';
                $valorC = $valorFase[$index] ?? 0;

                // Crear un nuevo array con los datos necesarios
                $campos = array_merge($datos, [
                    'tituloFase' => $titulo,
                    'descFase' => $desc,
                    'valorFase' => $valorC,
                    'id_proyecto' => $proyecto->id
                ]);

                // Crear una instancia de Request
                // dd($campos);
                $componentRequest = new Request($campos);
                // Crear una instancia del controlador y llamar al método crear
                $controller = new FaseController();
                $response = $controller->crear($componentRequest);

                // Procesar la respuesta según sea necesario
                $responseData = $response->getData();
            }
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se creó correctamente el proyecto SNKLDASKND.',
            'id' => $proyecto?->id,
        ];
    }

    public function edit(Request $request, Proyecto $proyecto)
    {
        if (
            !can(Usuario::PERMISO_PROYECTOS_EDITAR) && !can(Usuario::PERMISO_PRESUPUESTO_CREAR) &&
            !can(Usuario::PERMISO_PRESUPUESTO_LISTADO) && !can(Usuario::PERMISO_PRESUPUESTO_EDITAR) &&
            !can(Usuario::PERMISO_PRESUPUESTO_ELIMINAR)
        ) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $fechaActual = Carbon::now();
        $proyecto->load(
            'responsablesActivos.usuario',
            'presupuestoActivo',
            'tareasActivas',
            'tareasEnProgreso',
        );

        $info['responsables'] = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->where('name', Usuario::ROL_GESTOR_PROYECTOS);
            })
            ->get();
        $info['clientes'] = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->where('name', Usuario::ROL_CLIENTE);
            })
            ->get();

        $tareasAtrazadas = Tarea::with('responsablesActivos')->where(function ($query) {
            $query->where('estado', Tarea::PENDIENTE)
                ->orWhere('estado', Tarea::EN_EJECUCION);
        })
            ->where('fecha_fin', '<', $fechaActual)
            ->where('cod_proyecto', $proyecto?->id)
            ->get();
        $info['proyecto'] = $proyecto;
        $info['tareasAtrazadas'] = $tareasAtrazadas;
        $cantidad_total = Tarea::whereNot('estado', Tarea::ELIMINADO)->where('cod_proyecto', $proyecto?->id)->count();
        $cantidad_pendientes = Tarea::where('estado', Tarea::PENDIENTE)->where('cod_proyecto', $proyecto?->id)->count();
        $cantidad_ejecucion = Tarea::where('estado', Tarea::EN_EJECUCION)->where('cod_proyecto', $proyecto?->id)->count();
        $cantidad_completados = Tarea::where('estado', Tarea::FINALIZADA)->where('cod_proyecto', $proyecto?->id)->count();

        $info['cantidad_total'] = $cantidad_total;
        $info['cantidad_completados'] = $cantidad_completados;
        $info['cantidad_pendientes'] = $cantidad_pendientes;
        $info['cantidad_ejecucion'] = $cantidad_ejecucion;

        $startOfWeek = Carbon::now()->startOfWeek(); // Por defecto, el primer día es Lunes
        $endOfWeek = Carbon::now()->endOfWeek(); // Por defecto, el último día es Domingo
        $today = Carbon::now()->day;

        $daysOfWeek = [];

        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $daysOfWeek[] = [
                'numero' => $date->day, // Número del día
                'nombre' => $date->locale('es')->isoFormat('dddd'), // Nombre del día en español
                'isToday' => $date->isToday() // Identificar si es el día actual
            ];
        }

        $info['daysOfWeek'] = $daysOfWeek;

        $authId = auth()->user()->id;

        $info['usuarios'] = Usuario::with('proyecto')->selectRaw('usuarios.id as id, usuarios.nombre as nombre, usuarios.email, usuarios.foto')
            ->whereHas('proyecto', function ($query) use ($proyecto) {
                $query->where('cod_proyecto', $proyecto->id);
            })
            ->where('usuarios.id', '!=', $authId)
            ->groupBy('usuarios.id', 'usuarios.nombre', 'usuarios.email', 'usuarios.foto')
            ->get();

        return view("proyectos.editar", $info);
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $datos = $request->all();
        if ($datos['estado'] != 0 || $datos['estado'] != '0') {
            $datos['estado'] = Proyecto::COMPLETADO;
        } else {
            $datos['estado'] = count($proyecto->tareasEnProgreso) ? Proyecto::EN_PROGRESO : Proyecto::ACTIVO;
        }

        if ($request->hasFile('logo') && $request->file('logo')) {
            $archivo = $request->file('logo');
            $nombreOriginal = $archivo->getClientOriginalName();

            $variablesMensaje['file'] = $nombreOriginal;
            $archivo->move(public_path('img/logos'), $nombreOriginal);
            $datos['logo'] = 'img/logos/' . $nombreOriginal;

            if (!file_exists($datos['logo'])) {
                throw new ErrorException('Error al intentar guardar el archivo.');
            }

            if (!array_key_exists('file', $variablesMensaje)) {
                throw new ErrorException("Error al intenatr guardar el archivo.");
            }
        } else {
            if ($request->file('logo')) {
                throw new ErrorException('Por favor, revise si el archivo cuenta con las condiciones establecidas para el envío.');
            }
        }

        $actualizar = $proyecto->update($datos);

        if (!$actualizar) {
            throw new ErrorException("Error al intentar actualizar el proyecto");
        }

        $inactivarReponsables = [];
        $responsables = $request->input('responsables') ? explode(',', $request->input('responsables')) : [];
        foreach ($responsables as $key => $responsable) {
            $responsableProyecto = ResponsableProyecto::updateOrCreate([
                'cod_usuario' => $responsable,
                'cod_proyecto' => $proyecto->id,
            ], [
                'estado' => ResponsableProyecto::ACTIVO
            ]);
            $inactivarReponsables[] = $responsableProyecto->id;
        }

        if (count($inactivarReponsables)) {
            ResponsableProyecto::whereNotIn('id', $inactivarReponsables)->where('cod_proyecto', $proyecto->id)->update(['estado' => ResponsableProyecto::INACTIVO]);
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizo correctamente el proyecto.',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Proyecto $proyecto)
    {
        $eliminar = $proyecto->eliminar();

        if (!$eliminar) {
            throw new ErrorException('A ocurrido un error al intentar eliminar el proyecto.');
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se eliminado correctamente el proyecto.',
        ];
    }

    public function buscarUsuarios(Request $request)
    {
        $nombre = $request->get("busqueda");
        $filtro = "%$nombre%";
        $proyecto = $request->input('proyecto') ?? null;

        $responsablesActuales = [];
        if ($proyecto) {
            $responsablesActuales = ResponsableProyecto::where('cod_proyecto', $proyecto)
                ->where('estado', ResponsableProyecto::ACTIVO)
                ->whereHas('usuario.roles', function($query) {
                    $query->whereIn('name', [Usuario::ROL_DESARROLLADOR_FULL_STACK, Usuario::ROL_DESARROLLADOR_FRONTEND,
                        Usuario::ROL_DESARROLLADOR_BACKEND, Usuario::ROL_DISENADOR_UX_UI, Usuario::ROL_SOPORTE, Usuario::ROL_CLIENTE]);
                })
                ->get()
                ->pluck('cod_usuario')
                ->toArray() ?? [];
        }

        $responsables = Usuario::selectRaw('usuarios.id, CONCAT(usuarios.nombre, " ", usuarios.apellido) as text')
            ->whereRaw("LOWER(usuarios.nombre) LIKE LOWER(?)", $filtro)
            ->where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->whereIn('name', [Usuario::ROL_DESARROLLADOR_FULL_STACK, Usuario::ROL_DESARROLLADOR_FRONTEND,
                Usuario::ROL_DESARROLLADOR_BACKEND, Usuario::ROL_DISENADOR_UX_UI, Usuario::ROL_SOPORTE, Usuario::ROL_CLIENTE]);
            })
            ->get()
            ->map(function ($item, $key) use ($responsablesActuales) {
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

    public function gantt(Request $request, Proyecto $proyecto)
    {
        $fases = Fase::with('actividadesActivas')
            ->where('id_proyecto', $proyecto->id)
            ->get();

        $ganttData1 = [];
        foreach ($fases as $fase) {
            $ganttData1[] = [
                'id' => $fase->id,
                'text' => $fase->titulo,
                'start_date' => date('d-m-Y', strtotime($fase?->actividadesActivas ? $fase?->actividadesActivas?->min('fecha_inicio') : $fase?->created_at)),
                'end_date' => date('d-m-Y', strtotime($fase?->actividadesActivas ? $fase?->actividadesActivas?->max('fecha_fin') : $fase?->updated_at)),
                'progress' => 1,
                'open' => false,
            ];
            foreach ($fase->actividadesActivas as $actividad) {
                $ganttData1[] = [
                    'id' => $actividad->id,
                    'text' => $actividad->titulo,
                    'start_date' => date('d-m-Y', strtotime($actividad->fecha_inicio)),
                    'end_date' => date('d-m-Y', strtotime($actividad->fecha_fin)),
                    'progress' => 1,
                    'parent' => $actividad->id_fase // Indentación para mostrar como subtarea
                ];
            }
        }

        return response()->json([
            'ganttDhtmlx' => $ganttData1,
            'estado' => 'success',
            'mensaje' => 'Se cargo correctamente el Gantt',
        ]);
    }
}
