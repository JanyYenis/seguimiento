<?php

namespace App\Http\Controllers;

use App\Mail\EnvioMail;
use App\Models\Mail as ModelsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webklex\IMAP\Facades\Client;
use Yajra\DataTables\Facades\DataTables;

class MailController extends Controller
{
    public function index(Request $request)
    {
        $correo = 'info@gijac.co';
        $info['no_leidos'] = ModelsMail::where('is_seen', ModelsMail::NO_LEIDO)
            ->where('folder', ModelsMail::INBOX)
            ->where(function($query) use($correo) {
                $query->whereJsonContains('to', $correo)
                    ->orWhereJsonContains('cc', $correo)
                    ->orWhereJsonContains('bcc', $correo);
            })
            ->count() ?? 0;

        return view('correos.index', $info);
    }

    public function listado(Request $request)
    {
        $correo = 'info@gijac.co';
        $mails = ModelsMail::selectRaw('message_id, is_seen, from_name, subject, flags, date')
            ->where('folder', ModelsMail::INBOX)
            ->where(function($query) use($correo) {
                $query->whereJsonContains('to', $correo)
                    ->orWhereJsonContains('cc', $correo)
                    ->orWhereJsonContains('bcc', $correo);
            })
            ->orderByDesc('date');

        return DataTables::eloquent($mails)
            ->addColumn('checkbox', function ($model) {
                return view('correos.columnas.check', ['id' => $model->message_id])->render();
            })
            ->addColumn('acciones', function ($model) {
                return view('correos.columnas.acciones', ['id' => $model->message_id])->render();
            })
            ->addColumn('autor', function ($model) {
                $info['isRead'] = $model->is_seen;
                $info['nombre'] = $model->from_name;
                return view('correos.columnas.autor', $info)->render();
            })
            ->addColumn('asunto', function ($model) {
                $info['isRead']    = $model->is_seen;
                $info['asunto']    = $model->subject;
                // $info['etiquetas'] = $model->flags;
                return view('correos.columnas.asunto', $info)->render();
            })
            ->addColumn('fecha_envio', function ($model) {
                $class = 'text-gray-400';
                if ($model->is_seen) {
                    $class = 'text-dark';
                }
                return "<span class='{$class}'>".$model->date."</span>";
            })
            ->rawColumns(['checkbox', 'acciones', 'autor', 'asunto', 'fecha_envio'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $datos = $request->all();
        $datos['para'] = array_column(json_decode($datos['para'], true), 'value');
        if ($datos['cc']) {
            $datos['cc'] = array_column(json_decode($datos['cc'], true), 'value');
        } else {
            $datos['cc'] = [];
        }
        if ($datos['cco']) {
            $datos['cco'] = array_column(json_decode($datos['cco'], true), 'value');
        } else {
            $datos['cco'] = [];
        }

        $mailer = Mail::to($datos['para']);

        if (count($datos['cc'])) {
            $mailer->cc($datos['cc']);
        }

        if (count($datos['cco'])) {
            $mailer->bcc($datos['cco']);
        }

        $mailer->send(new EnvioMail($datos));

        return [
            'estado' => 'success',
            'mensaje' => 'Se envio correctamente el correo'
        ];
    }
}
