@extends('layouts.madre')

@section('title', 'Crear paciente')


@section('content')
<form action ="../paciente"  method="POST">
    @csrf


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
        <input type="text"  maxlength="100"   value="{{old('especie')}}"  name="especie"  id="especie"   
        class="form-control @error('especie') is-invalid @enderror" placeholder="Ingrese la especie"
        title="Ingrese la especie">
        @error('especie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      
      </div>

   

<div class="mb-3">
  <label for="" class="form-label">Género</label>
  <input type="text"  maxlength="100"   value="{{old('genero')}}"  name="genero"  id="genero"   
  class="form-control @error('genero') is-invalid @enderror" placeholder="Ingrese el género"
  title="Ingrese el género">
  @error('genero')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

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
        <label for="" class="form-label">Edad</label>
        <input type="text"  maxlength="100"   value="{{old('raza')}}"  name="edad"  id="edad"   
        class="form-control @error('edad') is-invalid @enderror" placeholder="Ingrese la edad"
        title="Ingrese la edad">
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

      <div class="mb-3">
        <label for="">Fecha última visita</label>
        <input type="date"value="{{old('ultima_visita')}}"  name="ultima_visita"  id="ultima_visita" 
        class="form-control @error('ultima_visita') is-invalid @enderror"   placeholder="Ingrese la fecha de la última visita"
        title="Ingrese la fecha de la última visita ">
      
        @error('ultima_visita')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-outline-success" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../paciente" class="btn btn-outline-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
