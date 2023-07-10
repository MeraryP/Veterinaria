<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triada;

class TriadaController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $triadas = Triada::all();
        return view('triadas.index')-> with('triadas', $triadas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('triadas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$request->validate([ 'triada'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100', ]);

        $triadas = new triada();
        $triadas->frecuencia_respiratoria = $request->get('frecuencia_respiratoria');
        $triadas->frecuencia_pulso = $request->get('frecuencia_pulso');
        $triadas->femperatura_corporaral = $request->get('femperatura_corporaral');

        $triadas->save();

        if($triadas){
            return redirect('/triadas')->with('mensaje', 'La triada fue creada exitosamente.');
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
        $triada = Triada::findOrfail($id);
        return view('triadas.edit')->with('triada',$triada);
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


        
        $request->validate([
        
            //'triada'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            
        ]);

        $triada = triada::find($id);
        $triada->frecuencia_respiratoria = $request->get('frecuencia_respiratoria');
        $triada->frecuencia_pulso = $request->get('frecuencia_pulso');
        $triada->femperatura_corporaral = $request->get('femperatura_corporaral');

        $triada->save();

        if($triada){
            return redirect('/triadas')->with('mensaje', 'La triada fue Modificada exitosamente.');
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
}
