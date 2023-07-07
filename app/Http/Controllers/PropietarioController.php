<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Propietario;
use Illuminate\Support\Facades\DB;

class PropietarioController extends Controller
{
    public function index(Request $request)
    {
        $propietarios= Propietario::all();
        return view ('propietario/index',compact('propietarios'));
    }
    //
    public function create()
    {
       
       // $generos = Genero::all();
        return view ('propietario.create');
    }

    public function store(Request $request)
    {
     
        $this->validate($request,[
           
            'identidad'=>'unique:propietarios,identidad|max:15|regex:([0-9]{4}-[0-9]{4}-[0-9]{5})',
            'nombre'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'direccion'=>'required|max:300',
            'telefono'=>'max:9|regex:([0-9]{4}-[0-9]{4})',
            'correo'=>'required|max:100|email|unique:propietarios,correo',
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $propietarios = new Propietario();
        $propietarios->identidad = $request->get('identidad');
        $propietarios->nombre = $request->get('nombre');
        $propietarios->direccion = $request->get('direccion');
        //$propietarios->gene_id = $request->get('gene_id');
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

    public function edit($id)
    {
       // $generos = Genero::all();
        $propietario = Propietario::findOrfail($id);
        return view('propietario.edit')->with('propietario', $propietario);
    
    }

    public function update(Request $request, $id){
        $this->validate($request,[
           
            'identidad'=>'max:15|regex:([0-9]{4}-[0-9]{4}-[0-9]{5})',
            'nombre'=>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
            'direccion'=>'required|max:300',
            'telefono'=>'max:9|regex:([0-9]{4}-[0-9]{4})',
            'correo'=>'required|max:100|email',
            //'gene_id'=>'required|exists:generos,id',
        
            
            
           
        ]);
     
        $propietario = Propietario::find($id);
        $propietario->identidad = $request->get('identidad');
        $propietario->nombre = $request->get('nombre');
        $propietario->direccion = $request->get('direccion');
        //$propietarios->gene_id = $request->get('gene_id');
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
