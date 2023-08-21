<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\Contraactual;
use Illuminate\Support\Facades\Gate;


use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formularioclave()
    {
        return view ('User.clave');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarclave(Request $request)
    {

        $rules=[
            'viejapassword' => ["required",new Contraactual],
            'password' => 'required|min:8|confirmed',
        ];

        $mensaje=[
            'viejapassword.required' => 'La contraseña no puede estar vacío',
            'viejapassword.Contractual' => 'La contraseña no coincide',
            'password.required' => 'La contraseña no puede estar vacío',
            'password.min' => 'La contraseña debe de tener mas de 8 caracteres',
            'password.confirmed' => 'La contraseña no coinciden',
        ];

        $this->validate($request,$rules,$mensaje);


        $contra = User::findOrFail(auth()->user()->id);
        $contra->password = Hash::make($request->input('password'));

        $contra->save();

        if($contra){
            return redirect('/')->with('mensaje', 'La contraseña fue actualizada exitosamente.');
        }else{
            //retornar con un mensaje de error.
        }

    }

    public function usuario(){
        return view('User.datos');
    }

    public function editar(){

        return view('User.editardatos');
    }

    public function actualizar(Request $request){
        //$fecha_actual = date("d-m-Y");
        //$max = date('d-m-Y',strtotime($fecha_actual."- 18 year"));
        //$minima = date('d-m-Y',strtotime($fecha_actual."- 65 year"));
        //$maxima = date("d-m-Y",strtotime($max."+ 1 days"));

        $rules=[

                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'name' =>'required|regex:/^([A-Za-zÁÉÍÓÚáéíóúñÑ]+)(\s[A-Za-zÁÉÍÓÚáéíóúñÑ]+)*$/|max:100',
                'username' => 'required|min:8|max:50',
                'correo' => 'required|max:100|email|',
                //'nacimiento'=>'required|date|before:'.$maxima.'|after:'.$minima,
                'identidad'=> 'required|max:15|regex:([0-9]{4}-[0-9]{4}-[0-9]{5})',
                'telefono'=> 'required|regex:([0-9]{4}-[0-9]{4})',
        ];

        $mensaje=[
            'imagen.required'=>'la imagen no puede estar vacia',
            'name.required' => 'El nombre no puede estar vacío',

            'username.required' => 'El nombre de usuario no puede estar vacío',
            'username.min' => 'El nombre de usuario debe de tener mas de 8 caracteres',
            

            'correo.required' => 'El correo electronico no puede estar vacío',
            'correo.max' => 'El correo electronico debe de tener menos de 100 caracteres',
            

            //'nacimiento.required' => 'La fecha de nacimiento no puede estar vacío',
            //'nacimiento.date' => 'La fecha de nacimiento debe de ser una fecha',
            //'nacimiento.before' => 'La fecha de nacimiento debe de ser anterior a '.$maxima,
            //'nacimiento.after' => 'La fecha de nacimiento debe de ser posterior a '.$minima,

            'identidad.required' => 'La identidad no puede estar vacío',
            

            'telefono.required' => 'El telefono no puede estar vacío',
            
        ];

        $this->validate($request,$rules,$mensaje);

        $user = User::find(auth()->user()->id);
        $user->name = $request->input('name');
        $user->correo = $request->input('correo');
        //$user->nacimiento = $request->input('nacimiento');
        $user->identidad = $request->input('identidad');
        $user->telefono = $request->input('telefono');
        $user->username = $request->input('username');

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $destinacionPath = 'perfil';
            $imagen = time() . '.' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move(public_path($destinacionPath), $imagen);
        
            // Eliminar la imagen anterior si existe
            if ($user->imagen) {
                $rutaImagenAnterior = public_path($destinacionPath . '/' . $user->imagen);
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }
        
            $user->imagen = $imagen;
        }
        
        $user->save();

        return redirect('/usuario')->with('mensaje', 'El perfil fue modificado exitosamente');
    }
   

    


    

}