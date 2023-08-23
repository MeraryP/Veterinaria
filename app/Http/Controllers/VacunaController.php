<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Models\Vacuna;
use App\Models\Paciente;
use App\Models\Medicamento;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;


class VacunaController extends Controller
{
    public function index(Request $request)
    {
       
       $aplicados= Vacuna::all();
        return view ('vacuna/index',compact('aplicados'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categoriaVacuna = Categoria::where('nombre_cate', 'Vacuna')->first(); 
    
        if ($categoriaVacuna) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaVacuna->id)->get();
        } else {
            $medicamentos = collect();  //manda vacio 
        }
    
       
      
       $pacientes = Paciente::all();
        return view ('vacuna.create',compact('pacientes','medicamentos'));
    }

    public function vacunaPaciente($id)
    {

        $categoriaVacuna = Categoria::where('nombre_cate', 'Vacuna')->first(); 
    
        if ($categoriaVacuna) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaVacuna->id)->get();
        } else {
            $medicamentos = collect();  //manda vacio 
        }
    
       $paciente = $id;
        return view ('vacuna.create',compact('paciente','medicamentos'));
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'num_id'=>'required|exists:pacientes,id',
            'medi_id'=>'required|exists:medicamentos,id',
            'dosis'=>'required|numeric|min:0',
            'unidad' => [
                'required',
                Rule::in(['mililitros', 'miligramos']),
            ],
            'fecha_aplicada'=>'required|date',
            'aplicada' => 'boolean',
        ]);
     
        $aplicados = new Vacuna();
        $aplicados->num_id = $request->get('num_id');
        $aplicados->medi_id = $request->get('medi_id');
        $aplicados->dosis = $request->get('dosis');
        $aplicados->unidad = $request->get('unidad');
        $aplicados->fecha_aplicada = $request->get('fecha_aplicada');
        $aplicados->aplicada = $request->has('aplicada');

        $aplicados->save();

        if($aplicados){
            return redirect()->route('vacunaMascota',['id'=>$request->get('num_id')])->with('mensaje', 'El registro fue creado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idv)
    {
        $categoriaVacuna = Categoria::where('nombre_cate', 'Vacuna')->first(); 
    
        if ($categoriaVacuna) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaVacuna->id)->get();
        } else {
            $medicamentos = collect();  //manda vacio 
        }
        
       
       
        $pacientes = Paciente::all(); 
        $aplicado = Vacuna::findOrfail($idv);
        return view('vacuna.edit',compact('pacientes','medicamentos'))->with('aplicado', $aplicado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'num_id'=>'required|exists:pacientes,id',
            'medi_id'=>'required|exists:medicamentos,id',
            'dosis'=>'required|numeric|min:0',
            'unidad' => [
                'required',
                Rule::in(['mililitros', 'miligramos']),
            ],
            'fecha_aplicada'=>'date|max:200',  
            'aplicada' => 'boolean',
        ]);
     
        $aplicado = Vacuna::find($id);
        $aplicado->num_id = $request->get('num_id');
        $aplicado->medi_id = $request->get('medi_id');
        $aplicado->dosis = $request->get('dosis');
        $aplicado->unidad = $request->get('unidad');
        $aplicado->fecha_aplicada = $request->get('fecha_aplicada');
        $aplicado->aplicada = $request->has('aplicada');
        $aplicado->save();

        if($aplicado){
            return redirect()->route('vacunaMascota',['id'=> $request->get('num_id')])->with('mensaje', 'El registro fue modificado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aplicado = Vacuna::find($id);
        $aplicado->delete();
        return redirect()->back()->with('mensaje', 'El registro fue eliminado exitosamente.');
}
}