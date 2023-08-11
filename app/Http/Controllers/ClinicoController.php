<?php

namespace App\Http\Controllers;
use App\Models\clinico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClinicoController extends Controller
{
    public function index($id)
    {
        $paciente= Paciente::findOrfail($id);
       $clinicos= Clinico::all();
        return view ('clinico/index',compact('clinicos','paciente'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $paciente= Paciente::findOrfail($id);
        $nombre_mascotas = $paciente->nombre_mascota;
        $pacientes = Paciente::all();
        return view ('clinico.create',compact('pacientes','paciente','nombre_mascotas'));
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
            return redirect("/paciente/{$request->get('num_id')}/clinico")->with('mensaje', 'El registro fue creado exitosamente.');
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
    public function edit($id,$idc)
    {
        $paciente= Paciente::findOrfail($id);
        $nombre_mascotas = $paciente->nombre_mascota;
        $pacientes = Paciente::all(); 
        $clinico = Clinico::findOrfail($idc);
        return view('clinico.edit',compact('pacientes','paciente','nombre_mascotas'))->with('clinico', $clinico);
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
            return redirect("/paciente/{$request->get('num_id')}/clinico")->with('mensaje', 'El registro fue modificado exitosamente.');
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
    public function destroy($id,$clinico)
    {
        $paciente = Paciente::findOrFail($id);
        $clinico = Clinico::find($clinico);
        if ($clinico) {
            $clinico->delete(); 
           return redirect("/paciente/{$id}/clinico")->with('mensaje', 'El Registro fue borrado exitosamente');
        }
    }
}
