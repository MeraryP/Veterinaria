<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use App\Models\Vacuna;
use App\Models\Genero;
use App\Models\Propietario;
use App\Models\Examen;
use App\Models\Desparacitar;


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
       
        $generos = Genero::all();
        $vacunas = Vacuna::all();
        $propietarios = Propietario::all(); 
        $examens = Examen::all();
        $desparacitars = Desparacitar::all();
        return view ('paciente.create', compact('generos','vacunas','propietarios','examens','desparacitars'));
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
            'numero_expediente'=>'unique:pacientes,numero_expediente|numeric|regex:([0-9]{4})',
            'nombre_mascota'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'pro_id'=>'required|exists:propietarios,id',
            'especie'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'gene_id'=>'required|exists:generos,id',
            'raza'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'edad'=>'required|integer|max:50',
            'vacuna_id'=>'required|exists:vacunas,id',
            'desp_id'=>'required|exists:desparacitars,id',
            //'desp_id'=>'required|exists:desparacitars,id',
            'fecha_nacimiento'=>'required|date',
            'exa_id'=>'required|exists:examens,id',
            
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $pacientes = new Paciente();
    
        $pacientes->numero_expediente = $request->get('numero_expediente');
        $pacientes->nombre_mascota = $request->get('nombre_mascota');
        $pacientes->pro_id = $request->get('pro_id');
        $pacientes->especie = $request->get('especie');
        $pacientes->gene_id = $request->get('gene_id');
        $pacientes->raza= $request->get('raza');
        $pacientes->edad = $request->get('edad');
        $pacientes->vacuna_id = $request->get('vacuna_id');
        $pacientes->desp_id = $request->get('desp_id');
        $pacientes->fecha_nacimiento = $request->get('fecha_nacimiento');
        $pacientes->exa_id = $request->get('exa_id');
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
        
        $generos = Genero::all();
        $vacunas = Vacuna::all();
        $propietarios = Propietario::all();
        $examens = Examen::all();
        $desparacitars = Desparacitar::all();
        $paciente = Paciente::findOrfail($id);
        return view('paciente.edit', compact('generos','vacunas','propietarios','examens','desparacitars'))->with('paciente', $paciente);
    
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
            
            'numero_expediente'=>'numeric|regex:([0-9]{4})',
            'nombre_mascota'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'pro_id'=>'required|exists:propietarios,id',
            'especie'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'gene_id'=>'required|exists:generos,id',
            'raza'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'edad'=>'required|integer|max:50',
            'vacuna_id'=>'required|exists:vacunas,id',
            'desp_id'=>'required|exists:desparacitars,id',
            'fecha_nacimiento'=>'required|date',
            'exa_id'=>'required|exists:examens,id', 
           
          
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $paciente = Paciente::find($id);
        $paciente->numero_expediente = $request->get('numero_expediente');
        $paciente->nombre_mascota = $request->get('nombre_mascota');
        $paciente->pro_id = $request->get('pro_id');
        $paciente->especie = $request->get('especie');
        $paciente->gene_id = $request->get('gene_id');
        $paciente->raza= $request->get('raza');
        $paciente->edad = $request->get('edad');
        $paciente->vacuna_id = $request->get('vacuna_id');
        $paciente->desp_id = $request->get('desp_id');
        $paciente->fecha_nacimiento = $request->get('fecha_nacimiento');
        $paciente->exa_id = $request->get('exa_id');
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




