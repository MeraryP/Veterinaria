<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacuna;
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
     
        return view ('vacuna.create');
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

            'cod_vacuna'=>'required|regex:/^\d{4}$/',
            'nombre_vacuna'=>'required|max:200',
            'fecha_aplicada'=>'date|max:200',
            'nombre_proximavacuna'=>'required|max:200',
            'fecha_proximadosis'=>'date|max:200',
            
            
            
           
        ]);
     
        $vacunas = new Vacuna();
        $vacunas->cod_vacuna= $request->get('cod_vacuna');
        $vacunas->nombre_vacuna = $request->get('nombre_vacuna');
        $vacunas->fecha_aplicada = $request->get('fecha_aplicada');
        $vacunas->nombre_proximavacuna= $request->get('nombre_proximavacuna');
        $vacunas->fecha_proximadosis = $request->get('fecha_proximadosis');
        
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

         // $generos = Genero::all();
        
         $vacuna = Vacuna::findOrfail($id);
         return view('vacuna.edit')->with('vacuna', $vacuna);
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


           'cod_vacuna'=>'required|regex:/^\d{4}$/',
            'nombre_vacuna'=>'required|max:200',
            'fecha_aplicada'=>'date|max:200',
            'nombre_proximavacuna'=>'required|max:200',
            'fecha_proximadosis'=>'date|max:200',
            
           

           
        ]);
     
        $vacuna = Vacuna::find($id);
        $vacuna->cod_vacuna= $request->get('cod_vacuna');
        $vacuna->nombre_vacuna = $request->get('nombre_vacuna');
        $vacuna->fecha_aplicada = $request->get('fecha_aplicada');
        $vacuna->nombre_proximavacuna= $request->get('nombre_proximavacuna');
        $vacuna->fecha_proximadosis = $request->get('fecha_proximadosis');
       
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
