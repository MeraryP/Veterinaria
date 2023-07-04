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

   

    


    

}