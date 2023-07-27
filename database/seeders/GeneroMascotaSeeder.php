<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GeneroMascota;

class GeneroMascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genero_mascotas = [

            'Hembra',
            'Macho',
   
           
        ];
        foreach($genero_mascotas as $genero_mascota){
               GeneroMascota::create([
                   'name'=> $genero_mascota
               ]);
   
               
        }
    }
}
