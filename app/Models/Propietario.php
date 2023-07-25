<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;


     
    public function genero()
    {
        return $this->belongsTo( Genero::class,'gene_id',"id");
    }

    public function Paciente()
    {
        return $this->belongsTo( Paciente::class,'num_id',"id");
    }


    
}
