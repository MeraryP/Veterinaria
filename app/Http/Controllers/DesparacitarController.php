<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Models\Desparacitar;
use App\Models\Paciente;
use App\Models\Categoria;
use App\Models\Medicamento;
use Illuminate\Support\Facades\DB;

class DesparacitarController extends Controller
{

    public function index(){

        $aplicados= Desparacitar::all();
        return view ('desparacitar/index',compact('aplicados'));
    }

    public function create()
    {
        $categoriaDesparasitante = Categoria::where('nombre_cate', 'Desparasitante')->first(); 
    
        if ($categoriaDesparasitante) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaDesparasitante->id)->get();
        } else {
            $medicamentos = collect(); 
        }
        
      
        $paciente = Paciente::all(); 
        return view('desparacitar.create', compact('paciente','medicamentos'));
    }

    public function desparacitarPaciente($id)
    {

        $categoriaDesparasitante = Categoria::where('nombre_cate', 'Desparasitante')->first(); 
    
        if ($categoriaDesparasitante) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaDesparasitante->id)->get();
        } else {
            $medicamentos = collect(); 
        }
        
        $paciente = $id; 
        return view('desparacitar.create',compact('paciente','medicamentos'));
    }



    public function store(Request $request) 
    {
       
       //$request->validate([
           // 'num_id'=>'required|exists:pacientes,id',
            //'medi_id'=>'required|exists:medicamentos,id',
            //'dosis'=>'required|numeric|min:0',

            //'unidad_desparasitante' => [
              //  'required',
                //Rule::in(['ml', 'mg', 'tabletas', 'cucharaditas']),
            //],
    
            //'fecha_aplicada'=>'required|date',
            //'aplicado' => 'boolean',
            
        //]);


        $rules = [
            'num_id'=>'required|exists:pacientes,id',
            'medi_id'=>'required|exists:medicamentos,id',
            'dosis'=>'required|numeric|min:0',

            'unidad_desparasitante' => [
                'required',
                Rule::in(['ml', 'mg', 'tabletas', 'cucharaditas']),
            ],
    
            'fecha_aplicada'=>'required|date',
            'aplicado' => 'boolean',
        ];
    
        $messages = [
            'num_id.required' => 'El campo num id es obligatorio.',
            'medi_id.required' => 'El campo medi id es obligatorio.',
            'dosis.required' => 'El campo dosis es obligatorio.',
            'unidad_desparasitante.required' => 'El campo unidad es obligatorio.', 
            'fecha_aplicada.required' => 'El campo fecha aplicada es obligatorio.',
        ];
    
        $this->validate($request, $rules, $messages); 

        $aplicados = new Desparacitar();
        $aplicados->num_id = $request->get('num_id');
        $aplicados->medi_id = $request->get('medi_id');
        $aplicados->dosis = $request->get('dosis');
        $aplicados->unidad_desparasitante = $request->get('unidad_desparasitante');
        $aplicados->fecha_aplicada = $request->get('fecha_aplicada');
        $aplicados->aplicada = $request->has('aplicada');

        $aplicados->save();

        if($aplicados){
            return redirect()->route('desparacitacionMascota', ['id'=>$request->get('num_id')])->with('mensaje', 'El registro fue creado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
    }

    public function show($id)
    {
        //
    }

    
    public function edit($idd)
    {
        $categoriaDesparasitante = Categoria::where('nombre_cate', 'Desparasitante')->first(); 
    
        if ($categoriaDesparasitante) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaDesparasitante->id)->get();
        } else {
            $medicamentos = collect(); 
        }
        
       
        $pacientes = Paciente::all(); 
        $aplicado = Desparacitar::findOrfail($idd);
        return view('desparacitar.edit',compact('pacientes','medicamentos'))->with('aplicado',$aplicado);
    }

   
    public function update(Request $request, $id)
    {
       
      //  $this->validate($request,[
           // 'num_id'=>'required|exists:pacientes,id',
            //'medi_id'=>'required|exists:medicamentos,id',
            //'dosis'=>'required|numeric|min:0',
           // 'unidad_desparasitante' => [
               // 'required',
               // Rule::in(['ml', 'mg', 'tabletas', 'cucharaditas']),
           // ],
            //'fecha_aplicada'=>'required|date',
            //'aplicado' => 'boolean',
          // ]);

          
        $rules = [
            'num_id'=>'required|exists:pacientes,id',
            'medi_id'=>'required|exists:medicamentos,id',
            'dosis'=>'required|numeric|min:0',

            'unidad_desparasitante' => [
                'required',
                Rule::in(['ml', 'mg', 'tabletas', 'cucharaditas']),
            ],
    
            'fecha_aplicada'=>'required|date',
            'aplicado' => 'boolean',
        ];
    
        $messages = [
            'num_id.required' => 'El campo num id es obligatorio.',
            'medi_id.required' => 'El campo medi id es obligatorio.',
            'dosis.required' => 'El campo dosis es obligatorio.',
            'unidad_desparasitante.required' => 'El campo unidad es obligatorio.', 
            'fecha_aplicada.required' => 'El campo fecha aplicada es obligatorio.',
        ];
    
        $this->validate($request, $rules, $messages); 

        $aplicado = Desparacitar::find($id);
        $aplicado->num_id = $request->get('num_id');
        $aplicado->medi_id = $request->get('medi_id');
        $aplicado->dosis = $request->get('dosis');
        $aplicado->unidad_desparasitante = $request->get('unidad_desparasitante');
        $aplicado->fecha_aplicada = $request->get('fecha_aplicada');
        $aplicado->aplicada = $request->has('aplicada');
        $aplicado->save();

        if($aplicado){
            return redirect()->route('desparacitacionMascota',['id'=> $request->get('num_id')])->with('mensaje', 'El registro fue modificado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
    }

    public function destroy($id)
    {
       
        $aplicado = Desparacitar::find($id);
        $aplicado->delete();
        return redirect('/desparacitar')->back()->with('mensaje', 'El registro fue eliminado exitosamente.');
    }
}

