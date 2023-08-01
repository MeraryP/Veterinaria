<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

    protected $fillable = ['filename'];


    
    public function genero_mascota()
    {
        return $this->belongsTo( GeneroMascota::class,'genero_id',"id");
    }


    public function especie()
    {
        return $this->belongsTo( Especie::class,'especie_id',"id");
    }

    public function propietario()
    {
        return $this->belongsTo( Propietario::class,'pro_id',"id");
    }




    use HasFactory;
}
