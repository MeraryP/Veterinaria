<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

  


    
    public function genero_mascota()
    {
        return $this->belongsTo( GeneroMascota::class,'genero_id',"id");
    }




    use HasFactory;
}
