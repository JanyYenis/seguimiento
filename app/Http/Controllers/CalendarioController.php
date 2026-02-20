<?php

namespace App\Http\Controllers;

use App\Events\UsuarioRolEvent;
use App\Exceptions\ErrorException;
use App\Models\Calendario;
use App\Notifications\CalendarioStoreNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CalendarioController extends Controller
{
    public function index()
    {
        return view('calendario.index');
    }

    public function consultar(Request $request) {
        $usuario = auth()->user();
        $calendarios = Calendario::where('id_usuario', $usuario->id)
            ->where('estado', Calendario::ACTIVO)
            ->get();

        $fechas = [];
        foreach ($calendarios as $key => $calendario) {
            $fechaInicio = $calendario?->fecha_inicio ?? date('Y-m-d');
            $fechaFin = $calendario?->fecha_fin ?? '';
            if ($calendario?->dia) {
                $fechaInicio = substr($fechaInicio, 0, 10);
                $fechaFin = substr($fechaFin, 0, 10);
            }
            $fechas[] = [
                'id' => ($calendario?->id ?? 0),
                'title' => ($calendario?->nombre ?? 'N/A'),
                'start' => ($fechaInicio),
                'end' => ($fechaFin ?? ''),
                'url' => ($calendario?->url ?? ''),
            ];
        }

        return response()->json([
            'estado' => 'success',
            'mensaje' => 'Se cargo correctamente el calendario',
            'fechas' => $fechas,
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->all();
        $datos['fecha_inicio'] = Carbon::parse($datos['fecha_inicio'].' '.$datos['hora_inicio']);
        $datos['fecha_fin'] = Carbon::parse($datos['fecha_fin'].' '.$datos['hora_fin']);
        $datos['id_usuario'] = auth()->user()->id;

        $calendario = Calendario::create($datos);

        if (!$calendario) {
            throw new ErrorException("Error al intentar agregar un evento al calendario.");
        }

        Notification::sendNow(auth()->user(), new CalendarioStoreNotification(auth()->user(), $calendario));
        broadcast(new UsuarioRolEvent(auth()->user()));

        return [
            'estado' => 'success',
            'mensaje' => 'Se agrego el evento correctamente.',
        ];
    }

    public function edit(Request $request, Calendario $calendario)
    {
        $info['calendario'] = $calendario;
        $respuesta["estado"] = "success";
        $respuesta["mensaje"] = "Datos cargados correctamente";
        $respuesta['html'] = view("calendario.editar", $info)->render();
    
        return response()->json($respuesta);
    }

    public function update(Request $request, Calendario $calendario)
    {
        $datos = $request->all();
        $datos['fecha_inicio'] = Carbon::parse($datos['fecha_inicio'].' '.$datos['hora_inicio']);
        $datos['fecha_fin'] = Carbon::parse($datos['fecha_fin'].' '.$datos['hora_fin']);
        $datos['id_usuario'] = auth()->user()->id;

        $actualizar = $calendario->update($datos);

        if (!$actualizar) {
            throw new ErrorException("Error al intentar actualizar el evento.");
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se actualizo el evento correctamente.',
        ];
    }

    public function delete(Request $request, Calendario $calendario)
    {
        $eliminar = $calendario->eliminar();

        if (!$eliminar) {
            throw new ErrorException("Error al intentar eliminar el evento.");
        }

        return [
            'estado' => 'success',
            'mensaje' => 'Se elimino correctamente el evento.',
        ];
    }
}
