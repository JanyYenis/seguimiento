<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\CuentaCobro;
use App\Models\Proyecto;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CuentaCobroController extends Controller
{
    public function index(Request $request)
    {
        $proyectos = Proyecto::whereNot('estado', Proyecto::ELIMINADO)
            ->get();
        $remitentes = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->whereIn('name', [Usuario::ROL_DESARROLLADOR_FULL_STACK, Usuario::ROL_DESARROLLADOR_FRONTEND,
                Usuario::ROL_DESARROLLADOR_BACKEND, Usuario::ROL_DISENADOR_UX_UI, Usuario::ROL_SOPORTE, Usuario::ROL_CEO]);
            })
            ->get();

        $info['proyectos'] = $proyectos;
        $info['remitentes'] = $remitentes;

        return view('cuentas-cobros.index', $info);
    }

    /**
     * Show the form for listado a new resource.
     */
    public function listado()
    {
        if (!can(Usuario::PERMISO_CUENTAS_COBROS_LISTADO) && !can(Usuario::PERMISO_CUENTAS_COBROS_CREAR) && !can(Usuario::PERMISO_CUENTAS_COBROS_EDITAR) && !can(Usuario::PERMISO_CUENTAS_COBROS_ELIMINAR)) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $cuentas = CuentaCobro::selectRaw("cuentas_cobros.id as id, DATE(cuentas_cobros.fecha) as fecha,
            CONCAT(c.nombre, ' ', c.apellido) as nombre_cliente, cuentas_cobros.valor,
            CONCAT(r.nombre, ' ', r.apellido) as nombre_remitente, cuentas_cobros.estado")
            ->join('proyectos as p', 'p.id', '=', 'cuentas_cobros.cod_proyecto')
            ->join('usuarios as c', 'c.id', '=', 'p.cod_cliente')
            ->join('usuarios as r', 'r.id', '=', 'cuentas_cobros.cod_remitente')
            ->where('cuentas_cobros.estado', '!=', CuentaCobro::ELIMINADO)
            ->orderByDesc('cuentas_cobros.fecha');

        return DataTables::eloquent($cuentas)
            ->addColumn("estado", function ($model) {
                $info['concepto'] = $model?->infoEstado;
                return view("sistema.estado", $info);
            })
            ->addColumn('valor', function($model) {
                return '$'.formatoMiles($model?->valor ?? 0);
            })
            ->addColumn("action", function($model) {
                $info['model'] = $model;
                $info['puedeEditar'] = can(Usuario::PERMISO_CUENTAS_COBROS_EDITAR);
                $info['puedeEliminar'] = can(Usuario::PERMISO_CUENTAS_COBROS_ELIMINAR);
                return view("cuentas-cobros.columnas.acciones", $info);
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

        $cuenta = CuentaCobro::create($datos);

        if (!$cuenta) {
            throw new ErrorException('Error al intentar crear la cuenta de cobro.');
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se creo correctamente la cuenta de cobro.',
            'id' => $cuenta->id
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
    public function edit(CuentaCobro $cuenta)
    {
        $proyectos = Proyecto::whereNot('estado', Proyecto::ELIMINADO)
            ->get();
        $remitentes = Usuario::where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
                $query->whereIn('name', [Usuario::ROL_DESARROLLADOR_FULL_STACK, Usuario::ROL_DESARROLLADOR_FRONTEND,
                Usuario::ROL_DESARROLLADOR_BACKEND, Usuario::ROL_DISENADOR_UX_UI, Usuario::ROL_SOPORTE, Usuario::ROL_CEO]);
            })
            ->get();

        $info['proyectos'] = $proyectos;
        $info['remitentes'] = $remitentes;
        $info['cuenta'] = $cuenta;

        return view('cuentas-cobros.editar', $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CuentaCobro $cuenta)
    {
        $datos = $request->all();
        $actualizar = $cuenta->update($datos);

        if (!$actualizar) {
            throw new ErrorException('Error al intentar actualizar la cuenta de cobro.');
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizo correctamente la cuenta de cobro.',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(CuentaCobro $cuenta)
    {
        $eliminar = $cuenta->eliminar();

        if (!$eliminar) {
            throw new ErrorException('A ocurrido un error al intentar eliminar la cuenta de cobro.');
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se eliminado correctamente la cuenta de cobro.',
        ];
    }

    public function ver(Request $request, CuentaCobro $cuenta)
    {
        $cuenta->load(
            'proyecto.cliente.infoDocumento',
            'remitente.infoDocumento',
            'serviciosActivos.fase',
        );
        $data = [
            'cuenta' => $cuenta,
        ];

        $pdf = Pdf::loadView('cuentas-cobros/pdf/index', $data);
        $fecha = date('d/m/Y');
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream("Cuenta de cobro-{$fecha}.pdf");
    }
}
