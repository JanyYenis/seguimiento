<?php

namespace App\Models;

use App\Classes\Models\Model;
use Illuminate\Support\Str;

class CuentaCobro extends Model
{
    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    public $table = 'cuentas_cobros';

    public $fillable = [
        'fecha',
        'cod_proyecto',
        'cod_remitente',
        'valor',
        'numero_cuenta',
        'banco',
        'estado',
    ];

    protected $casts = [
        'id' => 'string', // Esto fuerza a que el UUID se mantenga como string
        "fecha" => "date:d/m/Y",
        "created_at" => "date:d/m/Y",
        "updated_at" => "date:d/m/Y",
    ];

    protected $dates = [
        "fecha" => "date:d/m/Y",
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

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'cod_proyecto', 'id');
    }

    public function remitente()
    {
        return $this->belongsTo(Usuario::class, 'cod_remitente', 'id');
    }

    public function servicios()
    {
        return $this->hasMany(ServicioCuentaCobro::class, 'cod_cuenta', 'id');
    }

    public function serviciosActivos()
    {
        return $this->servicios()->where('estado', ServicioCuentaCobro::ACTIVO);
    }

    public function serviciosNoEliminados()
    {
        return $this->servicios()->whereNot('estado', ServicioCuentaCobro::ELIMINADO);
    }
}
