<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesPermisosSeeder::class,
            PermisoUsuarioSeeder::class,
            PermisoProyectoSeeder::class,
            PermisoFaseSeeder::class,
            PermisoActividadSeeder::class,
            PermisoTareaSeeder::class,
            PermisoPresupuestoSeeder::class,
            PermisoArchivoSeeder::class,
            PermisoActaSeeder::class,
            PermisoCuentaCobroSeeder::class,
            PermisoTicketSeeder::class,
            AsignarPermisoSeeder::class,
        ]);
    }
}
