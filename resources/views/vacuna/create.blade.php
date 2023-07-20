@extends('layouts.madre')

@section('title', 'Vacunas')


@section('content')
<form action ="../vacuna"  method="POST">
    @csrf
   

    <div class="mb-3">
    <label for="" class="form-label">Nombre de la vacuna</label>
    <input type="text"  maxlength="200"
    title="Ingrese el nombre de la vacuna" value="{{old('nombre_vacuna')}}" 
    name="nombre_vacuna" id="nombre_vacuna" 
    class="form-control @error('nombre_vacuna') is-invalid @enderror" placeholder="Ingrese el nombre de la vacuna"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('nombre_vacuna')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
  </div>


<div class="mb-3">
        <label for="" class="form-label">Fecha aplicada</label>
        <input type="date"  maxlength="100"   value="{{old('fecha_aplicada')}}"  name="fecha_aplicada"  id="fecha_aplicada"   
        class="form-control @error('fecha_aplicada') is-invalid @enderror" placeholder="Ingrese la fecha aplicada"
        title="Ingrese la fecha aplicada">
        @error('fecha_aplicada')
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
<button type="submit"class="btn btn-primary" tabindex="4"><span class="fas fa-user-plus"></span> Guardar</button> 

<a href="../vacuna" class="btn btn-danger" tabindex="5"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
<br>
<br>


</form>


@endsection
