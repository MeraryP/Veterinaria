<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anamn;
use Illuminate\Support\Facades\DB;

class AnamnesisController extends Controller
{
    public function index(Request $request)
    {
       $anamnesis= Anamn::all();
        return view ('anamnesi/index',compact('anamnesis'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        //$generos = Genero::all();
        return view ('anamnesi.create');
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
           
            'tiempo_enfermedad'=>'required|max:200',
            'funcion_organos'=>'required|max:200',
            'causas_posibles'=>'required|max:200',
            'enfermo_antes'=>'required|max:200',
            'enfermos_multiples'=>'required|max:200',
            'tratamiento'=>'required|max:200',
            'vacuna'=>'required|max:200',
            //'gene_id'=>'required|exists:generos,id',
               
           
        ]);
     
        $anamnesis = new Anamn();
        $anamnesis->tiempo_enfermedad = $request->get('tiempo_enfermedad');
        $anamnesis->funcion_organos = $request->get('funcion_organos');
        $anamnesis->causas_posibles = $request->get('causas_posibles');
        //$pacientes->gene_id = $request->get('gene_id');
        $anamnesis->enfermo_antes= $request->get('enfermo_antes');
        $anamnesis->enfermos_multiples = $request->get('enfermos_multiples');
        $anamnesis->tratamiento = $request->get('tratamiento');
        $anamnesis->vacuna = $request->get('vacuna');
        $anamnesis->save();

        if($anamnesis){
            return redirect('/anamnesi')->with('mensaje', 'El registro fue creado exitosamente.');
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

         // $generos = Genero::all();
         $anamnesi = Anamn::findOrfail($id);
         return view('anamnesi.edit')->with('anamnesi', $anamnesi);
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
           
            'tiempo_enfermedad'=>'required|max:200',
            'funcion_organos'=>'required|max:200',
            'causas_posibles'=>'required|max:200',
            'enfermo_antes'=>'required|max:200',
            'enfermos_multiples'=>'required|max:200',
            'tratamiento'=>'required|max:200',
            'vacuna'=>'required|max:200',
            //'gene_id'=>'required|exists:generos,id',
               
           
        ]);
     
        $anamnesi = Anamn::find($id);
        $anamnesi->tiempo_enfermedad = $request->get('tiempo_enfermedad');
        $anamnesi->funcion_organos = $request->get('funcion_organos');
        $anamnesi->causas_posibles = $request->get('causas_posibles');
        //$pacientes->gene_id = $request->get('gene_id');
        $anamnesi->enfermo_antes= $request->get('enfermo_antes');
        $anamnesi->enfermos_multiples = $request->get('enfermos_multiples');
        $anamnesi->tratamiento = $request->get('tratamiento');
        $anamnesi->vacuna = $request->get('vacuna');
        $anamnesi->save();

        if($anamnesi){
            return redirect('/anamnesi')->with('mensaje', 'El registro fue modificado exitosamente.');
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
        $anamnesi = Anamn::find($id);
        $anamnesi->delete();
        return redirect('/anamnesi')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
}
