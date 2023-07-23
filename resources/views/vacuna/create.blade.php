@extends('layouts.madre')

@section('title', 'Vacunas')


@section('content')


<nav class="main-header navbar
    navbar-expand
    navbar-white navbar-light">

    <a class="nav-link" data-widget="pushmenu" href="#" data-enable-remember="true"style="color: black">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Alternar barra de navegación</span>
    </a>  

  <h3>Vacuna</h3>
  </nav>
<form action ="../vacuna"  method="POST">
    @csrf
   
 <br>


    
<div class="mb-3">
        <label for="" class="form-label">codigo de Vacuna</label>
        <input type="number"  maxlength="100"   value="{{old('cod_vacuna')}}"  name="cod_vacuna"  id="cod_vacuna"   
        class="form-control @error('cod_vacuna') is-invalid @enderror" placeholder="0000"
        title="Ingrese el codigo de vacuna">
        @error('cod_vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>



      <div class="mb-3">
        <label for="" class="form-label">Nombre de la proxima vacuna</label>
        <input type="text" value="{{old('nombre_proximavacuna')}}" name="nombre_proximavacuna"  id="nombre_proximavacuna"  
        class="form-control @error('nombre_proximavacuna') is-invalid @enderror" placeholder="Ingrese la nombre_proximavacuna" 
        title="Ingrese la nombre de la proxima vacuna" >

      
        @error('nombre_proximavacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

   

    

      <div class="mb-3">
        <label for="">Fecha de la proxima dosis</label>
        <input type="date"value="{{old('fecha_proximadosis')}}"  name="fecha_proximadosis"  id="fecha_proximadosis" 
        class="form-control @error('fecha_proximadosis') is-invalid @enderror"   placeholder="Ingrese la fecha de la proxima dosis"
        title="Ingrese la fecha de la proxima dosis ">
      
        @error('fecha_proximadosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      
  
      
      
    

      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../vacuna" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
