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
    public function index($id)
    {
       $paciente = Paciente::findOrfail($id);
       $aplicados= Vacuna::all();
        return view ('vacuna/index',compact('aplicados','paciente'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $categoriaVacuna = Categoria::where('nombre_cate', 'Vacuna')->first(); 
    
        if ($categoriaVacuna) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaVacuna->id)->get();
        } else {
            $medicamentos = collect();  //manda vacio 
        }
    
       $paciente = Paciente::findOrfail($id);
       $pacientes = Paciente::all();
        return view ('vacuna.create',compact('pacientes','medicamentos','paciente'));
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
            return redirect("/paciente/{$request->get('num_id')}/vacuna")->with('mensaje', 'El registro fue creado exitosamente.');
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
    public function edit($id)
    {
        $categoriaVacuna = Categoria::where('nombre_cate', 'Vacuna')->first(); 
    
        if ($categoriaVacuna) {
         
            $medicamentos = Medicamento::where('cate_id', $categoriaVacuna->id)->get();
        } else {
            $medicamentos = collect();  //manda vacio 
        }
        $paciente = Paciente::findOrfail($id);
        $pacientes = Paciente::all(); 
        $aplicado = Vacuna::findOrfail($id);
        return view('vacuna.edit',compact('pacientes','medicamentos','paciente'))->with('aplicado', $aplicado);
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
            return redirect("/paciente/{$request->get('num_id')}/vacuna")->with('mensaje', 'El registro fue modificado exitosamente.');
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
        return redirect('/vacuna')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
}
