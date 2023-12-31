<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desparacitar extends Model
{
    use HasFactory;

    protected $table = 'aplicados';

    public function Paciente()
    {
        return $this->belongsTo( Paciente::class,'num_id','id');
    }

    public function medicamento()
    {
        return $this->belongsTo( Medicamento::class,'medi_id','id');
    }

   
}
