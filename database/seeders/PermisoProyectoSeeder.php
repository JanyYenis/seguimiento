<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoProyectoSeeder extends Seeder
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
            'name' => Usuario::PERMISO_PROYECTOS_CREAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Crear proyectos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_PROYECTOS_LISTADO,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Ver listado de proyectos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_PROYECTOS_EDITAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Editar proyectos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_PROYECTOS_ELIMINAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Eliminar proyectos'
        ]);
    }
}
