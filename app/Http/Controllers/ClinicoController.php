<?php

namespace App\Http\Controllers;
use App\Models\clinico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClinicoController extends Controller
{
    public function index()
    {

       $clinicos= Clinico::all();
        return view ('clinico/index',compact('clinicos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $pacientes = Paciente::all();
        return view ('clinico.create',compact('pacientes'));
    }

        public function clinicoPaciente($id)
    {
       
        $paciente = $id;
        return view ('clinico.create',compact('paciente'));
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
            'sintomas'=>'required|regex:/^([A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)*$/|max:1000',
            'enfermedad'=>'required|regex:/^([A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)*$/|max:1000',
            'tratamiento'=>'required|regex:/^([A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)*$/|max:1000',
        ]);
     
        $clinicos = new Clinico();
        $clinicos->num_id = $request->get('num_id');
        $clinicos->sintomas = $request->get('sintomas');
        $clinicos->enfermedad = $request->get('enfermedad');
        $clinicos->tratamiento = $request->get('tratamiento');
        $clinicos->save();

        if($clinicos){
            return redirect()->route('clinicoMascota',['id'=>$request->get('num_id')])->with('mensaje', 'El registro fue creado exitosamente.');
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
        $clinico = Clinico::findOrfail($id);
        return view('clinico.edit',compact('pacientes'))->with('clinico', $clinico);
       

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
            'sintomas'=>'required|regex:/^([A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)*$/|max:1000',
            'enfermedad'=>'required|regex:/^([A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)*$/|max:1000',
            'tratamiento'=>'required|regex:/^([A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-z.,ÁÉÍÓÚáéíóúñÑ]+)*$/|max:1000', 
        ]);
     
        $clinico = Clinico::find($id);
        $clinico->num_id = $request->get('num_id');
        $clinico->sintomas = $request->get('sintomas');
        $clinico->enfermedad = $request->get('enfermedad');
        $clinico->tratamiento = $request->get('tratamiento');
       
        $clinico->save();

        if($clinico){
            return redirect()->route('clinicoMascota',['id'=> $request->get('num_id')])->with('mensaje', 'El registro fue creado exitosamente.');
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
        $clinico = Clinico::find($id);
        $clinico->delete();
        return redirect()->back()->with('mensaje', 'El registro fue eliminado exitosamente.');
}   

}