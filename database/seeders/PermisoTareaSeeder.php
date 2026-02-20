<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoTareaSeeder extends Seeder
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
            'name' => Usuario::PERMISO_TAREAS_CREAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Crear tareas'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_TAREAS_LISTADO,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Ver tareas'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_TAREAS_EDITAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Editar tareas'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_TAREAS_ELIMINAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Eliminar tareas'
        ]);
    }
}
