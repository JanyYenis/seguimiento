<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoFaseSeeder extends Seeder
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
            'name' => Usuario::PERMISO_FASES_CREAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Crear fase'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_FASES_LISTADO,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Ver fase'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_FASES_EDITAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Editar fase'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_FASES_ELIMINAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Eliminar fase'
        ]);
    }
}
