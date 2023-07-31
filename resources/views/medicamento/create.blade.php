@extends('layouts.madre')

@section('title', 'Registrar Medicamento')


@section('content')

 
<form action ="../medicamento"  method="POST">
    @csrf
           
   <br> 
   
   


     
      <div class="mb-3">
        <label for="" class="form-label">Nombre de la vacuna</label>
        <input type="text"  maxlength="100"   value="{{old('nombre_vacuna')}}"  name="nombre_vacuna"  id="nombre_vacuna"   
        class="form-control @error('nombre_vacuna') is-invalid @enderror" placeholder="Ingrese el nombre del medicamento "
        title="Ingrese el nombre del medicamento">
        @error('nombre_vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

     
      
      <div class="mb-3">
        <label for="" class="form-label">Nombre del Desparasitante</label>
        <input type="text"  maxlength="100"   value="{{old('nombre_desp')}}"  name="nombre_desp"  id="nombre_desp"   
        class="form-control @error('nombre_desp') is-invalid @enderror" placeholder="Ingrese el nombre del medicamento "
        title="Ingrese el nombre del medicamento">
        @error('nombre_desp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div> 



    
     
      <div class="mb-3">
        <label for="" class="form-label">Dosis del medicamento</label>
        <input type="number"    value="{{old('dosis')}}"  name="dosis"  id="dosis"   
        class="form-control @error('dosis') is-invalid @enderror" placeholder="Ingrese la dosis "
        title="Ingrese la dosis">
        @error('dosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

   
      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../medicamento" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;" ><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
