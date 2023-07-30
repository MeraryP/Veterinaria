<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacuna;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class VacunaController extends Controller
{
    public function index(Request $request)
    {
       $vacunas= Vacuna::all();
        return view ('vacuna/index',compact('vacunas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$generos = Genero::all();
       $pacientes = Paciente::all();
        return view ('vacuna.create',compact('pacientes'));
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
            'nombre_vacuna'=>'required|max:200',
            'cantidad'=>'required|numeric|regex:([0-9])',
            'fecha_aplicada'=>'date|max:200',
        ]);
     
        $vacunas = new Vacuna();
        $vacunas->num_id = $request->get('num_id');
        $vacunas->nombre_vacuna = $request->get('nombre_vacuna');
        $vacunas->cantidad = $request->get('cantidad');
        $vacunas->fecha_aplicada = $request->get('fecha_aplicada');
        
        $vacunas->save();

        if($vacunas){
            return redirect('/vacuna')->with('mensaje', 'El registro fue creado exitosamente.');
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
        //$generos = Genero::all();
        $pacientes = Paciente::all(); 
        $vacuna = Vacuna::findOrfail($id);
        return view('vacuna.edit',compact('pacientes'))->with('vacuna', $vacuna);
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
            'nombre_vacuna'=>'required|max:200',
            'cantidad'=>'required|numeric|regex:([0-9])',
            'fecha_aplicada'=>'date|max:200',  
        ]);
     
        $vacuna = Vacuna::find($id);
        $vacuna->num_id = $request->get('num_id');
        $vacuna->nombre_vacuna = $request->get('nombre_vacuna');
        $vacuna->cantidad = $request->get('cantidad');
        $vacuna->fecha_aplicada = $request->get('fecha_aplicada');
       
        $vacuna->save();

        if($vacuna){
            return redirect('/vacuna')->with('mensaje', 'El registro fue modificado exitosamente.');
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
        $vacuna = Vacuna::find($id);
        $vacuna->delete();
        return redirect('/vacuna')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
}
