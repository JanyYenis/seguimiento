<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AsignarPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->asignarPermisos();
    }

    /**
     * Función que permite asignar los permisos a los roles.
     * @return void
     */
    public function asignarPermisos()
    {
        $rolAdministrador = Role::findByName(Usuario::ROL_DESARROLLADOR_FULL_STACK);
        $rolAdministrador->syncPermissions([
            Usuario::PERMISO_PROYECTOS_LISTADO,
            Usuario::PERMISO_PROYECTOS_CREAR,
            Usuario::PERMISO_PROYECTOS_EDITAR,
            Usuario::PERMISO_PROYECTOS_ELIMINAR,
            Usuario::PERMISO_PRESUPUESTO_LISTADO,
            Usuario::PERMISO_PRESUPUESTO_CREAR,
            Usuario::PERMISO_PRESUPUESTO_EDITAR,
            Usuario::PERMISO_PRESUPUESTO_ELIMINAR,
            Usuario::PERMISO_TAREAS_LISTADO,
            Usuario::PERMISO_TAREAS_CREAR,
            Usuario::PERMISO_TAREAS_EDITAR,
            Usuario::PERMISO_TAREAS_ELIMINAR,
            Usuario::PERMISO_ARCHIVOS_LISTADO,
            Usuario::PERMISO_ARCHIVOS_CREAR,
            Usuario::PERMISO_ARCHIVOS_EDITAR,
            Usuario::PERMISO_ARCHIVOS_ELIMINAR,
            Usuario::PERMISO_FASES_LISTADO,
            Usuario::PERMISO_FASES_CREAR,
            Usuario::PERMISO_FASES_EDITAR,
            Usuario::PERMISO_FASES_ELIMINAR,
            Usuario::PERMISO_ACTIVIDADES_CREAR,
            Usuario::PERMISO_ACTIVIDADES_LISTADO,
            Usuario::PERMISO_ACTIVIDADES_EDITAR,
            Usuario::PERMISO_ACTIVIDADES_ELIMINAR,
            Usuario::PERMISO_ACTAS_CREAR,
            Usuario::PERMISO_ACTAS_LISTADO,
            Usuario::PERMISO_ACTAS_EDITAR,
            Usuario::PERMISO_ACTAS_ELIMINAR,
            Usuario::PERMISO_CUENTAS_COBROS_CREAR,
            Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
            Usuario::PERMISO_CUENTAS_COBROS_EDITAR,
            Usuario::PERMISO_CUENTAS_COBROS_ELIMINAR,
            Usuario::PERMISO_TICKETS_CREAR,
            Usuario::PERMISO_TICKETS_LISTADO,
            Usuario::PERMISO_TICKETS_EDITAR,
            Usuario::PERMISO_TICKETS_ELIMINAR,
        ]);
        $rolSoporte = Role::findByName(Usuario::ROL_SOPORTE);
        $rolSoporte->syncPermissions([
            Usuario::PERMISO_PROYECTOS_LISTADO,
            Usuario::PERMISO_PROYECTOS_CREAR,
            Usuario::PERMISO_PROYECTOS_EDITAR,
            Usuario::PERMISO_PROYECTOS_ELIMINAR,
            Usuario::PERMISO_PRESUPUESTO_LISTADO,
            Usuario::PERMISO_PRESUPUESTO_CREAR,
            Usuario::PERMISO_PRESUPUESTO_EDITAR,
            Usuario::PERMISO_PRESUPUESTO_ELIMINAR,
            Usuario::PERMISO_TAREAS_LISTADO,
            Usuario::PERMISO_TAREAS_CREAR,
            Usuario::PERMISO_TAREAS_EDITAR,
            Usuario::PERMISO_TAREAS_ELIMINAR,
            Usuario::PERMISO_ARCHIVOS_LISTADO,
            Usuario::PERMISO_ARCHIVOS_CREAR,
            Usuario::PERMISO_ARCHIVOS_EDITAR,
            Usuario::PERMISO_ARCHIVOS_ELIMINAR,
            Usuario::PERMISO_FASES_LISTADO,
            Usuario::PERMISO_FASES_CREAR,
            Usuario::PERMISO_FASES_EDITAR,
            Usuario::PERMISO_FASES_ELIMINAR,
            Usuario::PERMISO_ACTIVIDADES_CREAR,
            Usuario::PERMISO_ACTIVIDADES_LISTADO,
            Usuario::PERMISO_ACTIVIDADES_EDITAR,
            Usuario::PERMISO_ACTIVIDADES_ELIMINAR,
            Usuario::PERMISO_ACTAS_CREAR,
            Usuario::PERMISO_ACTAS_LISTADO,
            Usuario::PERMISO_ACTAS_EDITAR,
            Usuario::PERMISO_ACTAS_ELIMINAR,
            Usuario::PERMISO_CUENTAS_COBROS_CREAR,
            Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
            Usuario::PERMISO_CUENTAS_COBROS_EDITAR,
            Usuario::PERMISO_CUENTAS_COBROS_ELIMINAR,
            Usuario::PERMISO_TICKETS_CREAR,
            Usuario::PERMISO_TICKETS_LISTADO,
            Usuario::PERMISO_TICKETS_EDITAR,
            Usuario::PERMISO_TICKETS_ELIMINAR,
            Usuario::PERMISO_TICKETS_ASIGNAR_RESPONSABLE,
        ]);
        $rolCoordinadorProyecto = Role::findByName(Usuario::ROL_GESTOR_PROYECTOS);
        $rolCoordinadorProyecto->syncPermissions([
            Usuario::PERMISO_PROYECTOS_LISTADO,
            Usuario::PERMISO_PROYECTOS_CREAR,
            Usuario::PERMISO_PROYECTOS_EDITAR,
            Usuario::PERMISO_PROYECTOS_ELIMINAR,
            Usuario::PERMISO_PRESUPUESTO_LISTADO,
            Usuario::PERMISO_PRESUPUESTO_CREAR,
            Usuario::PERMISO_PRESUPUESTO_EDITAR,
            Usuario::PERMISO_PRESUPUESTO_ELIMINAR,
            Usuario::PERMISO_TAREAS_LISTADO,
            Usuario::PERMISO_TAREAS_CREAR,
            Usuario::PERMISO_TAREAS_EDITAR,
            Usuario::PERMISO_TAREAS_ELIMINAR,
            Usuario::PERMISO_ARCHIVOS_LISTADO,
            Usuario::PERMISO_ARCHIVOS_CREAR,
            Usuario::PERMISO_ARCHIVOS_EDITAR,
            Usuario::PERMISO_ARCHIVOS_ELIMINAR,
            Usuario::PERMISO_FASES_LISTADO,
            Usuario::PERMISO_FASES_CREAR,
            Usuario::PERMISO_FASES_EDITAR,
            Usuario::PERMISO_FASES_ELIMINAR,
            Usuario::PERMISO_ACTIVIDADES_CREAR,
            Usuario::PERMISO_ACTIVIDADES_LISTADO,
            Usuario::PERMISO_ACTIVIDADES_EDITAR,
            Usuario::PERMISO_ACTIVIDADES_ELIMINAR,
            Usuario::PERMISO_ACTAS_CREAR,
            Usuario::PERMISO_ACTAS_LISTADO,
            Usuario::PERMISO_ACTAS_EDITAR,
            Usuario::PERMISO_ACTAS_ELIMINAR,
            Usuario::PERMISO_CUENTAS_COBROS_CREAR,
            Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
            Usuario::PERMISO_CUENTAS_COBROS_EDITAR,
            Usuario::PERMISO_CUENTAS_COBROS_ELIMINAR,
            Usuario::PERMISO_TICKETS_CREAR,
            Usuario::PERMISO_TICKETS_LISTADO,
            Usuario::PERMISO_TICKETS_EDITAR,
            Usuario::PERMISO_TICKETS_ELIMINAR,
        ]);
        $rolCoordinadorProyecto = Role::findByName(Usuario::ROL_ANALISTA_CALIDAD);
        $rolCoordinadorProyecto->syncPermissions([
            Usuario::PERMISO_PROYECTOS_LISTADO,
            Usuario::PERMISO_PRESUPUESTO_LISTADO,
            Usuario::PERMISO_TAREAS_LISTADO,
            Usuario::PERMISO_ARCHIVOS_LISTADO,
            Usuario::PERMISO_FASES_LISTADO,
            Usuario::PERMISO_ACTIVIDADES_LISTADO,
            Usuario::PERMISO_ACTAS_LISTADO,
            Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
            Usuario::PERMISO_TICKETS_LISTADO,
            Usuario::PERMISO_TICKETS_CREAR,
            Usuario::PERMISO_TICKETS_EDITAR,
            Usuario::PERMISO_TICKETS_ELIMINAR,
        ]);
        $rolCliente = Role::findByName(Usuario::ROL_MARKETING_VENTAS);
        $rolCliente->syncPermissions([
            Usuario::PERMISO_PROYECTOS_LISTADO,
            Usuario::PERMISO_PRESUPUESTO_LISTADO,
            Usuario::PERMISO_TAREAS_LISTADO,
            Usuario::PERMISO_ARCHIVOS_LISTADO,
            Usuario::PERMISO_FASES_LISTADO,
            Usuario::PERMISO_ACTIVIDADES_LISTADO,
            Usuario::PERMISO_ACTAS_LISTADO,
            Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
            Usuario::PERMISO_TICKETS_LISTADO,
            Usuario::PERMISO_TICKETS_CREAR,
            Usuario::PERMISO_TICKETS_EDITAR,
            Usuario::PERMISO_TICKETS_ELIMINAR,
        ]);
        $rolTesorero = Role::findByName(Usuario::ROL_TESORERO);
        $rolTesorero->syncPermissions([
            Usuario::PERMISO_ARCHIVOS_LISTADO,
            Usuario::PERMISO_ARCHIVOS_CREAR,
            Usuario::PERMISO_ARCHIVOS_EDITAR,
            Usuario::PERMISO_ARCHIVOS_ELIMINAR,
            Usuario::PERMISO_PRESUPUESTO_LISTADO,
            Usuario::PERMISO_PRESUPUESTO_CREAR,
            Usuario::PERMISO_PRESUPUESTO_EDITAR,
            Usuario::PERMISO_PRESUPUESTO_ELIMINAR,
            Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
            Usuario::PERMISO_TICKETS_LISTADO,
            Usuario::PERMISO_TICKETS_CREAR,
            Usuario::PERMISO_TICKETS_EDITAR,
            Usuario::PERMISO_TICKETS_ELIMINAR,
        ]);
        $rolContador = Role::findByName(Usuario::ROL_CONTABILIDAD);
        $rolContador->syncPermissions([
            Usuario::PERMISO_PROYECTOS_LISTADO,
            Usuario::PERMISO_PRESUPUESTO_LISTADO,
            Usuario::PERMISO_TAREAS_LISTADO,
            Usuario::PERMISO_ARCHIVOS_LISTADO,
            Usuario::PERMISO_FASES_LISTADO,
            Usuario::PERMISO_ACTIVIDADES_LISTADO,
            Usuario::PERMISO_ACTAS_LISTADO,
            Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
            Usuario::PERMISO_TICKETS_LISTADO,
            Usuario::PERMISO_TICKETS_CREAR,
            Usuario::PERMISO_TICKETS_EDITAR,
            Usuario::PERMISO_TICKETS_ELIMINAR,
        ]);
        $rolCliente = Role::findByName(Usuario::ROL_CLIENTE);
        $rolCliente->syncPermissions([
            Usuario::PERMISO_PROYECTOS_LISTADO,
            Usuario::PERMISO_PRESUPUESTO_LISTADO,
            Usuario::PERMISO_TAREAS_LISTADO,
            Usuario::PERMISO_ARCHIVOS_LISTADO,
            Usuario::PERMISO_FASES_LISTADO,
            Usuario::PERMISO_ACTIVIDADES_LISTADO,
            Usuario::PERMISO_ACTAS_LISTADO,
            Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
            Usuario::PERMISO_TICKETS_LISTADO,
            Usuario::PERMISO_TICKETS_CREAR,
            Usuario::PERMISO_TICKETS_EDITAR,
            Usuario::PERMISO_TICKETS_ELIMINAR,
        ]);
    }
}
