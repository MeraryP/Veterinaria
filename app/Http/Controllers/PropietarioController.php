<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Propietario;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;
use App\Models\Genero;

class PropietarioController extends Controller
{
    public function index(Request $request)
    {
        $propietarios = Propietario::all();
        return view ('propietario/index',compact('propietarios'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        $generos = Genero::all();
        return view ('propietario.create',compact('generos','pacientes'));
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
           
          
            'num_id'=>'required|exists:pacientes,id',
            'identidad'=>'unique:propietarios,identidad|max:15|regex:([0-9]{4}-[0-9]{4}-[0-9]{5})',
            'nombre'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'direccion'=>'required|max:300',
            'gene_id'=>'required|exists:generos,id',
            'telefono'=>'required|regex:/^\d{8}$/',
            'correo'=>'required|max:100|email|unique:propietarios,correo',    
           
        ]);
     
        $propietarios = new Propietario();
        $propietarios->num_id = $request->get('num_id');
        $propietarios->identidad = $request->get('identidad');
        $propietarios->nombre = $request->get('nombre');
        $propietarios->direccion = $request->get('direccion');
        $propietarios->gene_id = $request->get('gene_id');
        $propietarios->telefono= $request->get('telefono');
        $propietarios->correo = $request->get('correo');
        $propietarios->save();

        if($propietarios){
            return redirect('/propietario')->with('mensaje', 'El registro fue creado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }

    }
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
        $pacientes = Paciente::all(); 
        $propietario = Propietario::findOrfail($id);
        return view('propietario.edit',compact('generos','pacientes'))->with('propietario', $propietario);
    
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){
        $this->validate($request,[
           
            
            'num_id'=>'required|exists:pacientes,id',
            'identidad'=>'max:15|regex:([0-9]{4}-[0-9]{4}-[0-9]{5})',
            'nombre'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'direccion'=>'required|max:300',
            'gene_id'=>'required|exists:generos,id',
            'telefono'=>'required|regex:/^\d{8}$/',
            'correo'=>'required|max:100|email',     
           
        ]);
     
        $propietario = Propietario::find($id);
        $propietario->num_id = $request->get('num_id');
        $propietario->identidad = $request->get('identidad');
        $propietario->nombre = $request->get('nombre');
        $propietario->direccion = $request->get('direccion');
        $propietario->gene_id = $request->get('gene_id');
        $propietario->telefono= $request->get('telefono');
        $propietario->correo = $request->get('correo');
        $propietario->save();

        if($propietario){
            return redirect('/propietario')->with('mensaje', 'El registro fue creado exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }


       }

public function destroy($id)
    {
        $propietario = Propietario::find($id);
        $propietario->delete();
        return redirect('/propietario')->with('mensaje', 'El Registro fue borrado exitosamente');
    }
}
