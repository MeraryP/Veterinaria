<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Models\Desparacitar;
use App\Models\Paciente;
use App\Models\Categoria;
use App\Models\Medicamento;
use Illuminate\Support\Facades\DB;

class DesparacitarController extends Controller{
    public function index($id){

        $paciente= Paciente::findOrfail($id);
        $aplicados= Desparacitar::all();
        return view ('desparacitar/index',compact('aplicados','paciente'));
    }

    public function create($id){

        $categoriaDesparasitante = Categoria::where('nombre_cate', 'Desparasitante')->first(); 
    
        if ($categoriaDesparasitante) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaDesparasitante->id)->get();
        } else {
            $medicamentos = collect(); 
        }
        
        $paciente = Paciente::findOrfail($id);
        $nombre_mascotas = $paciente->nombre_mascota;
        $pacientes = Paciente::all(); 
        return view('desparacitar.create',compact('pacientes','medicamentos','paciente','nombre_mascotas'));
    }

    public function store(Request $request) {
       
        $this->validate($request,[
            'num_id'=>'required|exists:pacientes,id',
            'medi_id'=>'required|exists:medicamentos,id',
            'dosis'=>'required|numeric|min:0',

            'unidad_desparasitante' => [
                'required',
                Rule::in(['ml', 'mg', 'tabletas', 'cucharaditas']),
            ],
        /* 'unidad' => [
                'required',
                Rule::in(['mililitros', 'miligramos']),
            ],*/
            'fecha_aplicada'=>'required|date',
            'aplicado' => 'boolean',
            
        ]);

        $aplicados = new Desparacitar();
        $aplicados->num_id = $request->get('num_id');
        $aplicados->medi_id = $request->get('medi_id');
        $aplicados->dosis = $request->get('dosis');
        $aplicados->unidad_desparasitante = $request->get('unidad_desparasitante');
        $aplicados->fecha_aplicada = $request->get('fecha_aplicada');
        $aplicados->aplicada = $request->has('aplicada');

        $aplicados->save();

        if($aplicados){
            return redirect("/paciente/{$request->get('num_id')}/desparacitar")->with('mensaje', 'El desparacitante fue cread0 exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id,$idd)
    {
        $categoriaDesparasitante = Categoria::where('nombre_cate', 'Desparasitante')->first(); 
    
        if ($categoriaDesparasitante) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaDesparasitante->id)->get();
        } else {
            $medicamentos = collect(); 
        }
        
        $paciente = Paciente::findOrfail($id);
        $pacientes = Paciente::all(); 
        $nombre_mascotas = $paciente->nombre_mascota;
        $aplicado = Desparacitar::findOrfail($idd);
        return view('desparacitar.edit',compact('pacientes','medicamentos','paciente','nombre_mascotas'))->with('aplicado',$aplicado);
    }

   
    public function update(Request $request, $id)
    {
       
        $this->validate($request,[
            'num_id'=>'required|exists:pacientes,id',
            'medi_id'=>'required|exists:medicamentos,id',
            'dosis'=>'required|numeric|min:0',
            'unidad_desparasitante' => [
                'required',
                Rule::in(['ml', 'mg', 'tabletas', 'cucharaditas']),
            ],
            'fecha_aplicada'=>'required|date',
            'aplicado' => 'boolean',
        ]);

        $aplicados = Desparacitar::find($id);
        $aplicados->num_id = $request->get('num_id');
        $aplicados->medi_id = $request->get('medi_id');
        $aplicados->dosis = $request->get('dosis');
        $aplicados->unidad_desparasitante = $request->get('unidad_desparasitante');
        $aplicados->fecha_aplicada = $request->get('fecha_aplicada');
        $aplicados->aplicada = $request->has('aplicada');


        $aplicados->save();

        if($aplicados){
            return redirect("/paciente/{$request->get('num_id')}/desparacitar")->with('mensaje', 'El desparacitante fue modificado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
    }

    public function destroy($id,$desparacitar)
    {

        $paciente = Paciente::findOrFail($id);
        $aplicado = Desparacitar::find($desparacitar);
        if ($aplicado) {
            $aplicado->delete(); 
           return redirect("/paciente/{$id}/desparacitar")->with('mensaje', 'El Registro fue borrado exitosamente');
        }
    }
    
}