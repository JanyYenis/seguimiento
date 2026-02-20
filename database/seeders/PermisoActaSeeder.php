<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoActaSeeder extends Seeder
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
            'name' => Usuario::PERMISO_ACTAS_CREAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Crear actas'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ACTAS_LISTADO,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Ver actas'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ACTAS_EDITAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Editar actas'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ACTAS_ELIMINAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Eliminar actas'
        ]);
    }
}
