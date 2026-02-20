<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisoArchivoSeeder extends Seeder
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
            'name' => Usuario::PERMISO_ARCHIVOS_CREAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Crear archivos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ARCHIVOS_LISTADO,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Ver archivos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ARCHIVOS_EDITAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Editar archivos'
        ]);

        Permission::updateOrCreate([
            'name' => Usuario::PERMISO_ARCHIVOS_ELIMINAR,
        ], [
            'guard_name' => 'web',
            'nombre' => 'Eliminar archivos'
        ]);
    }
}
