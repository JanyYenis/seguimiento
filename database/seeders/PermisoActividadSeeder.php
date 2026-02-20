<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoActividadSeeder extends Seeder
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
            'name' => Usuario::PERMISO_ACTIVIDADES_CREAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Crear actividad'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ACTIVIDADES_LISTADO,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Ver actividad'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ACTIVIDADES_EDITAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Editar actividad'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ACTIVIDADES_ELIMINAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Eliminar actividad'
        ]);
    }
}
