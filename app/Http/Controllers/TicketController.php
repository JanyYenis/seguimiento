<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorException;
use App\Models\Proyecto;
use App\Models\Ticket;
use App\Models\Usuario;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if (!can(Usuario::PERMISO_TICKETS_CREAR) && !can(Usuario::PERMISO_TICKETS_EDITAR) &&
            !can(Usuario::PERMISO_TICKETS_LISTADO) && !can(Usuario::PERMISO_TICKETS_ELIMINAR)) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $proyectos = Proyecto::selectRaw('id, nombre')
            ->where(function($query) {
                if (auth()->user()->hasRole(Usuario::ROL_CLIENTE)) {
                    $query->where('cod_cliente', auth()->user()->id);
                }
            })
            ->whereNot('estado', Proyecto::ELIMINADO)
            ->get();

        $responsables = Usuario::selectRaw('id, CONCAT(nombre, " ", apellido) as text')
            ->where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
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
                    Usuario::ROL_CONTABILIDAD,
                    Usuario::ROL_ABOGADO
                ]);
            })
            ->get();

        $info['proyectos'] = $proyectos;
        $info['responsables'] = $responsables;
        $info['estados'] = Ticket::darEstados();
        $info['tipos'] = Ticket::darTipo();
        $info['prioridades'] = Ticket::darPrioridad();

        return view('tickets.index', $info);
    }

    public function listado(Request $request)
    {
        if (!can(Usuario::PERMISO_PROYECTOS_LISTADO)) {
            throw new ErrorException("No tienes permisos para acceder a esta sección.");
        }

        $pagina = $request->input('pagina') ?? 1;
        $cantidad = $request->input("cantidad_pagina", 6);

        $ticketsQuery = Ticket::with(
            'cliente',
            'responsable',
            'proyecto',
            'infoEstado',
            'infoTipo',
            'infoPrioridad',
        )
        ->where(function($query) {
            if (auth()->user()->hasRole(Usuario::ROL_CLIENTE)) {
                $query->where('cod_usuario', auth()->user()->id);
            } else if (!auth()->user()->hasRole(Usuario::ROL_CEO) && !auth()->user()->hasRole(Usuario::ROL_SOPORTE) && !auth()->user()->hasRole(Usuario::ROL_ANALISTA_CALIDAD)) {
                $query->where('cod_responsable', auth()->user()->id);
            }
        })
        ->whereNot('estado', Ticket::ELIMINADO);

        $tickets = $ticketsQuery->paginate($cantidad, ["*"], "tickets", $pagina);
        $info['ultimaPagina'] = $tickets->lastPage();
        $info["tickets"] = $tickets;
        $info['paginaActual'] = $pagina;

        return [
            "estado" => "success",
            "html" => view("tickets.listado", $info)->render()
        ];
    }

    public function store(Request $request)
    {
        $datos = $request->all();
        $datos['cod_usuario'] = auth()->user()->id;

        $ticket = Ticket::create($datos);

        if (!$ticket) {
            throw new ErrorException("Error al intentar crear el ticket.");
        }

        // Notification::sendNow(auth()->user(), new TareaStoreNotification(auth()->user(), $tarea));
        // broadcast(new UsuarioRolEvent(auth()->user()));

        // if (array_key_exists('notificar_responsable', $datos)) {
        //     foreach ($responsables as $key => $responsable) {
        //         $datosResponsables = Usuario::find($responsable);
        //         if (auth()->user()->id != $datosResponsables->id) {
        //             Notification::sendNow($datosResponsables, new TareaStoreNotification($datosResponsables, $tarea));
        //             broadcast(new UsuarioRolEvent($datosResponsables));
        //         }
        //     }
        // }

        return [
            'estado' => 'success',
            'mensaje' => 'Se agrego el ticket correctamente.',
        ];
    }

    public function edit(Request $request, Ticket $ticket)
    {
        $ticket->load(
            'infoTipo',
            'infoPrioridad',
            'infoEstado',
            'proyecto',
            'cliente',
        );

        $responsables = Usuario::selectRaw('id, CONCAT(nombre, " ", apellido) as text')
            ->where('estado', Usuario::ACTIVO)
            ->whereHas('roles', function($query) {
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
                    Usuario::ROL_CONTABILIDAD,
                    Usuario::ROL_ABOGADO
                ]);
            })
            ->get();

        $info['clase'] = Ticket::darNombreTabla();
        $info['responsables'] = $responsables;
        $info['estados'] = Ticket::darEstados();
        $info['tipos'] = Ticket::darTipo();
        $info['prioridades'] = Ticket::darPrioridad();
        $info['ticket'] = $ticket;

        return view('tickets.editar', $info);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $datos = $request->all();
        $datos['descripcion_comentario'] = $datos['descripcion_comentario'] != '<p><br></p>' ? $datos['descripcion_comentario'] : null;
        if (!can('tickets.asignar.responsable')) {
            unset($datos['cod_responsable']);
            unset($datos['estado']);
            unset($datos['tipo']);
            unset($datos['prioridad']);
        }

        $actualizar = $ticket->update($datos);

        if (!$actualizar) {
            throw new ErrorException("Error al intentar actualizar el ticket.");
        }

        if ($datos['descripcion_comentario']) {
            $info['descripcion'] = $datos['descripcion_comentario'];
            $info['cod_usuario'] = auth()->user()->id;
            $info['comentariable_id'] = $ticket->id;
            $info['comentariable_type'] = Ticket::darNombreTabla();

            $comentario = $ticket->crearComentario($info);

            if (!$comentario) {
                throw new ErrorException("Error al intentar guardar el comentario.");
            }
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizo el ticket correctamente.',
        ];
    }
}
