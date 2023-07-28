<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use App\Models\Propietario;
use App\Models\GeneroMascota;


class PacienteController extends Controller
{
    public function index(Request $request)
    {
       $pacientes = Paciente::all();
        return view ('paciente/index',compact('pacientes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $genero_mascotas = GeneroMascota::all();
        $propietarios = Propietario::all();
      
        return view ('paciente.create', compact('genero_mascotas','propietarios'));
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
           
            'nombre_mascota'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'pro_id'=>'required|exists:propietarios,id',
            'especie'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'genero_id'=>'required|exists:genero_mascotas,id',
            'raza'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'fecha_nacimiento'=>'required|date',
           
            
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $pacientes = new Paciente();
    
        $pacientes->nombre_mascota = $request->get('nombre_mascota');
        $pacientes->pro_id = $request->get('pro_id');
        $pacientes->especie = $request->get('especie');
        $pacientes->genero_id = $request->get('genero_id');
        $pacientes->raza= $request->get('raza');
        $pacientes->fecha_nacimiento = $request->get('fecha_nacimiento');
        $pacientes->save();

        if($pacientes){
            return redirect('/paciente')->with('mensaje', 'El registro fue creado exitosamente.');
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
        $propietarios=Propietario::all();
        $genero_mascotas = GeneroMascota::all();
        $paciente = Paciente::findOrfail($id);
        return view('paciente.edit', compact('genero_mascotas','propietarios'))->with('paciente', $paciente);
    
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
            
            
            'nombre_mascota'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'pro_id'=>'required|exists:propietarios,id',
            'especie'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'genero_id'=>'required|exists:genero_mascotas,id',
            'raza'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'fecha_nacimiento'=>'required|date',
           
          
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $paciente = Paciente::find($id);
        $paciente->nombre_mascota = $request->get('nombre_mascota');
        $paciente->pro_id = $request->get('pro_id');
        $paciente->especie = $request->get('especie');
        $paciente->genero_id = $request->get('genero_id');
        $paciente->raza= $request->get('raza');
        $paciente->fecha_nacimiento = $request->get('fecha_nacimiento');
        $paciente->save();

        if($paciente){
            return redirect('/paciente')->with('mensaje', 'El registro fue modificado exitosamente.');
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
        $paciente = Paciente::find($id);
        $paciente->delete();
        return redirect('/paciente')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
}




