<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\ActaReunion;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ActaReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->where('name', Usuario::ROL_CLIENTE);
            })
            ->get();

        $info['clientes'] = $clientes;

        return view('actas.index', $info);
    }

    /**
     * Show the form for listado a new resource.
     */
    public function listado()
    {
        if (!can(Usuario::PERMISO_ACTAS_LISTADO) && !can(Usuario::PERMISO_ACTAS_CREAR) && !can(Usuario::PERMISO_ACTAS_EDITAR) && !can(Usuario::PERMISO_ACTAS_ELIMINAR)) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $actas = ActaReunion::selectRaw("actas_reuniones.id as id, actas_reuniones.nombre_reunion,
            CONCAT(c.nombre, ' ', c.apellido) as nombre_cliente, actas_reuniones.fecha,
            CONCAT(r.nombre, ' ', r.apellido) as nombre_responsable, actas_reuniones.acuerdos,
            actas_reuniones.conclusion, actas_reuniones.fecha_proxima_reunion, actas_reuniones.estado")
            ->join('usuarios as c', 'c.id', '=', 'actas_reuniones.cod_cliente')
            ->join('usuarios as r', 'r.id', '=', 'actas_reuniones.cod_responsable')
            ->where('actas_reuniones.estado', '!=', ActaReunion::ELIMINADO)
            ->where(function($query) {
                if (auth()->user()->hasRole(Usuario::ROL_CLIENTE)) {
                    $query->where('cod_cliente', auth()->user()->id);
                } else if (!auth()->user()->hasRole(Usuario::ROL_CEO)) {
                    $query->where('cod_responsable', auth()->user()->id);
                }
            })
            ->orderByDesc('actas_reuniones.fecha');

        return DataTables::eloquent($actas)
            ->addColumn("estado", function ($model) {
                $info['concepto'] = $model?->infoEstado;
                return view("sistema.estado", $info);
            })
            ->addColumn("action", function($model) {
                $info['model'] = $model;
                $info['puedeEditar'] = can(Usuario::PERMISO_ACTAS_EDITAR);
                $info['puedeEliminar'] = can(Usuario::PERMISO_ACTAS_ELIMINAR);
                return view("actas.columnas.acciones", $info);
            })
            ->rawColumns(["action"])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        $datos['cod_responsable'] = auth()->user()->id;

        $acta = ActaReunion::create($datos);

        if (!$acta) {
            throw new ErrorException('Error al intentar crear el acta de reunión.');
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se creo correctamente el acta de reunión.',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActaReunion $acta)
    {
        $clientes = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->where('name', Usuario::ROL_CLIENTE);
            })
            ->get();

        $responsables = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) use($acta) {
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
            })->orWhere('id', $acta->cod_cliente)
            ->get();

        $info['responsables'] = $responsables;
        $info['clientes'] = $clientes;
        $info['acta'] = $acta;

        return view('actas.editar', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActaReunion $acta)
    {
        $datos = $request->all();
        $actualizar = $acta->update($datos);

        if (!$actualizar) {
            throw new ErrorException('Error al intentar actualizar el acta de reunión.');
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizo correctamente el acta de reunión.',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(ActaReunion $acta)
    {
        $eliminar = $acta->eliminar();

        if (!$eliminar) {
            throw new ErrorException('A ocurrido un error al intentar eliminar el acta de reunión.');
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se eliminado correctamente el acta de reunión.',
        ];
    }

    public function verActa(Request $request, ActaReunion $acta)
    {
        $acta->load(
            'asistentesActivos',
            'puntosOrdenDiaActivos.responsable'
        );
        $data = [
            'acta' => $acta,
        ];

        $pdf = Pdf::loadView('actas/pdf/index', $data);
        $fecha = date('d/m/Y');
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream("Acta de Reunión-{$fecha}.pdf");
    }
}
