<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->crearRoles();
    }

    public function crearRoles()
    {
        Role::updateOrCreate([
            'name' => Usuario::ROL_CEO,
        ],[
            'nombre' => 'CEO',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_DESARROLLADOR_FULL_STACK,
        ],[
            'nombre' => 'Desarrollador Full Stack',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_DESARROLLADOR_FRONTEND,
        ],[
            'nombre' => 'Desarrollador Frontend',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_DESARROLLADOR_BACKEND,
        ],[
            'nombre' => 'Desarrollador Backend',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_DISENADOR_UX_UI,
        ],[
            'nombre' => 'Diseñador UX/UI',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_GESTOR_PROYECTOS,
        ],[
            'nombre' => 'Gestor De Proyectos',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_ANALISTA_CALIDAD,
        ],[
            'nombre' => 'Analista De Calidad',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_MARKETING_VENTAS,
        ],[
            'nombre' => 'Marketing Y Ventas',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_SOPORTE,
        ],[
            'nombre' => 'Soporte',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_TESORERO,
        ],[
            'nombre' => 'Tesorero',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_CONTABILIDAD,
        ],[
            'nombre' => 'Contabilidad',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_ABOGADO,
        ],[
            'nombre' => 'Abogado',
            'guard_name' => 'web',
        ]);

        Role::updateOrCreate([
            'name' => Usuario::ROL_CLIENTE,
        ],[
            'nombre' => 'Cliente',
            'guard_name' => 'web',
        ]);
    }
}
