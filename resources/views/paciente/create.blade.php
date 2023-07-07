@extends('layouts.madre')

@section('title', 'Crear paciente')


@section('content')
<form action ="../paciente"  method="POST">
    @csrf
   
        

    <div class="mb-3">
    <label for="" class="form-label">Identificación</label>
    <input type="text"  maxlength="4" 
    title="Ingrese la Identificacion" value="{{old('identificacion')}}" 
    name="identificacion" id="identificacion" 
    class="form-control @error('identificacion') is-invalid @enderror" placeholder="0000"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

   
    @error('identificacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
  </div>
  

  <div class="mb-3">
        <label for="" class="form-label">Nombre de la Mascota</label>
        <input type="text" maxlength="100" value="{{old('nombre')}}"  name="nombre"  id="nombre"   
        class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese el nombre de la mascota"
        title="Ingrese el nombre de la mascota">
        @error('nombre')
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
        <input type="" value="{{old('fecha')}}" name="fecha"  id="fecha"  
        class="form-control @error('fecha') is-invalid @enderror" placeholder="aa-mm-dd" 
        title="Ingrese la fecha de nacimiento " autofocus>

      
        @error('fecha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

      <div class="mb-3">
        <label for="">Peso</label>
        <input type="text"value="{{old('peso')}}"  name="peso"  id="peso" 
        class="form-control @error('peso') is-invalid @enderror"   placeholder="Ingrese el peso"
        title="Ingrese el peso ">
      
        @error('peso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>


      
<link rel="stylesheet" type="text/css" href="css/fonts.css" >     
<button type="submit"class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../paciente" class="btn btn-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
