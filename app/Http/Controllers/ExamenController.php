<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Examen;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function index(Request $request)
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
       
        //$generos = Genero::all();
        return view ('examen.create');
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
           
            'temperatura'=>'required|max:300',
            'frecuencia_cardiaca'=>'required|max:300',
            'frecuencia_respiratoria'=>'required|max:300',
            'peso'=>'required|max:300',
            'pulso'=>'required|max:300',
            'gastrointestal'=>'required|max:300',
            'tratamiento'=>'required|max:300',
  
        
        ]);
     
        $examens = new Examen();
        $examens->temperatura = $request->get('temperatura');
        $examens->frecuencia_cardiaca = $request->get('frecuencia_cardiaca');
        $examens->frecuencia_respiratoria = $request->get('frecuencia_respiratoria');
        $examens->peso = $request->get('peso');
        $examens->pulso = $request->get('pulso');
        $examens->gastrointestal = $request->get('gastrointestal');
        $examens->tratamiento = $request->get('tratamiento');
        $examens->save();

        if($examens){
            return redirect('/examen')->with('mensaje', 'El registro fue creado exitosamente.');
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

        $examen = Examen::findOrfail($id);
        return view('examen.edit')->with('examen', $examen);
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
           
            'temperatura'=>'required|max:300',
            'frecuencia_cardiaca'=>'required|max:300',
            'frecuencia_respiratoria'=>'required|max:300',
            'peso'=>'required|max:300',
            'pulso'=>'required|max:300',
            'gastrointestal'=>'required|max:300',
            'tratamiento'=>'required|max:300',
  
        
        ]);
     
        $examen = Examen::find($id);
        $examen->temperatura = $request->get('temperatura');
        $examen->frecuencia_cardiaca = $request->get('frecuencia_cardiaca');
        $examen->frecuencia_respiratoria = $request->get('frecuencia_respiratoria');
        $examen->peso = $request->get('peso');
        $examen->pulso = $request->get('pulso');
        $examen->gastrointestal = $request->get('gastrointestal');
        $examen->tratamiento = $request->get('tratamiento');
        $examen->save();

        if($examen){
            return redirect('/examen')->with('mensaje', 'El registro fue modificado exitosamente.');
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
