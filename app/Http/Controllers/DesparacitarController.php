<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Desparacitar;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class DesparacitarController extends Controller{
    public function index(Request $request){
        $desparacitars= Desparacitar::all();
        return view ('desparacitar/index',compact('desparacitars'));
    }

    public function create(){
        $pacientes = Paciente::all(); 
        return view('desparacitar.create',compact('pacientes'));
    }

    public function store(Request $request) {
        $fecha_actual = date("Y-m-d");
        $max = date('Y-m-d',strtotime($fecha_actual));
        $minima = date('Y-m-d',strtotime($fecha_actual."- 100 year"));
        $maxima = date("Y-m-d",strtotime($max."+ 100 days"));
        $anio = date("Y");
        $this->validate($request,[
            'num_id'=>'required|exists:pacientes,id',
            'antiparacitario'=>'required|max:200',
            'dosis'=>'required',
            'fecha_desparacitacion'=>'required|date|before:'.$maxima.'|after:'.$minima, 
        ]);

        $desparacitars = new Desparacitar();
        $desparacitars->num_id = $request->get('num_id');
        $desparacitars->antiparacitario = $request->get('antiparacitario');
        $desparacitars->dosis = $request->get('dosis');
        $desparacitars->fecha_desparacitacion = $request->get('fecha_desparacitacion');

        $desparacitars->save();

        if($desparacitars){
            return redirect('/desparacitar')->with('mensaje', 'La triada fue creada exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $pacientes = Paciente::all(); 
        $desparacitar = Desparacitar::findOrfail($id);
        return view('desparacitar.edit',compact('pacientes'))->with('desparacitar',$desparacitar);
    }

   
    public function update(Request $request, $id)
    {
        $fecha_actual = date("Y-m-d");
        $max = date('Y-m-d',strtotime($fecha_actual));
        $minima = date('Y-m-d',strtotime($fecha_actual."- 100 year"));
        $maxima = date("Y-m-d",strtotime($max."+ 100 days"));
        $anio = date("Y");
        $this->validate($request,[
            'num_id'=>'required|exists:pacientes,id',
            'antiparacitario'=>'required|max:200',
            
            'fecha_desparacitacion'=>'required|date|before:'.$maxima.'|after:'.$minima, 
        ]);

        $desparacitars = Desparacitar::find($id);
        $desparacitars->num_id = $request->get('num_id');
        $desparacitars->antiparacitario = $request->get('antiparacitario');
        $desparacitars->dosis = $request->get('dosis');
        $desparacitars->fecha_desparacitacion = $request->get('fecha_desparacitacion');

        $desparacitars->save();

        if($desparacitars){
            return redirect('/desparacitar')->with('mensaje', 'La carrera fue Modificada exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
    }

    public function destroy($id)
    {
        $desparacitar = Desparacitar::find($id);
        $desparacitar->delete();
        return redirect('/desparacitar')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
    
}