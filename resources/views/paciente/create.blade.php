@extends('layouts.madre')

@section('title', 'Crear paciente')


@section('content')


 <br>
 <br> 

   
<br>
<form action ="../paciente"  method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="" class="form-label">Número de expediente</label>
        <input type="text"  maxlength="100"   value="{{old('numero_expediente')}}"  name="numero_expediente"  id="numero_expediente"   
        class="form-control @error('numero_expediente') is-invalid @enderror" placeholder="Ingrese el número de expediente"
        title="Ingrese el número de expediente">
        @error('numero_expediente')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>
  <div class="mb-3">
        <label for="" class="form-label">Nombre de la Mascota</label>
        <input type="text" maxlength="100" value="{{old('nombre_mascota')}}"  name="nombre_mascota"  id="nombre_mascota"   
        class="form-control @error('nombre_mascota') is-invalid @enderror" placeholder="Ingrese el nombre de la mascota"
        title="Ingrese el nombre de la mascota">
        @error('nombre_mascota')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>



      <div class="mb-3">
        <label for="" class="form-label">Especie</label> 
        <select onfocus="this.blur();"value="{{old('especie')}}" name="especie"  id="especie"  class="form-control @error('especie') is-invalid @enderror" placeholder="seleccione la especie" 
        title="seleccione la especie" >
        <option>Cannino</option> 
        <option>Equino</option> 
        <option>Felino</option>  
        <option>Otra</option>   
      </select>
      @error('especie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div> 

   

      <div class="for-group">
        <label for="">Género</label>
        <select class="form-control" name="genero_id">
        @foreach ($genero_mascotas as $genero_mascota)
        <option value="{{$genero_mascota->id}}">{{$genero_mascota->name}}</option>
        @endforeach      
      </select>
      </div>
   
      


<div class="mb-3">
        <label for="" class="form-label">Raza</label>
        <input type="text"  maxlength="100"   value="{{old('raza')}}"  name="raza"  id="raza"   
        class="form-control @error('raza') is-invalid @enderror" placeholder="Ingrese la raza"
        title="Ingrese la raza">
        @error('raza')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

   

   
    

      <div class="mb-3">
        <label for="" class="form-label">Fecha de Nacimiento</label>
        <input type="date" value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento"  id="fecha_nacimiento"  
        class="form-control @error('fecha_nacimiento') is-invalid @enderror" placeholder="aa-mm-dd" 
        title="Ingrese la fecha de nacimiento " autofocus>

      
        @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

  


      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"style="margin-left: 350px;margin-right: 60px;"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../paciente" class="btn btn-outline-danger" tabindex="5"style="margin-rigth: 100px;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
