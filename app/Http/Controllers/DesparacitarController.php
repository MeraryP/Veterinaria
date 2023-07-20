<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desparacitar;

class DesparacitarController extends Controller{
    public function index(Request $request){
        $desparacitars= Desparacitar::all();
        return view ('desparacitar/index');
    }

    public function create(){
        return view('desparacitar.create');
    }

    public function store(Request $request) {
        $fecha_actual = date("Y-m-d");
        $max = date('Y-m-d',strtotime($fecha_actual));
        $minima = date('Y-m-d',strtotime($fecha_actual."- 100 year"));
        $maxima = date("Y-m-d",strtotime($max."+ 100 days"));
        $anio = date("Y");
        $this->validate($request,[
            'antiparacitario'=>'required|max:200',
            'fecha_desparacitacion'=>'required|date|before:'.$maxima.'|after:'.$minima,
            'fecha_volverDesparacitar'=>'required|date|before:'.$maxima.'|after:'.$minima,  
        ]);

        $Desparacitars = new Desparacitar();
        $Desparacitars->antiparacitario = $request->get('antiparacitario');
        $Desparacitars->fecha_desparacitacion = $request->get('fecha_desparacitacion');
        $Desparacitars->fecha_volverDesparacitar = $request->get('fecha_volverDesparacitar');

        $Desparacitars->save();

        if($Desparacitars){
            return redirect('/desparacitar')->with('mensaje', 'La triada fue creada exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
        
    }
    
}