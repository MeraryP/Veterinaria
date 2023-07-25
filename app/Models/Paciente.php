<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

  


    
    public function genero()
    {
        return $this->belongsTo( Genero::class,'gene_id',"id");
    }




    use HasFactory;
}
