<?php

namespace App\Models;

use App\Classes\Models\Model;
use Illuminate\Support\Str;

class ActaReunion extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    public $table = 'actas_reuniones';

    public $fillable = [
        'nombre_reunion',
        'cod_cliente',
        'fecha',
        'fecha_proxima_reunion',
        'estado',
        'acuerdos',
        'conclusion',
        'cod_responsable',
        'url_firma',
    ];

    protected $casts = [
        'id' => 'string', // Esto fuerza a que el UUID se mantenga como string
        "fecha" => "date:d/m/Y g:i a",
        "fecha_proxima_reunion" => "date:d/m/Y g:i a",
        "created_at" => "date:d/m/Y",
        "updated_at" => "date:d/m/Y",
    ];

    protected $dates = [
        "fecha" => "date:d/m/Y g:i a",
        "fecha_proxima_reunion" => "date:d/m/Y g:i a",
        "created_at" => "date:d/m/Y",
        "updated_at" => "date:d/m/Y",
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function asistentes()
    {
        return $this->hasMany(AsistenteReunion::class, 'cod_acta', 'id');
    }

    public function asistentesActivos()
    {
        return $this->asistentes()->where('estado', AsistenteReunion::ACTIVO);
    }

    public function asistentesNoEliminados()
    {
        return $this->asistentes()->whereNot('estado', AsistenteReunion::ELIMINADO);
    }

    public function puntosOrdenDia()
    {
        return $this->hasMany(PuntoOrdenDia::class, 'cod_acta', 'id');
    }

    public function puntosOrdenDiaActivos()
    {
        return $this->puntosOrdenDia()->where('estado', PuntoOrdenDia::ACTIVO)->orderBy('numero');
    }

    public function puntosOrdenDiaNoEliminado()
    {
        return $this->puntosOrdenDia()->whereNot('estado', PuntoOrdenDia::ELIMINADO)->orderBy('numero');
    }

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'cod_cliente', 'id');
    }

    public function responsable()
    {
        return $this->belongsTo(Usuario::class, 'cod_responsable', 'id');
    }
}
