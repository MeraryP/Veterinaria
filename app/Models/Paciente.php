<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

    public function vacuna(){ 

        return $this->belongsTo( Vacuna::class,'vacuna_id',"id");
    
    }


    
    public function genero()
    {
        return $this->belongsTo( Genero::class,'gene_id',"id");
    }


    public function propietario()
    {
        return $this->belongsTo( Propietario::class,'pro_id',"id");
    }


    public function Examen()
    {
        return $this->belongsTo( Examen::class,'exa_id',"id");
    }



    use HasFactory;
}
