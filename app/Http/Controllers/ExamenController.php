<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function index($id)
    {
        $paciente = Paciente::findOrfail($id);
       $examens= Examen::all();
        return view ('examen/index',compact('examens','paciente'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $paciente = Paciente::findOrfail($id);
        $pacientes = Paciente::all(); 
        //$generos = Genero::all();
        return view ('examen.create',compact('pacientes','paciente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
           
         
            'num_id'=>'required|exists:pacientes,id',
            'temperatura'=>'required|numeric',
            'frecuencia_cardiaca'=>'required|numeric',
            'frecuencia_respiratoria'=>'required|numeric',
            'peso'=>'required|numeric',
            'pulso'=>'required|numeric',
        
        ]);
     
        $examens = new Examen();
        $examens->num_id = $request->get('num_id');
        $examens->temperatura = $request->get('temperatura');
        $examens->frecuencia_cardiaca = $request->get('frecuencia_cardiaca');
        $examens->frecuencia_respiratoria = $request->get('frecuencia_respiratoria');
        $examens->peso = $request->get('peso');
        $examens->pulso = $request->get('pulso');
        $examens->save();

        if($examens){
            return redirect("/paciente/{$request->get('num_id')}/examen")->with('mensaje', 'El registro fue creado exitosamente.');
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
        $paciente = Paciente::findOrfail($id);
        $pacientes = Paciente::all(); 
        $examen = Examen::findOrfail($id);
        return view('examen.edit',compact('pacientes','paciente'))->with('examen', $examen);
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
            'temperatura'=>'required|numeric',
            'frecuencia_cardiaca'=>'required|numeric',
            'frecuencia_respiratoria'=>'required|numeric',
            'peso'=>'required|numeric',
            'pulso'=>'required|numeric',
           
  
        
        ]);
     
        $examen = Examen::find($id);
        $examen->num_id = $request->get('num_id');
        $examen->temperatura = $request->get('temperatura');
        $examen->frecuencia_cardiaca = $request->get('frecuencia_cardiaca');
        $examen->frecuencia_respiratoria = $request->get('frecuencia_respiratoria');
        $examen->peso = $request->get('peso');
        $examen->pulso = $request->get('pulso');
        $examen->save();

        if($examen){
            return redirect("/paciente/{$request->get('num_id')}/examen")->with('mensaje', 'El registro fue modificado exitosamente.');
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
        $examen = Examen::find($id);
        $examen->delete();
        return redirect('/examen')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
}
