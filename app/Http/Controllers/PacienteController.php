<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use App\Models\Propietario;
use App\Models\GeneroMascota;
use App\Models\Especie;
use App\Models\Vacuna;
use App\Models\Examen;
use App\Models\Desparacitar;
use App\Models\Clinico;



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
       
        $especies=Especie::all();
        $genero_mascotas = GeneroMascota::all();
        $propietarios = Propietario::all();
      
        return view ('paciente.create', compact('genero_mascotas','propietarios','especies'));
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

           'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre_mascota'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'pro_id'=>'required|exists:propietarios,id',
            'especie_id'=>'required|exists:especies,id',
            'genero_id'=>'required|exists:genero_mascotas,id',
            'raza'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'fecha_nacimiento'=>'required|date',
           
            
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $pacientes = new Paciente();
    
        $pacientes->nombre_mascota = $request->get('nombre_mascota');
        $pacientes->pro_id = $request->get('pro_id');
        $pacientes->especie_id = $request->get('especie_id');
        $pacientes->genero_id = $request->get('genero_id');
        $pacientes->raza= $request->get('raza');
        $pacientes->fecha_nacimiento = $request->get('fecha_nacimiento');

        
           
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinacionPath = 'image';
            $filename = time() . '.' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinacionPath, $filename);
            $pacientes->filename = $filename;
        }
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
        $especies = Especie::all();
        $propietarios=Propietario::all();
        $genero_mascotas = GeneroMascota::all();
        $paciente = Paciente::findOrfail($id);
        $nombre_mascotas = $paciente->nombre_mascota;
        return view('paciente.edit', compact('genero_mascotas','propietarios','especies','nombre_mascotas'))
        ->with('paciente', $paciente)
        ->with('idMascota', $id); 
    
    }

    public function vacunaMascota($id){
        $aplicados =  Vacuna::select('*')->where('num_id','=',$id)->get();
        return view ('vacuna/index')->with('aplicados', $aplicados)->with('idMascota', $id);
    }

    public function examenMascota($id){
        $examens =  Examen::select('*')->where('num_id','=',$id)->get();
        return view ('examen/index')->with('examens', $examens)->with('idMascota', $id);
    }
    
    public function desparacitacionMascota($id){
        $aplicados =  Desparacitar::select('*')->where('num_id','=',$id)->get();
        return view ('desparacitar/index')->with('aplicados', $aplicados)->with('idMascota', $id);
    }

    public function  clinicoMascota($id){
        $clinicos =  Clinico::select('*')->where('num_id','=',$id)->get();
        return view ('clinico/index')->with('clinicos', $clinicos)->with('idMascota', $id);
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
            
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre_mascota'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'pro_id'=>'required|exists:propietarios,id',
            'especie_id'=>'required|exists:especies,id',
            'genero_id'=>'required|exists:genero_mascotas,id',
            'raza'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'fecha_nacimiento'=>'required|date',
           
          
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);


     
        $paciente = Paciente::find($id);
        $paciente->nombre_mascota = $request->get('nombre_mascota');
        $paciente->pro_id = $request->get('pro_id');
        $paciente->especie_id = $request->get('especie_id');
        $paciente->genero_id = $request->get('genero_id');
        $paciente->raza= $request->get('raza');
        $paciente->fecha_nacimiento = $request->get('fecha_nacimiento');

        if ($request->has('eliminar_imagen')) {
        
        if ($paciente->filename && file_exists(public_path('image/' . $paciente->filename))) {
            unlink(public_path('image/' . $paciente->filename));
            $paciente->filename = null; 
        }
    }
        
    
        
        if ($request->hasFile('imagen')) {
            
            if ($paciente->filename && file_exists(public_path('image/' . $paciente->filename))) {
                unlink(public_path('image/' . $paciente->filename));
            }
    
            $file = $request->file('imagen');
            $destinationPath = 'image';
            $filename = time() . '.' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
            $paciente->filename = $filename;
        }
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
        return redirect('/paciente')->with('mensaje', 'El Registro fue borrado exitosamente.');
    }
}




