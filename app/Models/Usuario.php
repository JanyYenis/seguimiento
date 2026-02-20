<?php

namespace App\Models;

use App\Classes\Models\User;
use App\Models\Sistema\Autenticacion;
use App\Notifications\RecuperarContrasena;
use App\Traits\Actividable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends User
{
    use HasRoles, Actividable;

    // Roles
    const ROL_CEO = 'ceo';
    const ROL_DESARROLLADOR_FULL_STACK = 'desarrollador.full.stack';
    const ROL_DESARROLLADOR_FRONTEND       = 'desarrollador.frontend';
    const ROL_DESARROLLADOR_BACKEND = 'desarrollador.backend';
    const ROL_DISENADOR_UX_UI = 'disenador.ux.ui';
    const ROL_GESTOR_PROYECTOS = 'gestor.proyectos';
    const ROL_ANALISTA_CALIDAD = 'analista.calidad';
    const ROL_MARKETING_VENTAS  = 'marketing.ventas';
    const ROL_SOPORTE  = 'soporte';
    const ROL_TESORERO  = 'tesorero';
    const ROL_CONTABILIDAD  = 'contabilidad';
    const ROL_ABOGADO  = 'abogado';
    const ROL_CLIENTE  = 'cliente';

    // PERMISOS USUARIOS
    const PERMISO_LISTADO   = 'usuarios.listado';
    const PERMISO_CREAR     = 'usuarios.crear';
    const PERMISO_EDITAR    = 'usuarios.editar';
    const PERMISO_ELIMINAR  = 'usuarios.eliminar';
    const PERMISO_AGREGAR_ROL      = 'usuarios.agregar-rol';
    const PERMISO_AGREGAR_PERMIDO  = 'usuarios.agregar-permiso';

    // PERMISOS PROYECTOS
    const PERMISO_PROYECTOS_CREAR = 'proyectos.crear';
    const PERMISO_PROYECTOS_LISTADO = 'proyectos.listado';
    const PERMISO_PROYECTOS_EDITAR = 'proyectos.editar';
    const PERMISO_PROYECTOS_ELIMINAR = 'proyectos.eliminar';

    // PERMISOS PRESUPUESTOS
    const PERMISO_PRESUPUESTO_CREAR = 'presupuestos.crear';
    const PERMISO_PRESUPUESTO_LISTADO = 'presupuestos.listado';
    const PERMISO_PRESUPUESTO_EDITAR = 'presupuestos.editar';
    const PERMISO_PRESUPUESTO_ELIMINAR = 'presupuestos.eliminar';

    // PERMISOS FASES
    const PERMISO_FASES_CREAR = 'fases.crear';
    const PERMISO_FASES_LISTADO = 'fases.listado';
    const PERMISO_FASES_EDITAR = 'fases.editar';
    const PERMISO_FASES_ELIMINAR = 'fases.eliminar';

    // PERMISOS ACTIVIDADES
    const PERMISO_ACTIVIDADES_CREAR = 'actividades.crear';
    const PERMISO_ACTIVIDADES_LISTADO = 'actividades.listado';
    const PERMISO_ACTIVIDADES_EDITAR = 'actividades.editar';
    const PERMISO_ACTIVIDADES_ELIMINAR = 'actividades.eliminar';

    // PERMISOS TAREAS
    const PERMISO_TAREAS_CREAR = 'tareas.crear';
    const PERMISO_TAREAS_LISTADO = 'tareas.listado';
    const PERMISO_TAREAS_EDITAR = 'tareas.editar';
    const PERMISO_TAREAS_ELIMINAR = 'tareas.eliminar';

    // PERMISOS ARCHIVOS
    const PERMISO_ARCHIVOS_CREAR = 'archivos.crear';
    const PERMISO_ARCHIVOS_LISTADO = 'archivos.listado';
    const PERMISO_ARCHIVOS_EDITAR = 'archivos.editar';
    const PERMISO_ARCHIVOS_ELIMINAR = 'archivos.eliminar';

    // PERMISOS ACTAS
    const PERMISO_ACTAS_CREAR = 'actas.crear';
    const PERMISO_ACTAS_LISTADO = 'actas.listado';
    const PERMISO_ACTAS_EDITAR = 'actas.editar';
    const PERMISO_ACTAS_ELIMINAR = 'actas.eliminar';

    // PERMISOS CUENTAS_COBROS
    const PERMISO_CUENTAS_COBROS_CREAR = 'cuentas-cobros.crear';
    const PERMISO_CUENTAS_COBROS_LISTADO = 'cuentas-cobros.listado';
    const PERMISO_CUENTAS_COBROS_EDITAR = 'cuentas-cobros.editar';
    const PERMISO_CUENTAS_COBROS_ELIMINAR = 'cuentas-cobros.eliminar';

    // PERMISOS TICKETS
    const PERMISO_TICKETS_CREAR = 'tickets.crear';
    const PERMISO_TICKETS_LISTADO = 'tickets.listado';
    const PERMISO_TICKETS_EDITAR = 'tickets.editar';
    const PERMISO_TICKETS_ELIMINAR = 'tickets.eliminar';
    const PERMISO_TICKETS_ASIGNAR_RESPONSABLE = 'tickets.asignar.responsable';

    const TC_ESTADO = 'TC_ESTADO_GENERAL';
    const ACTIVO    = 1;
    const INACTIVO  = 2;
    const ELIMINADO = 0;

    const TC_GENERO_USUARIOS = 'TC_GENERO_USUARIOS';
    const MASCULINO = 1;
    const FEMENINO  = 2;

    const TC_TIPO_DOCUMENTO = 'TC_TIPO_DOCUMENTO';
    const CC = 1;
    const TI = 2;
    const PP = 3;

    protected $table = 'usuarios';
    protected $appends = ['nombre_completo', 'numero_completo'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'genero',
        'tipo_documento',
        'identificacion',
        'codigo_tel',
        'telefono',
        'email',
        'password',
        'cod_ciudad',
        'foto',
        'estado',
        'google2fa_secret',
        'firma',
    ];

    protected $with = [
        'ciudad.pais',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->id = Str::uuid();
    //     });
    // }

    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     */
    protected function google2faSecret()
    {
        if (!$this->google2fa_secret) {
            return false;
        }

        return new Attribute(
            get: fn ($value) =>  decrypt($value),
            set: fn ($value) =>  encrypt($value),
        );
    }

    public function autenticaciones()
    {
        return $this->hasMany(Autenticacion::class, 'cod_usuario', 'id');
    }

    public function autenticacion()
    {
        return $this->hasOne(Autenticacion::class, 'cod_usuario', 'id');
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'cod_ciudad', 'id');
    }

    public function proyectos()
    {
        return $this->hasMany(ResponsableProyecto::class, 'cod_usuario', 'id');
    }

    public function proyecto()
    {
        return $this->hasOne(ResponsableProyecto::class, 'cod_usuario', 'id');
    }

    public function infoGenero()
    {
        return darInfoConcepto($this, self::TC_GENERO_USUARIOS, 'genero')->selectRaw('conceptos.*');
    }

    public function infoDocumento()
    {
        return darInfoConcepto($this, self::TC_TIPO_DOCUMENTO, 'tipo_documento')->selectRaw('conceptos.*');
    }

    public static function darTipoGenero($infoTipoConcepto = true)
    {
        return darConceptos(self::TC_GENERO_USUARIOS, $infoTipoConcepto);
    }

    public static function darTipoDocumento($infoTipoConcepto = true)
    {
        return darConceptos(self::TC_TIPO_DOCUMENTO, $infoTipoConcepto);
    }

    public function getNombreCompletoAttribute()
    {
        $nombre = $this?->nombre ?? 'N/A';
        $apellido = '';
        if ($this->apellido) {
            $apellido = $this->apellido;
        }

        return $nombre.' '.$apellido;
    }

    public function getNumeroCompletoAttribute()
    {
        $tel = $this->codigo_tel.$this->telefono;

        return $tel;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RecuperarContrasena($token));
    }
}
