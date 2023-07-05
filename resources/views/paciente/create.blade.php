@extends('layouts.madre')

@section('title', 'Crear paciente')


@section('content')
<form action ="../paciente"  method="POST">
    @csrf
   
        

    <div class="mb-3">
    <label for="" class="form-label">Identificacion</label>
    <input type="text"  maxlength="5" pattern="" 
    title="Ingrese la Identificacion" value="{{old('identificacion')}}" 
    name="identificacion" id="identificacion" 
    class="form-control @error('identificacion') is-invalid @enderror" placeholder=""
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

    @error('identificacion')
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
        <label for="" class="form-label">Color</label>
        <input type="text" value="{{old('color')}}" name="color"  id="color"  
        class="form-control @error('color') is-invalid @enderror" placeholder="Ingrese el Color" 
        title="Ingrese el Color" >

      
        @error('color')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>

   

    

      <div class="mb-3">
        <label for="">Edad_dias</label>
        <input type="text"value="{{old('edad_dias')}}"  name="edad_dias"  id="edad_dias" 
        class="form-control @error('edad_dias') is-invalid @enderror"   placeholder="Ingrese la Edad_dias"
        title="Ingrese la Edad_dias ">
      
        @error('edad_dias')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>
      <div class="mb-3">
        <label for="">Edad_meses</label>
        <input type="text"value="{{old('edad_meses')}}"  name="edad_meses"  id="edad_meses" 
        class="form-control @error('edad_meses') is-invalid @enderror"   placeholder="Ingrese la Edad_meses"
        title="Ingrese la Edad_meses">
      
        @error('edad_meses')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </div>
      <div class="mb-3">
        <label for="">Edad_anio</label>
        <input type="text"value="{{old('edad_anio')}}"  name="edad_anio"  id="edad_anio" 
        class="form-control @error('edad_anio') is-invalid @enderror"   placeholder="Ingrese la edad_anio"
        title="Ingrese la edad_anio ">
      
        @error('edad_anio')
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

      <div class="mb-3">
        <label for="">Aptitud</label>
        <input type="text"value="{{old('aptitud')}}"  name="aptitud"  id="aptitud" 
        class="form-control @error('aptitud') is-invalid @enderror"   placeholder="Ingrese la Aptitud"
        title="Ingrese la Aptitud ">
      
        @error('aptitud')
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
