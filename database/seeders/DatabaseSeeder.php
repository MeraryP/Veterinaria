<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class]);
        $this->call([PermissionSeeder::class]);
        $this->call([RoleHasPermissionSeeder::class]);

        $this->call([CategoriaSeeder::class]);
        $this->call([GeneroMascotaSeeder::class]);
        $this->call([GeneroSeeder::class]);
        $this->call(UserSeeder::class);
        $this->call([EspecieSeeder::class]);
        $this->call([PropietarioSeeder::class]);
        $this->call([PacienteSeeder::class]);
        $this->call([ExamenSeeder::class]);
        $this->call([ClinicoSeeder::class]); 
        $this->call([MedicamentoSeeder::class]);
        $this->call([VacunaSeeder::class]);
        $this->call([DesparacitarSeeder::class]); 
    }
}

