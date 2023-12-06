<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function index()
    {
  
       $examens= Examen::all();
        return view ('examen/index',compact('examens'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
     
        $paciente = Paciente::all();  
        //$generos = Genero::all();
        return view ('examen.create',compact('paciente'));
    }


    public function examenPaciente($id)
    {
       
     
        $paciente = $id;  
        //$generos = Genero::all();
        return view ('examen.create',compact('paciente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        

       // $this->validate($request,[
           
         
           // 'num_id'=>'required|exists:pacientes,id',
            //'temperatura'=>'required|numeric',
            //'frecuencia_cardiaca'=>'required|numeric',
            //'frecuencia_respiratoria'=>'required|numeric',
            //'peso'=>'required|numeric',
            //'pulso'=>'required|numeric',
        
       // ]);
       $rules = [
        'num_id' => 'required|exists:pacientes,id|numeric',
        'temperatura' => 'required|numeric',
        'frecuencia_cardiaca' => 'required|numeric',
        'frecuencia_respiratoria' => 'required|numeric',
        'peso' => 'required|numeric',
        'pulso' => 'required|numeric',
    ];

    $messages = [
        'num_id.required' => 'El campo num id es obligatorio.',
        'num_id.exists' => 'El campo num id seleccionado no existe.',
        'num_id.numeric' => 'El campo num id debe ser un valor numérico.',
        'temperatura.required' => 'El campo temperatura es obligatorio.',
        'temperatura.numeric' => 'El campo temperatura debe ser un valor numérico.',
        'frecuencia_cardiaca.required' => 'El campo frecuencia cardiaca es obligatorio.',
        'frecuencia_cardiaca.numeric' => 'El campo frecuencia cardiaca debe ser un valor numérico.',
        'frecuencia_respiratoria.required' => 'El campo frecuencia respiratoria es obligatorio.',
        'frecuencia_respiratoria.numeric' => 'El campo frecuencia respiratoria debe ser un valor numérico.',
        'peso.required' => 'El campo peso es obligatorio.',
        'peso.numeric' => 'El campo peso debe ser un valor numérico.',
        'pulso.required' => 'El campo pulso es obligatorio.',
        'pulso.numeric' => 'El campo pulso debe ser un valor numérico.',
    ];

    $this->validate($request, $rules, $messages); 
     
        $examens = new Examen();
        $examens->num_id = $request->get('num_id');
        $examens->temperatura = $request->get('temperatura');
        $examens->frecuencia_cardiaca = $request->get('frecuencia_cardiaca');
        $examens->frecuencia_respiratoria = $request->get('frecuencia_respiratoria');
        $examens->peso = $request->get('peso');
        $examens->pulso = $request->get('pulso');
        $examens->save();

        if($examens){
            return redirect()->route('examenMascota',['id'=>$request->get('num_id')])->with('mensaje', 'El registro fue creado exitosamente.');
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
       
     
        $pacientes = Paciente::all(); 
        $examen = Examen::findOrfail($id);
        return view('examen.edit',compact('pacientes'))->with('examen', $examen);
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
            return redirect()->route('examenMascota',['id'=>$request->get('num_id')])->with('mensaje', 'El registro fue modificado exitosamente.');
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
        return redirect()->back()->with('mensaje', 'El registro fue elimainado exitosamente.');
    }
}
