<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoCuentaCobroSeeder extends Seeder
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
            'name' => Usuario::PERMISO_CUENTAS_COBROS_LISTADO,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Listar las cuentas de cobro'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_CUENTAS_COBROS_CREAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Crear la cuenta de cobro'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_CUENTAS_COBROS_EDITAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Editar la cuenta de cobro'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_CUENTAS_COBROS_ELIMINAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Eliminar la cuenta de cobro'
        ]);
    }
}
