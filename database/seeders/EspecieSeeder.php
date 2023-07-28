<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Especie;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especies = [

            'Cannino',
            'Equino',
            'Felino',
            'Otra'
   
           
        ];
        foreach($especies as $especie){
               Especie::create([
                   'nombre_especie'=> $especie
               ]);
   
               
        }
    }
}
