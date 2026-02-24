<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ((!can(Usuario::PERMISO_PROYECTOS_CREAR) && !can(Usuario::PERMISO_PROYECTOS_EDITAR) &&
            !can(Usuario::PERMISO_PROYECTOS_LISTADO) && !can(Usuario::PERMISO_PROYECTOS_ELIMINAR) &&
            !can(Usuario::PERMISO_PRESUPUESTO_CREAR) && !can(Usuario::PERMISO_PRESUPUESTO_LISTADO) &&
            !can(Usuario::PERMISO_PRESUPUESTO_EDITAR) && !can(Usuario::PERMISO_PRESUPUESTO_ELIMINAR))) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $cantidad_total = Proyecto::whereNot('estado', Proyecto::ELIMINADO)
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

        $info['cantidad_total'] = $cantidad_total;
        $info['cantidad_completados'] = $cantidad_completados;
        $info['cantidad_pendientes'] = $cantidad_pendientes;
        $info['cantidad_ejecucion'] = $cantidad_ejecucion;
        $info['responsables'] = $responsables;
        $info['clientes'] = $clientes;

        return view('home', $info);
    }
}
