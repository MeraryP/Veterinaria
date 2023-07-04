@extends('layouts.madre')

@section('title', 'Datos de usuario')

@section('content')

        <center><h1></h1></center>

        <br>
        <br>
        
        <div class="input-group mb-3">
        <label for="" style="width:20%">Nombre Completo:</label>
            <input type="text" class="form-control" value="{{auth()->user()->name}}" disabled>
        </div>

        <div class="input-group mb-3">
            <label for="" style="width:20%">Nombre de usuario:</label>
            <input type="text" class="form-control" value="{{auth()->user()->username}}" disabled>
        </div>

        <div class="input-group mb-3">
            <label for="" style="width:20%">Correo electronico:</label>
            <input type="text" class="form-control" value="{{auth()->user()->correo}}" disabled>
        </div>

      

        <div class="input-group mb-3">
            <label for="" style="width:20%">Identidad:</label>
            <input type="text" class="form-control" value="{{auth()->user()->identidad}}" disabled>
        </div>

        <div class="input-group mb-3">
            <label for="" style="width:20%">Teléfono:</label>
            <input type="text" class="form-control" value="{{auth()->user()->telefono}}" disabled>
        </div>

        
        <br>
        <a type="button" class="btn btn-warning"href="/contrasenia" ><i class="fa fa-key" aria-hidden="true"></i>
          Cambiar Contraseña
        </a>
        
       
       <a type="button" class="btn btn-warning" href="../"   ><i class="fa fa-reply-all" aria-hidden="true"></i>
            Volver a inicio
        </a>

       

@stop