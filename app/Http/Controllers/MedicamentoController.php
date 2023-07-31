<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;



class MedicamentoController extends Controller
{
    public function index(Request $request)
    {
       $medicamentos = Medicamento::all();
        return view ('medicamento/index',compact('medicamentos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
       
        
      
        return view ('medicamento.create');
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
           
            'nombre_vacuna'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'nombre_desp'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'dosis'=>'required|numeric'
           
            
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $medicamentos = new Medicamento();
    
        $medicamentos->nombre_vacuna = $request->get('nombre_vacuna');
        $medicamentos->nombre_desp = $request->get('nombre_desp');
        $medicamentos->dosis = $request->get('dosis');
        $medicamentos->save();

        if($medicamentos){
            return redirect('/medicamento')->with('mensaje', 'El registro fue creado exitosamente.');
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

        $medicamento = Medicamento::findOrfail($id);
        return view('medicamento.edit')->with('medicamento', $medicamento);
    
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
            
            
            
            'nombre_vacuna'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'nombre_desp'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'dosis'=>'required|numeric'
           
          
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $medicamento = Medicamento::find($id);
            
        $medicamento->nombre_vacuna = $request->get('nombre_vacuna');
        $medicamento->nombre_desp = $request->get('nombre_desp');
        $medicamento->dosis = $request->get('dosis');
        $medicamento->save();

        if($medicamento){
            return redirect('/medicamento')->with('mensaje', 'El registro fue modificado exitosamente.');
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
        $medicamento = Medicamento::find($id);
        $medicamento->delete();
        return redirect('/medicamento')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
}


