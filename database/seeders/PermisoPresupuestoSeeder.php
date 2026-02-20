<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoPresupuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->crearPermisos();
    }

    public function crearPermisos()
    {
        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_PRESUPUESTO_CREAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Crear presupuestos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_PRESUPUESTO_LISTADO,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Ver presupuestos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_PRESUPUESTO_EDITAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Editar presupuestos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_PRESUPUESTO_ELIMINAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Eliminar presupuestos'
        ]);
    }
}
